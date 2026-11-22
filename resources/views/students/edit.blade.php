@extends('layouts.bootstrap')
@section('title', 'Editar alumno')
@section('content')
<div class="row justify-content-center"><div class="col-md-6">
    <div class="card shadow-sm">
        <div class="card-header">Editar alumno</div>
        <div class="card-body">
            <form method="POST" action="{{ route('students.update', $student) }}">
                @csrf @method('PUT')
                @include('students._form')
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancelar</a>
                <button class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
</div></div>
@endsection