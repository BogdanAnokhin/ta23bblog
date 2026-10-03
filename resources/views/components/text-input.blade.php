@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'input input-bordered w-full focus:outline-none focus:ring-2 focus:ring-primary']) }}>