<nav style="background-color: #4A1040;" class="p-4 flex items-center justify-between">

    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="font-bold text-xl" style="color: #F5F0A0;">
        EasyColoc
    </a>

    <!-- Liens selon le rôle -->
    <div class="flex gap-4 items-center">

        <!-- Tous les utilisateurs connectés -->
        <a href="{{ route('colocations.index') }}" style="color: #F5C46A;">Colocations</a>
        <a href="{{ route('expenses.index') }}"    style="color: #F5C46A;">Dépenses</a>
        <a href="{{ route('payments.index') }}"    style="color: #F5C46A;">Paiements</a>

        <!-- Owner uniquement -->
        @if(auth()->user()->role === 'owner')
            <a href="{{ route('categories.index') }}" style="color: #F5C46A;">Catégories</a>
        @endif

        <!-- Admin uniquement -->
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" style="color: #F5C46A;">Admin Dashboard</a>
        @endif

    </div>

    <!-- Utilisateur connecté + Logout -->
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