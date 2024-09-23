<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-red-600 hover:bg-red-700 border-red-600 hover:border-red-700 text-white rounded-md mt-5']) }}>
    {{ $slot }}
</button>
