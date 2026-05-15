<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassTracker - Faculty Portal</title>
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
    <nav class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center">
        <span class="text-xl font-bold text-blue-600 tracking-tight">ClassTracker Web</span>
        @if(auth()->check())
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-slate-600">Prof. {{ auth()->user()->name }}</span>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 font-semibold hover:underline">Sign Out</button>
                </form>
            </div>
        @endif
    </nav>

    <main class="max-w-7xl mx-auto p-6">
        @yield('content')
    </main>
</body>
</html>