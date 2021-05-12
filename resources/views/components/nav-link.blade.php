@props(['active' => false])

<li {{ $attributes->class(['active' => $active]) }}>
    {{ $slot }}
</li>
