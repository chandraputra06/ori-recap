<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo-orinimo.png') }}">
    @vite('resources/css/app.css')
    <title>@yield('title', 'OriRecap Admin')</title>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen flex">
        <!-- Overlay Mobile -->
        <div id="sidebar-overlay"
            class="fixed inset-0 z-40 hidden bg-black/40 md:hidden">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed left-0 top-0 z-50 h-full w-64 -translate-x-full bg-white shadow-md transition-transform duration-300 md:static md:z-auto md:block md:translate-x-0">
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-5">
                <div>
                    <h1 class="text-2xl font-bold text-[#7B1E1E]">OriRecap</h1>
                    <p class="mt-1 text-sm text-gray-500">Admin Panel</p>
                </div>

                <button id="close-sidebar"
                    type="button"
                    class="cursor-pointer rounded-lg border border-gray-300 px-3 py-1 text-sm text-gray-700 md:hidden">
                    Tutup
                </button>
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
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-4 py-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <button id="open-sidebar"
                            type="button"
                            class="cursor-pointer rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-700 md:hidden">
                            Menu
                        </button>

                        <div>
                            <h2 class="text-xl font-semibold text-[#7B1E1E]">
                                @yield('page-title', 'Dashboard')
                            </h2>
                            <p class="text-sm text-gray-500">
                                Sistem Rekapan Orinimo
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button
                            type="submit"
                            class="cursor-pointer rounded-lg bg-[#7B1E1E] px-4 py-2 text-sm font-medium text-white hover:opacity-90"
                        >
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <main class="p-4 sm:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const openSidebarButton = document.getElementById('open-sidebar');
        const closeSidebarButton = document.getElementById('close-sidebar');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        if (openSidebarButton) {
            openSidebarButton.addEventListener('click', openSidebar);
        }

        if (closeSidebarButton) {
            closeSidebarButton.addEventListener('click', closeSidebar);
        }

        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

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