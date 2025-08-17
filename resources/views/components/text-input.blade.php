@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#E63946] focus:ring-[#E63946] rounded-md shadow-sm']) }}>
