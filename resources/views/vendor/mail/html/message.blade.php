<x-mail::layout>
    {{-- Body --}}
    {{ $slot }}
    {{-- Subcopy --}}
    @isset($subcopy)
    <x-slot:subcopy>
        <x-mail::subcopy>
            {{ $subcopy }}
        </x-mail::subcopy>
    </x-slot:subcopy>
    @endisset
    
    {{-- Footer --}}
    <x-slot:footer>
        <x-mail::header :url="config('app.url')">
            {{ config('app.name') }}
        </x-mail::header>
        <x-mail::footer>
        © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>
