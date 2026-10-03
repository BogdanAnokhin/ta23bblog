@props(['value'])

<label {{ $attributes->merge(['class' => 'label label-text font-semibold text-base-content']) }}>
    {{ $value ?? $slot }}
</label>