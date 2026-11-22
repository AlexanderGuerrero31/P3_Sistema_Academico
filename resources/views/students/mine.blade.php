@extends('layouts.bootstrap')
@section('title', 'Mi información')
@section('content')
<div class="row justify-content-center"><div class="col-md-6">
    <div class="card shadow-sm">
        <div class="card-header">Mi información académica</div>
        @if($student)
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Nombre:</b> {{ auth()->user()->name }}</li>
                <li class="list-group-item"><b>Faltas:</b> {{ $student->faltas }}</li>
                <li class="list-group-item"><b>Calificación:</b> {{ number_format($student->calificacion, 2) }}</li>
                <li class="list-group-item"><b>Equivalencia:</b> <x-grade-badge :letra="$student->equivalencia" /></li>
            </ul>
        @else
            <div class="card-body text-muted">Todavía no tienes información académica registrada.</div>
        @endif
    </div>
</div></div>
@endsection