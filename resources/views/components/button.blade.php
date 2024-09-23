<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md mt-5']) }}>
    {{ $slot }}
</button>
