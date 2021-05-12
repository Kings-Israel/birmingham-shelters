@props(['type' => 'success'])

@php
    $classes = [
        'success' => 'alert-success',
        'error' => 'alert-danger',
    ];
@endphp

<div class="alert {{ $classes[$type] }} alert-dismissible fade show" role="alert">
    {{ $slot }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
