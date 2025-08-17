@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-lg text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
