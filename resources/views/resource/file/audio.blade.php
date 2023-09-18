<x-layout.default :title="$resource->title">
    <div class="d-flex align-items-center justify-content-center vh-100">
        <audio controls>
            <source src="{{ route('file.get', $resource->id) }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>
</x-layout.default>
