<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-grey-600 hover:bg-grey-700 border-grey-600 hover:border-grey-700 text-dark rounded-md mt-5']) }}>
    {{ $slot }}
</button>
