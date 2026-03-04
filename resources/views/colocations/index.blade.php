@extends('layouts.app')

@section('content')
<div class="p-8 min-h-screen" style="background-color: #F5F0A0;">

    <h1 class="text-3xl font-bold mb-6" style="color: #000000;">Colocations</h1>

    <a href="{{ route('colocations.create') }}"
       class="px-4 py-2 rounded text-white font-semibold"
       style="background-color: #8B2020;">
        + Ajouter
    </a>

    @if(session('success'))
        <p class="mt-3 font-semibold" style="color: #8B2020;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p class="mt-3 font-semibold" style="color: #8B2020;">{{ session('error') }}</p>
    @endif

    <div class="mt-6 rounded-xl shadow overflow-hidden">
        <table class="w-full">
            <thead style="background-color: #000000; color: #F5F0A0;">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Nom</th>
                    <th class="p-3 text-left">Description</th>
                    <th class="p-3 text-left">Statut</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($colocations as $colocation)
                <tr style="background-color: white; border-bottom: 1px solid #D4894A;">
                    <td class="p-3">{{ $colocation->id }}</td>
                    <td class="p-3">{{ $colocation->name }}</td>
                    <td class="p-3">{{ $colocation->description }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-white text-sm"
                              style="background-color: {{ $colocation->status === 'active' ? '#B85C38' : '#8B2020' }};">
                            {{ $colocation->status }}
                        </span>
                    </td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('colocations.show', $colocation) }}"
                           class="px-3 py-1 rounded text-white text-sm"
                           style="background-color: #D4894A;">Voir</a>
                        @if(isset($myMemberships[$colocation->id]) && $myMemberships[$colocation->id] === 'owner')
                        <a href="{{ route('colocations.edit', $colocation) }}"
                           class="px-3 py-1 rounded text-white text-sm"
                           style="background-color: #B85C38;">Modifier</a>
                        <form action="{{ route('colocations.destroy', $colocation) }}"
                              method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 rounded text-white text-sm"
                                    style="background-color: #000000;">Supprimer</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection