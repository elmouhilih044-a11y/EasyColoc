@extends('layouts.app')

@section('content')
<div class="p-8 min-h-screen" style="background-color: #F5F0A0;">

    <h1 class="text-3xl font-bold mb-6" style="color: #000000;">
        Bonjour, {{ auth()->user()->name }} !
    </h1>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

        <div class="bg-white p-6 rounded-xl shadow text-center" style="border-top: 4px solid #B85C38;">
            <p class="text-lg font-semibold" style="color: #000000;">Mes Colocations</p>
            <a href="{{ route('colocations.index') }}"
               class="block mt-3 px-4 py-2 rounded font-semibold text-white"
               style="background-color: #B85C38;">
                Voir
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow text-center" style="border-top: 4px solid #D4894A;">
            <p class="text-lg font-semibold" style="color: #000000;">Mes Dettes</p>
            <p class="text-sm mt-1" style="color: #8B2020;">Accédez depuis une colocation</p>
        </div>

    </div>

</div>
@endsection