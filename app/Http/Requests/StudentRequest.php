<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'profesor';
    }

    public function rules(): array
    {
        $student = $this->route('student');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($student?->user_id)],
            'password' => [$student ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
            'faltas' => ['required', 'integer', 'min:0', 'max:50'],
            'calificacion' => ['required', 'numeric', 'min:0', 'max:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'faltas.max' => 'Las faltas no pueden ser más de 50.',
            'calificacion.min' => 'La calificación debe estar entre 0 y 10.',
            'calificacion.max' => 'La calificación debe estar entre 0 y 10.',
        ];
    }
}