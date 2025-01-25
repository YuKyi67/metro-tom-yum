<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-warning']) }}>
    {{ $slot }}
</button>
