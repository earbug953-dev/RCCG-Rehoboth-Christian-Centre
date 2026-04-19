<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — RCCG Rehoboth</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={theme:{extend:{colors:{navy:{DEFAULT:'#1e3a5f'},gold:{DEFAULT:'#c9a84c'}}}}}</script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Lato:wght@400;600&display=swap" rel="stylesheet">
    <style>body{font-family:'Lato',sans-serif;} h1,h2{font-family:'Playfair Display',serif;}</style>
</head>
<body class="min-h-screen bg-navy flex items-center justify-center px-4">

<div class="w-full max-w-md">
    {{-- Logo --}}
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-gold rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-navy font-bold text-3xl" style="font-family:'Playfair Display',serif">R</span>
        </div>
        <h1 class="text-white text-2xl font-bold">RCCG Rehoboth</h1>
        <p class="text-gold text-sm mt-1">Staff Admin Portal</p>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow-2xl p-8">
        <h2 class="text-navy text-xl font-bold mb-6 text-center">Sign In</h2>

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-5 text-sm">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-navy transition"
                       placeholder="admin@rccgrehoboth.org">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-navy transition"
                       placeholder="••••••••">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember" class="rounded">
                <label for="remember" class="text-sm text-gray-600">Remember me</label>
            </div>
            <button type="submit"
                    class="w-full bg-navy hover:bg-blue-900 text-white font-bold py-3 rounded-lg transition-colors text-sm">
                Sign In
            </button>
        </form>
    </div>

    <p class="text-center text-white/40 text-xs mt-6">
        <a href="{{ route('home') }}" class="hover:text-white/70 transition-colors">← Back to Church Website</a>
    </p>
</div>

</body>
</html>
