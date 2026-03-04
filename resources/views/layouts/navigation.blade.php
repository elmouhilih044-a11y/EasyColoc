<nav style="background-color: #000000;" class="p-4 flex items-center justify-between">

    <a href="{{ route('dashboard') }}" class="font-bold text-xl" style="color: #F5F0A0;">
        EasyColoc
    </a>

    <div class="flex gap-4 items-center">

        @if(auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}" style="color: #F5C46A;">Admin Dashboard</a>
        @else
            <a href="{{ route('colocations.index') }}" style="color: #F5C46A;">Colocations</a>
        @endif

    </div>

    <div class="flex items-center gap-4">
        <span style="color: #F5F0A0;">{{ auth()->user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="px-3 py-1 rounded font-semibold text-sm"
                    style="background-color: #8B2020; color: #F5F0A0;">
                Déconnexion
            </button>
        </form>
    </div>

</nav>