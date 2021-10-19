<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
<form method="POST" action="{{ route('verification.code.post') }}">

    @csrf

    <!-- Code -->
    <div>
        <x-label for="code" :value="__('code')" />

        <x-input id="email" class="block mt-1 w-full" type="string" name="code" :value="old('code')" required autofocus />
    </div>

        <x-button class="ml-3">
            {{ __('send') }}
        </x-button>
    </div>
</form>
</x-auth-card>
</x-guest-layout>
