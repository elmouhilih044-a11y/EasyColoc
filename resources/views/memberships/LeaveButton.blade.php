{{-- Bouton à placer dans ta vue colocation (show ou index) --}}

@if($membership->left_at === null)
<form action="{{ route('memberships.leave', $membership) }}" method="POST" class="inline">
    @csrf
    <button class="px-3 py-1 rounded text-white text-sm"
            style="background-color: #8B2020;">
        Quitter la colocation
    </button>
</form>
@else
<span class="px-3 py-1 rounded text-sm"
      style="background-color: #D4894A; color: white;">
    Quitté le {{ $membership->left_at }}
</span>
@endif