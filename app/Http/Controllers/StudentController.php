<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $columnas = [
            'nombre' => 'users.name',
            'calificacion' => 'students.calificacion',
            'faltas' => 'students.faltas',
        ];

        $sort = $request->query('sort', 'nombre');
        if (!isset($columnas[$sort])) {
            $sort = 'nombre';
        }
        $dir = $request->query('dir') === 'desc' ? 'desc' : 'asc';

        $query = Student::with('user')
            ->join('users', 'users.id', '=', 'students.user_id')
            ->select('students.*');

        $sort === 'nombre'
            ? $query->orderByRaw("LOWER(users.name) {$dir}")
            : $query->orderBy($columnas[$sort], $dir);

        $students = $query->orderBy('students.id')->paginate(10)->withQueryString();

        return view('students.index', compact('students', 'sort', 'dir'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(StudentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => 'alumno',
            ]);
            $user->student()->create($request->only('faltas', 'calificacion'));
        });

        return redirect()->route('students.index')->with('status', 'Alumno registrado correctamente.');
    }

    public function edit(Student $student)
    {
        $student->load('user');
        return view('students.edit', compact('student'));
    }

    public function update(StudentRequest $request, Student $student)
    {
        DB::transaction(function () use ($request, $student) {
            $datos = ['name' => $request->name, 'email' => $request->email];
            if ($request->filled('password')) {
                $datos['password'] = $request->password;
            }
            $student->user->update($datos);
            $student->update($request->only('faltas', 'calificacion'));
        });

        return redirect()->route('students.index')->with('status', 'Alumno actualizado correctamente.');
    }

    public function destroy(Student $student)
    {
        // Al borrar el usuario, el registro académico se elimina en cascada
        $student->user->delete();

        return redirect()->route('students.index')->with('status', 'Alumno eliminado correctamente.');
    }

    // Vista del alumno: solo sus propios datos
    public function mine(Request $request)
    {
        $student = $request->user()->student;
        return view('students.mine', compact('student'));
    }
}