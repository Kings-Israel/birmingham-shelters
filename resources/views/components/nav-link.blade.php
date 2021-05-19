@props(['active' => false])

<a {{ $attributes->class([ 'nav-item', 'active' => $active ]) }}>
    {{ $slot }}
</a>
