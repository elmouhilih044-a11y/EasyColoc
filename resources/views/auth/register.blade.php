<x-guest-layout>
<div style="background-color:#F5F0A0;min-height:100vh;" class="flex flex-col items-center justify-center">
    <h1 class="text-3xl font-bold mb-6" style="color:#0D0D0D;">EasyColoc</h1>
    <div class="bg-white p-8 rounded-xl shadow w-96">
        <h2 class="text-2xl font-bold mb-6" style="color:#0D0D0D;">S'inscrire</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <x-input-label for="email" :value="__('Email')" class="mt-4 block" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-label for="password" :value="__('Password')" class="mt-4 block" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="mt-4 block" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}" class="text-sm font-semibold" style="color:#B85C38;">
                    Deja inscrit ?
                </a>
                <button type="submit" class="px-6 py-2 rounded font-bold text-white" style="background-color:#0D0D0D;">
                    S'inscrire
                </button>
            </div>
        </form>
    </div>
</div>
</x-guest-layout>