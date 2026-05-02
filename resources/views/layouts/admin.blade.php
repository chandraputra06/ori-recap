<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo-orinimo.png') }}">
    @include('layouts.styles.tailwind')
    <title>@yield('title', 'OriRecap Admin')</title>
    <style>
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.18s ease;
            color: #6b7280;
            text-decoration: none;
        }
        .sidebar-link:hover {
            background: rgba(123, 30, 30, 0.07);
            color: #7B1E1E;
        }
        .sidebar-link.active {
            background: rgba(123, 30, 30, 0.10);
            color: #7B1E1E;
            font-weight: 600;
        }
        .sidebar-link .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            flex-shrink: 0;
            opacity: 0.5;
        }
        .sidebar-link.active .dot {
            opacity: 1;
        }
        #sidebar {
            border-right: 1px solid #f1f5f9;
        }
    </style>
</head>
<body class="bg-slate-50 text-gray-800">
    <div class="min-h-screen flex">
        <!-- Overlay Mobile -->
        <div id="sidebar-overlay"
            class="fixed inset-0 z-40 hidden bg-black/30 backdrop-blur-sm md:hidden">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed left-0 top-0 z-50 h-full w-60 -translate-x-full bg-white transition-transform duration-300 md:static md:z-auto md:block md:translate-x-0 flex flex-col">

            <!-- Logo -->
            <div class="px-5 py-6 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-bold text-[#7B1E1E] tracking-tight">Orinimo Recapitulation</h1>
                        <p class="text-xs text-slate-400 mt-0.5 font-medium uppercase tracking-widest">Admin Panel</p>
                    </div>
                    <button id="close-sidebar" type="button"
                        class="cursor-pointer rounded-lg p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-3 space-y-0.5 overflow-y-auto">
                <p class="px-3 pt-3 pb-1.5 text-[10px] font-semibold text-slate-400 uppercase tracking-widest">Menu</p>

                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="dot"></span>
                    Dashboard
                </a>

                <a href="{{ route('admin.netflix-accounts.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.netflix-accounts.*') ? 'active' : '' }}">
                    <span class="dot"></span>
                    Rekapan Netflix
                </a>

                <a href="{{ route('admin.netflix-week-accounts.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.netflix-week-accounts.*') ? 'active' : '' }}">
                    <span class="dot"></span>
                    Netflix 1 Week
                </a>

                <a href="{{ route('admin.reminders.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.reminders.*') ? 'active' : '' }}">
                    <span class="dot"></span>
                    Reminder
                </a>
            </nav>

            <!-- User / Logout -->
            <div class="p-3 border-t border-slate-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="cursor-pointer w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-500 hover:bg-red-50 hover:text-red-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 min-w-0 flex flex-col">
            <!-- Top Header -->
            <header class="bg-white border-b border-slate-100 sticky top-0 z-30">
                <div class="flex items-center gap-4 px-5 py-3.5">
                    <button id="open-sidebar" type="button"
                        class="cursor-pointer rounded-lg p-1.5 text-slate-500 hover:bg-slate-100 md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                    </button>

                    <div>
                        <h2 class="text-base font-semibold text-slate-800">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-xs text-slate-400">Sistem Rekapan Orinimo</p>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-5 sm:p-6">
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