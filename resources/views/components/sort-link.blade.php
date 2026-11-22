@props(['field', 'label', 'sort', 'dir'])
@php
    $next = ($sort === $field && $dir === 'asc') ? 'desc' : 'asc';
    $flecha = $sort === $field ? ($dir === 'asc' ? '▲' : '▼') : '';
@endphp
<a href="{{ request()->fullUrlWithQuery(['sort' => $field, 'dir' => $next, 'page' => 1]) }}"
   class="text-decoration-none text-reset">{{ $label }} {{ $flecha }}</a>