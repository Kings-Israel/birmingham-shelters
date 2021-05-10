@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-danger fs-6']) }}>{{ $message }}</p>
@enderror
