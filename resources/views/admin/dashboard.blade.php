<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F2F2F2] text-[#0D0D0D]">

<!-- Header -->
<header class="bg-[#544D59] text-[#F2F2F2] p-6 text-center">
    <h1 class="text-3xl font-bold">Admin Dashboard</h1>
</header>

<!-- Statistiques -->
<div class="flex flex-wrap justify-center mt-6 gap-6">
    <div class="bg-[#E5D0F2] text-[#0D0D0D] p-6 rounded-lg shadow-lg w-64 text-center">
        <h2 class="text-xl font-semibold mb-2">Total Users</h2>
        <p class="text-2xl font-bold">{{ $totalUsers }}</p>
    </div>
    <div class="bg-[#E5D0F2] text-[#0D0D0D] p-6 rounded-lg shadow-lg w-64 text-center">
        <h2 class="text-xl font-semibold mb-2">Total Colocations</h2>
        <p class="text-2xl font-bold">{{ $totalColocations }}</p>
    </div>
    <div class="bg-[#E5D0F2] text-[#0D0D0D] p-6 rounded-lg shadow-lg w-64 text-center">
        <h2 class="text-xl font-semibold mb-2">Banned Users</h2>
        <p class="text-2xl font-bold">{{ $bannedUsers }}</p>
    </div>
</div>

<!-- Message succès -->
@if(session('success'))
    <div class="bg-[#E5D0F2] text-[#0D0D0D] p-4 rounded-md w-11/12 max-w-3xl mx-auto mt-6 text-center">
        {{ session('success') }}
    </div>
@endif

<!-- Table utilisateurs -->
<div class="overflow-x-auto mt-8 w-11/12 max-w-6xl mx-auto">
    <table class="min-w-full bg-[#9A8FA6] text-[#F2F2F2] rounded-lg overflow-hidden">
        <thead class="bg-[#544D59]">
            <tr>
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Email</th>
                <th class="py-3 px-6 text-left">Role</th>
                <th class="py-3 px-6 text-left">Status</th>
                <th class="py-3 px-6 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="even:bg-[#E5D0F2] even:text-[#0D0D0D]">
                <td class="py-3 px-6">{{ $user->id }}</td>
                <td class="py-3 px-6">{{ $user->name }}</td>
                <td class="py-3 px-6">{{ $user->email }}</td>
                <td class="py-3 px-6">{{ $user->role }}</td>
                <td class="py-3 px-6">
                    @if($user->is_banned)
                        Banned
                    @else
                        Active
                    @endif
                </td>
               <td class="py-3 px-6">
    <form action="{{ route('users.toggleBan', $user->id) }}" method="POST">
        @csrf
        <button type="submit"
                class="bg-[#0D0D0D] hover:bg-[#544D59] text-[#F2F2F2] py-1 px-3 rounded">
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