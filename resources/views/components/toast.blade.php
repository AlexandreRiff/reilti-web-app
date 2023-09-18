<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div {{ $attributes->merge(['class' => 'toast py-2']) }}>
        <div class="toast-body">
            {{ $slot }}
        </div>
    </div>
</div>
