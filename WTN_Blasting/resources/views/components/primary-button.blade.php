<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 bg-wtn-orange text-black font-semibold px-6 py-3 rounded-xl shadow-glow hover:bg-white transition text-sm']) }}>
    {{ $slot }}
</button>
