@props(['title'])

<x-layout.default :title="$title">

    <x-slot name="styles">
        {{ $styles ?? '' }}
    </x-slot>

    @include('partials.header')

    {{ $slot }}

    <x-slot name="scripts">
        {{ $scripts ?? '' }}
    </x-slot>

</x-layout.default>
