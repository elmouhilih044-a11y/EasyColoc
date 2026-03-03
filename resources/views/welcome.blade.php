<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EasyColoc</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body{margin:0;display:flex;flex-direction:column;min-height:100vh;}main{flex:1;}</style>
</head>
<body style="background-color:#F5F0A0;font-family:Figtree,sans-serif;">
<nav style="background-color:#0D0D0D;" class="p-4 flex items-center justify-between">
    <span class="font-bold text-xl" style="color:#F5F0A0;">EasyColoc</span>
    <div class="flex gap-4">
        @auth
            <a href="{{ route('colocations.index') }}" class="px-4 py-2 rounded font-semibold" style="background-color:#B85C38;color:#F5F0A0;">Mon espace</a>
        @else
            <a href="{{ route('login') }}" class="px-4 py-2 rounded font-semibold" style="color:#F5F0A0;">Connexion</a>
            <a href="{{ route('register') }}" class="px-4 py-2 rounded font-semibold" style="background-color:#8B2020;color:#F5F0A0;">S'inscrire</a>
        @endauth
    </div>
</nav>
<main>
    <div class="flex flex-col items-center justify-center text-center py-24 px-6">
        <h1 class="text-5xl font-bold mb-4" style="color:#0D0D0D;">Gerez votre colocation facilement</h1>
        <p class="text-xl mb-10 max-w-xl" style="color:#6B1A1A;">Suivez vos depenses, calculez les remboursements et gerez vos membres.</p>
        @auth
            <a href="{{ route('colocations.index') }}" class="px-8 py-3 rounded-xl font-bold text-lg" style="background-color:#0D0D0D;color:#F5F0A0;">Mon espace</a>
        @else
            <a href="{{ route('register') }}" class="px-8 py-3 rounded-xl font-bold text-lg" style="background-color:#0D0D0D;color:#F5F0A0;">Commencer gratuitement</a>
        @endauth
    </div>
    <div class="flex flex-wrap justify-center gap-6 px-8 pb-20">
        <div class="bg-white p-6 rounded-xl shadow w-64 text-center" style="border-top:4px solid #B85C38;">
            <div class="text-4xl mb-3">🏠</div>
            <h3 class="font-bold text-lg mb-2" style="color:#0D0D0D;">Colocations</h3>
            <p style="color:#6B1A1A;">Creez et gerez vos colocations facilement.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow w-64 text-center" style="border-top:4px solid #D4894A;">
            <div class="text-4xl mb-3">💰</div>
            <h3 class="font-bold text-lg mb-2" style="color:#0D0D0D;">Depenses</h3>
            <p style="color:#6B1A1A;">Suivez toutes les depenses partagees.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow w-64 text-center" style="border-top:4px solid #8B2020;">
            <div class="text-4xl mb-3">⚖️</div>
            <h3 class="font-bold text-lg mb-2" style="color:#0D0D0D;">Remboursements</h3>
            <p style="color:#6B1A1A;">Calculez automatiquement qui doit quoi a qui.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow w-64 text-center" style="border-top:4px solid #6B1A1A;">
            <div class="text-4xl mb-3">✉️</div>
            <h3 class="font-bold text-lg mb-2" style="color:#0D0D0D;">Invitations</h3>
            <p style="color:#6B1A1A;">Invitez vos colocataires par email.</p>
        </div>
    </div>
</main>
<footer class="text-center py-6" style="background-color:#0D0D0D;color:#F5C46A;">
    EasyColoc &copy; {{ date('Y') }}
</footer>
</body>
</html>