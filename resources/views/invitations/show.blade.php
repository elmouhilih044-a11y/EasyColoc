@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 text-center">
        <div class="mb-6">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-orange-100">
                <span class="text-2xl">🏠</span>
            </div>
            <h2 class="mt-4 text-2xl font-bold text-gray-900">Invitation Reçue !</h2>
            <p class="mt-2 text-gray-600">
                <strong>{{ $invitation->invitedBy->name }}</strong> vous invite à rejoindre la colocation 
                <span class="font-bold text-indigo-600">{{ $invitation->colocation->name }}</span>.
            </p>
        </div>

        <div class="flex flex-col gap-3">
            <form action="{{ route('invitations.accept', $invitation->token) }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-3 px-4 rounded-xl text-white font-bold transition-all hover:scale-105 shadow-md" style="background-color: #B85C38;">
                    Accepter l'invitation
                </button>
            </form>

            <form action="{{ route('invitations.refuse', $invitation->token) }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-3 px-4 rounded-xl text-gray-700 font-bold border-2 border-gray-200 hover:bg-gray-50 transition-all">
                    Refuser
                </button>
            </form>
        </div>
    </div>
</div>
@endsection