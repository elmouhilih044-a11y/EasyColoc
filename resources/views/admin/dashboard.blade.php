<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background-color: #4A1040; color: #F5F0A0;">

<!-- Header -->
<header style="background-color: #6B1A1A; border-bottom: 2px solid #8B2020;" class="p-6 text-center">
    <h1 class="text-3xl font-bold" style="color: #F5F0A0;">Admin Dashboard</h1>
</header>

<!-- Statistiques -->
<div class="flex flex-wrap justify-center mt-8 gap-6">
    <div class="p-6 rounded-lg shadow-lg w-64 text-center" style="background-color: #6B1A1A; border: 1px solid #8B2020;">
        <h2 class="text-xl font-semibold mb-2" style="color: #F5C46A;">Total Users</h2>
        <p class="text-3xl font-bold" style="color: #F5F0A0;">{{ $totalUsers }}</p>
    </div>
    <div class="p-6 rounded-lg shadow-lg w-64 text-center" style="background-color: #6B1A1A; border: 1px solid #8B2020;">
        <h2 class="text-xl font-semibold mb-2" style="color: #F5C46A;">Total Colocations</h2>
        <p class="text-3xl font-bold" style="color: #F5F0A0;">{{ $totalColocations }}</p>
    </div>
    <div class="p-6 rounded-lg shadow-lg w-64 text-center" style="background-color: #6B1A1A; border: 1px solid #8B2020;">
        <h2 class="text-xl font-semibold mb-2" style="color: #F5C46A;">Banned Users</h2>
        <p class="text-3xl font-bold" style="color: #F5F0A0;">{{ $bannedUsers }}</p>
    </div>
</div>

<!-- Message succès -->
@if(session('success'))
    <div class="p-4 rounded-md w-11/12 max-w-3xl mx-auto mt-6 text-center"
         style="background-color: #B85C38; color: #F5F0A0;">
        {{ session('success') }}
    </div>
@endif

<!-- Table utilisateurs -->
<div class="overflow-x-auto mt-8 w-11/12 max-w-6xl mx-auto mb-10">
    <table class="min-w-full rounded-lg overflow-hidden" style="border: 1px solid #8B2020;">
        <thead style="background-color: #8B2020;">
            <tr>
                <th class="py-3 px-6 text-left" style="color: #F5F0A0;">ID</th>
                <th class="py-3 px-6 text-left" style="color: #F5F0A0;">Name</th>
                <th class="py-3 px-6 text-left" style="color: #F5F0A0;">Email</th>
                <th class="py-3 px-6 text-left" style="color: #F5F0A0;">Role</th>
                <th class="py-3 px-6 text-left" style="color: #F5F0A0;">Status</th>
                <th class="py-3 px-6 text-left" style="color: #F5F0A0;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr style="border-bottom: 1px solid #8B2020; background-color: #6B1A1A;">
                <td class="py-3 px-6" style="color: #F5C46A;">{{ $user->id }}</td>
                <td class="py-3 px-6" style="color: #F5F0A0;">{{ $user->name }}</td>
                <td class="py-3 px-6" style="color: #F5F0A0;">{{ $user->email }}</td>
                <td class="py-3 px-6" style="color: #F5C46A;">{{ $user->role }}</td>
                <td class="py-3 px-6">
                    @if($user->is_banned)
                        <span class="px-2 py-1 rounded text-sm" style="background-color: #4A1040; color: #F5C46A;">Banned</span>
                    @else
                        <span class="px-2 py-1 rounded text-sm" style="background-color: #D4894A; color: #F5F0A0;">Active</span>
                    @endif
                </td>
                <td class="py-3 px-6">
                    <form action="{{ route('users.toggleBan', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="py-1 px-3 rounded font-semibold"
                                style="background-color: {{ $user->is_banned ? '#D4894A' : '#4A1040' }};
                                       color: #F5F0A0;
                                       border: 1px solid {{ $user->is_banned ? '#F5C46A' : '#8B2020' }};">
                            @if($user->is_banned)
                                Unban
                            @else
                                Ban
                            @endif
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>