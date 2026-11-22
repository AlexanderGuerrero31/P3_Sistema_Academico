@extends('layouts.bootstrap')
@section('title', 'Alumnos')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Alumnos</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Nuevo alumno</a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
            <thead>
                <tr>
                    <th><x-sort-link field="nombre" label="Alumno" :sort="$sort" :dir="$dir" /></th>
                    <th><x-sort-link field="faltas" label="Faltas" :sort="$sort" :dir="$dir" /></th>
                    <th><x-sort-link field="calificacion" label="Calificación" :sort="$sort" :dir="$dir" /></th>
                    <th>Equivalencia</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->faltas }}</td>
                    <td>{{ number_format($student->calificacion, 2) }}</td>
                    <td><x-grade-badge :letra="$student->equivalencia" /></td>
                    <td class="text-end">
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form method="POST" action="{{ route('students.destroy', $student) }}" class="d-inline"
                              onsubmit="return confirm('¿Eliminar a este alumno?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">No hay alumnos registrados.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $students->links() }}</div>
@endsection