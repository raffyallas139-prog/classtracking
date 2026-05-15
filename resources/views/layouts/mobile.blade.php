<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>ClassTracker Mobile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-100 pb-20"> <header class="bg-white p-4 shadow-sm sticky top-0 z-50">
        <h1 class="text-center text-blue-600 font-bold text-lg">ClassTracker</h1>
    </header>

    <main class="p-4">
        @yield('content')
    </main>

    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t flex justify-around p-3 z-50">
        <a href="/mobile/dashboard" class="flex flex-col items-center text-blue-600">
            <span class="text-xs">Dashboard</span>
        </a>
        <a href="/mobile/search" class="flex flex-col items-center text-slate-400">
            <span class="text-xs">Search</span>
        </a>
        <a href="/login" class="flex flex-col items-center text-slate-400">
            <span class="text-xs">Account</span>
        </a>
    </nav>
</body>
</html>