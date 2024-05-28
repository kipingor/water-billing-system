<select {{ $attributes->merge(['class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6']) }}>
    <option value="" disabled selected>Click to select</option>
    @foreach($options as $value => $label)
        <option {{ $isSelected($value) ? 'selected' : '' }} value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>