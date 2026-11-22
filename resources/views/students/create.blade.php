@extends('layouts.bootstrap')
@section('title', 'Nuevo alumno')
@section('content')
<div class="row justify-content-center"><div class="col-md-6">
    <div class="card shadow-sm">
        <div class="card-header">Registrar alumno</div>
        <div class="card-body">
            <form method="POST" action="{{ route('students.store') }}">
                @csrf
                @include('students._form')
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancelar</a>
                <button class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div></div>
@endsection