<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo-orinimo.png') }}">
    @include('layouts.styles.tailwind')
    <title>@yield('title', 'OriRecap Admin')</title>
    <style>
        :root {
            --brand: #7B1E1E;
            --brand-light: rgba(123,30,30,0.08);
            --brand-mid: rgba(123,30,30,0.15);
            --sidebar-w: 240px;
        }

        * { box-sizing: border-box; }

        body {
            background: #f5f6fa;
            font-family: ui-sans-serif, system-ui, sans-serif;
            color: #1e293b;
        }

        /* ── Sidebar ── */
        #sidebar {
            background: #fff;
            border-right: 1px solid #eef0f5;
            box-shadow: 2px 0 20px rgba(0,0,0,0.04);
        }

        .nav-group-label {
            padding: 20px 16px 6px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #b0b8c8;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 10px;
            font-size: 0.8125rem;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            transition: background .15s, color .15s, transform .15s;
            position: relative;
        }
        .sidebar-link:hover {
            background: var(--brand-light);
            color: var(--brand);
            transform: translateX(2px);
        }
        .sidebar-link.active {
            background: var(--brand-light);
            color: var(--brand);
            font-weight: 600;
        }
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 60%;
            background: var(--brand);
            border-radius: 0 3px 3px 0;
        }
        .sidebar-link .nav-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            transition: background .15s;
            flex-shrink: 0;
        }
        .sidebar-link:hover .nav-icon,
        .sidebar-link.active .nav-icon {
            background: var(--brand-mid);
        }

        /* ── Header ── */
        #main-header {
            background: #fff;
            border-bottom: 1px solid #eef0f5;
            backdrop-filter: blur(8px);
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #dde1ea; border-radius: 4px; }

        /* ── Page fade-in ── */
        @keyframes pageFadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        #page-main {
            animation: pageFadeUp .35s ease both;
        }

        /* ── Card hover ── */
        .stat-card {
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        /* ── Logo pulse dot ── */
        .logo-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--brand);
            animation: pulse 2.2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: .5; transform: scale(.75); }
        }

        /* ── Overlay ── */
        #sidebar-overlay { backdrop-filter: blur(4px); }

        /* ── Alert entrance ── */
        .alert-enter {
            animation: pageFadeUp .3s ease both;
        }

        /* ── Badge ── */
        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: currentColor;
            display: inline-block;
            margin-right: 4px;
            opacity: .7;
        }

        /* ── Logout btn ── */
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 0.8125rem;
            font-weight: 500;
            color: #94a3b8;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: background .15s, color .15s;
            text-align: left;
        }
        .logout-btn:hover {
            background: #fff1f2;
            color: #ef4444;
        }

        /* ── User avatar ── */
        .user-avatar {
            width: 32px; height: 32px;
            border-radius: 10px;
            background: var(--brand-light);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: var(--brand);
            flex-shrink: 0;
        }

        /* ── Stagger list items ── */
        .stagger-item {
            animation: pageFadeUp .3s ease both;
        }
        .stagger-item:nth-child(1) { animation-delay: .04s; }
        .stagger-item:nth-child(2) { animation-delay: .08s; }
        .stagger-item:nth-child(3) { animation-delay: .12s; }
        .stagger-item:nth-child(4) { animation-delay: .16s; }
        .stagger-item:nth-child(5) { animation-delay: .20s; }
        .stagger-item:nth-child(6) { animation-delay: .24s; }

        /* ── Breadcrumb divider ── */
        .breadcrumb-sep { color: #cbd5e1; }
    </style>
</head>
<body>
    <div class="min-h-screen flex">

        <!-- Overlay Mobile -->
        <div id="sidebar-overlay"
            class="fixed inset-0 z-40 hidden bg-black/20 md:hidden"></div>

        <!-- ═══ Sidebar ═══ -->
        <aside id="sidebar"
            class="fixed left-0 top-0 z-50 h-full flex flex-col -translate-x-full transition-transform duration-300 md:static md:z-auto md:translate-x-0"
            style="width:var(--sidebar-w); flex-shrink:0;">

            <!-- Logo area -->
            <div class="px-5 py-5 border-b border-slate-50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div style="width:36px;height:36px;border-radius:10px;background:var(--brand);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-sm font-bold text-slate-800 tracking-tight">OriRecap</span>
                            <span class="logo-dot"></span>
                        </div>
                        <p class="text-[10px] text-slate-400 font-medium tracking-widest uppercase">Admin Panel</p>
                    </div>
                </div>
                <button id="close-sidebar" type="button"
                    class="cursor-pointer rounded-lg p-1 text-slate-400 hover:text-slate-600 hover:bg-slate-100 md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-2 px-2">
                <p class="nav-group-label">Menu Utama</p>

                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                    </span>
                    Dashboard
                </a>

                <a href="{{ route('admin.netflix-accounts.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.netflix-accounts.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 10c0 3.866-3 7-3 7s-3-3.134-3-7a3 3 0 0 1 6 0Z"/><circle cx="12" cy="10" r="1"/><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0Z" opacity=".3"/></svg>
                    </span>
                    Rekapan Netflix
                </a>

                <a href="{{ route('admin.netflix-week-accounts.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.netflix-week-accounts.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
                    </span>
                    Netflix 1 Week
                </a>

                <a href="{{ route('admin.reminders.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.reminders.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                    </span>
                    Reminder
                </a>
            </nav>

            <!-- Bottom user/logout -->
            <div class="p-3 border-t border-slate-50">
                <div class="flex items-center gap-2.5 px-2 py-2 mb-1">
                    <div class="user-avatar">A</div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-semibold text-slate-700 truncate">Admin</p>
                        <p class="text-[10px] text-slate-400 truncate">Sistem Orinimo</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- ═══ Main Content ═══ -->
        <div class="flex-1 min-w-0 flex flex-col overflow-hidden">

            <!-- Top Header -->
            <header id="main-header" class="sticky top-0 z-30 px-5 py-3 flex items-center gap-4">
                <button id="open-sidebar" type="button"
                    class="cursor-pointer rounded-xl p-2 text-slate-500 hover:bg-slate-100 md:hidden transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                </button>

                <div class="flex-1 flex items-center gap-2">
                    <span class="text-xs text-slate-400 breadcrumb-sep hidden sm:inline">Orinimo</span>
                    <span class="text-slate-300 breadcrumb-sep hidden sm:inline">/</span>
                    <h2 class="text-sm font-semibold text-slate-800">@yield('page-title', 'Dashboard')</h2>
                </div>

                <div class="flex items-center gap-2">
                    <div class="hidden sm:flex items-center gap-1.5 rounded-xl bg-slate-50 border border-slate-100 px-3 py-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-xs text-slate-500 font-medium">Online</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main id="page-main" class="flex-1 p-5 sm:p-6 overflow-y-auto">
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

        if (openSidebarButton) openSidebarButton.addEventListener('click', openSidebar);
        if (closeSidebarButton) closeSidebarButton.addEventListener('click', closeSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);

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