<div class="mb-3">
    <label class="form-label">Nombre del alumno</label>
    <input name="name" value="{{ old('name', $student->user->name ?? '') }}"
           class="form-control @error('name') is-invalid @enderror" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label">Correo electrónico</label>
    <input type="email" name="email" value="{{ old('email', $student->user->email ?? '') }}"
           class="form-control @error('email') is-invalid @enderror" required>
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label">Contraseña @isset($student)<small class="text-muted">(vacía para no cambiarla)</small>@endisset</label>
    <input type="password" name="password"
           class="form-control @error('password') is-invalid @enderror" @empty($student) required @endempty>
    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label">Confirmar contraseña</label>
    <input type="password" name="password_confirmation" class="form-control">
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Faltas (0 a 50)</label>
        <input type="number" name="faltas" min="0" max="50" value="{{ old('faltas', $student->faltas ?? 0) }}"
               class="form-control @error('faltas') is-invalid @enderror" required>
        @error('faltas') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Calificación (0 a 10)</label>
        <input type="number" step="0.01" name="calificacion" value="{{ old('calificacion', $student->calificacion ?? 0) }}"
               class="form-control @error('calificacion') is-invalid @enderror" required>
        @error('calificacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
<p class="text-muted small">La equivalencia alfabética se genera automáticamente.</p>