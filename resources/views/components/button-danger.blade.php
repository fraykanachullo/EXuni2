<button data-ripple-light="true" {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-red-700 to-red-600 active:from-red-600 active:to-red-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
