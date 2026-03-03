<x-guest-layout>
<div style="background-color:#F5F0A0;min-height:100vh;" class="flex flex-col items-center justify-center">
    <h1 class="text-3xl font-bold mb-6" style="color:#0D0D0D;">EasyColoc</h1>
    <div class="bg-white p-8 rounded-xl shadow w-96">
        <h2 class="text-2xl font-bold mb-6" style="color:#0D0D0D;">Connexion</h2>
        @if (session('status'))
            <div class="mb-4 text-sm" style="color:#B85C38;">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-label for="password" :value="__('Password')" class="mt-4 block" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('register') }}" class="text-sm font-semibold" style="color:#B85C38;">
                    S'inscrire
                </a>
                <button type="submit" class="px-6 py-2 rounded font-bold text-white" style="background-color:#0D0D0D;">
                    Se connecter
                </button>
            </div>
        </form>
    </div>
</div>
</x-guest-layout>