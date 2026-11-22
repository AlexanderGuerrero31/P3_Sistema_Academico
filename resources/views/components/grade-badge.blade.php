@props(['letra'])
@php
    $color = match ($letra) {
        'AU' => 'success',
        'DE' => 'primary',
        'SA' => 'warning',
        default => 'danger',
    };
@endphp
<span class="badge text-bg-{{ $color }}">{{ $letra }}</span>