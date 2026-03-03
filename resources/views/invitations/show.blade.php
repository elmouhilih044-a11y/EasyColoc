@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96 text-center">

        <h1 class="text-2xl font-bold mb-4" style="color: #000000;">Invitation</h1>

        <p class="mb-2">
            <b>{{ $invitation->invitedBy->name }}</b> vous invite à rejoindre :
        </p>
        <p class="text-xl font-bold mb-6" style="color: #B85C38;">
            {{ $invitation->colocation->name }}
        </p>

        <div class="flex gap-4 justify-center">
            <form action="{{ route('invitations.accept', $invitation->token) }}" method="POST">
                @csrf
                <button class="px-6 py-2 rounded font-semibold text-white"
                        style="background-color: #000000;">Accepter</button>
            </form>
            <form action="{{ route('invitations.refuse', $invitation->token) }}" method="POST">
                @csrf
                <button class="px-6 py-2 rounded font-semibold text-white"
                        style="background-color: #8B2020;">Refuser</button>
            </form>
        </div>

    </div>
</div>
@endsection