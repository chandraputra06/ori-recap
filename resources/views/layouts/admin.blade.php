<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo-orinimo.png') }}">
    @vite('resources/css/app.css')
    <title>@yield('title', 'Orinimo Recap')</title>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="hidden w-64 bg-white shadow-md md:block">
            <div class="border-b border-gray-200 px-6 py-5">
                <h1 class="text-2xl font-bold text-[#7B1E1E]">Orinimo Recap</h1>
                <p class="mt-1 text-sm text-gray-500">Admin Panel</p>
            </div>

            <nav class="space-y-2 p-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="block rounded-lg px-4 py-2.5 font-medium transition
           {{ request()->routeIs('admin.dashboard')
               ? 'bg-[#7B1E1E]/10 text-[#7B1E1E]'
               : 'text-gray-700 hover:bg-[#7B1E1E]/10 hover:text-[#7B1E1E]' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.netflix-accounts.index') }}"
                    class="block rounded-lg px-4 py-2.5 font-medium transition
           {{ request()->routeIs('admin.netflix-accounts.*')
               ? 'bg-[#7B1E1E]/10 text-[#7B1E1E]'
               : 'text-gray-700 hover:bg-[#7B1E1E]/10 hover:text-[#7B1E1E]' }}">
                    Rekapan Netflix
                </a>

                <a href="{{ route('admin.netflix-week-accounts.index') }}"
                    class="block rounded-lg px-4 py-2.5 font-medium transition
                {{ request()->routeIs('admin.netflix-week-accounts.*')
                    ? 'bg-[#7B1E1E]/10 text-[#7B1E1E]'
                    : 'text-gray-700 hover:bg-[#7B1E1E]/10 hover:text-[#7B1E1E]' }}">
                    Netflix 1 Week
                </a>

                <a href="{{ route('admin.reminders.index') }}"
                    class="block rounded-lg px-4 py-2.5 font-medium transition
            {{ request()->routeIs('admin.reminders.*')
                ? 'bg-[#7B1E1E]/10 text-[#7B1E1E]'
                : 'text-gray-700 hover:bg-[#7B1E1E]/10 hover:text-[#7B1E1E]' }}">
                    Reminder
                </a>
            </nav>
        </aside>

        <!-- Main -->
        <div class="flex-1">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h2 class="text-xl font-semibold text-[#7B1E1E]">
                            @yield('page-title', 'Dashboard')
                        </h2>
                        <p class="text-sm text-gray-500">
                            Sistem Rekapan Orinimo
                        </p>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="cursor-pointer rounded-lg bg-[#7B1E1E] px-4 py-2 text-sm font-medium text-white hover:opacity-90">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function togglePassword(button) {
            const targetId = button.getAttribute('data-target');
            const passwordText = document.getElementById(targetId);

            if (!passwordText) return;

            const hiddenValue = passwordText.getAttribute('data-hidden');
            const fullValue = passwordText.getAttribute('data-full');

            if (passwordText.textContent.trim() === hiddenValue) {
                passwordText.textContent = fullValue;
                button.textContent = 'Sembunyikan';
            } else {
                passwordText.textContent = hiddenValue;
                button.textContent = 'Lihat';
            }
        }
    </script>
</body>

</html>
