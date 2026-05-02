@extends('layouts.admin')

@section('title', 'Dashboard - OriRecap')
@section('page-title', 'Dashboard')

@section('content')
<style>
    .stat-num {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
        letter-spacing: -.03em;
    }
    .stat-card {
        transition: transform .2s ease, box-shadow .2s ease;
        cursor: pointer;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.09);
    }
    .stat-icon {
        width: 38px; height: 38px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .detail-row {
        transition: background .15s;
    }
    .detail-row:hover {
        background: #f8fafc;
    }
    .section-bar {
        width: 3px; height: 18px;
        background: #7B1E1E;
        border-radius: 2px;
    }
    @keyframes statIn {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .stat-card { animation: statIn .4s ease both; }
    .stat-card:nth-child(1) { animation-delay: .04s; }
    .stat-card:nth-child(2) { animation-delay: .09s; }
    .stat-card:nth-child(3) { animation-delay: .14s; }
    .stat-card:nth-child(4) { animation-delay: .19s; }

    /* Mini stat cards */
    .mini-stat {
        transition: transform .2s ease, box-shadow .2s ease;
        cursor: pointer;
    }
    .mini-stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.07);
    }

    /* Panel section */
    .panel-card {
        border-radius: 18px;
        background: #fff;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        overflow: hidden;
    }
</style>

<div class="space-y-6">

    {{-- ── Welcome strip ── --}}
    <div class="rounded-2xl overflow-hidden relative" style="background: linear-gradient(135deg, #7B1E1E 0%, #9e2a2a 100%);">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 80% 50%, white 1px, transparent 1px); background-size: 20px 20px;"></div>
        <div class="relative px-6 py-5 flex items-center justify-between">
            <div>
                <p class="text-white/60 text-xs font-medium tracking-wide">Selamat datang</p>
                <h2 class="text-white text-xl font-bold mt-0.5">Sistem Rekapan Orinimo</h2>
            </div>
            <div class="hidden sm:flex items-center gap-1.5 rounded-xl bg-white/15 border border-white/20 px-3 py-2">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                <span class="text-white text-xs font-medium">{{ now()->isoFormat('D MMMM Y') }}</span>
            </div>
        </div>
    </div>

    {{-- ── Stats Row 1 ── --}}
    <div>
        <div class="flex items-center gap-2 mb-3">
            <div class="section-bar"></div>
            <p class="text-sm font-semibold text-slate-700">Ringkasan Data</p>
        </div>
        <div class="grid grid-cols-2 gap-3 xl:grid-cols-4">

            <a href="{{ route('admin.netflix-accounts.index') }}" class="stat-card block rounded-2xl bg-white border border-slate-100 p-5 shadow-sm">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon bg-red-50">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#7B1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 10c0 3.866-3 7-3 7s-3-3.134-3-7a3 3 0 0 1 6 0Z"/><circle cx="12" cy="10" r="1"/></svg>
                    </div>
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </div>
                <div class="stat-num text-slate-800">{{ $totalNetflixAccounts }}</div>
                <p class="mt-1.5 text-xs text-slate-400 font-medium">Total Rekapan Netflix</p>
            </a>

            <a href="{{ route('admin.netflix-week-accounts.index') }}" class="stat-card block rounded-2xl bg-white border border-slate-100 p-5 shadow-sm">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon bg-red-50">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#7B1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"/><path d="m9 16 2 2 4-4"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                    </div>
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </div>
                <div class="stat-num text-slate-800">{{ $totalNetflixWeekAccounts }}</div>
                <p class="mt-1.5 text-xs text-slate-400 font-medium">Total Netflix 1 Week</p>
            </a>

            <a href="{{ route('admin.reminders.index') }}" class="stat-card block rounded-2xl bg-white border border-slate-100 p-5 shadow-sm">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon bg-orange-50">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                    </div>
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </div>
                <div class="stat-num text-orange-500">{{ $resetHariIni }}</div>
                <p class="mt-1.5 text-xs text-slate-400 font-medium">Reset Hari Ini</p>
            </a>

            <a href="{{ route('admin.reminders.index') }}" class="stat-card block rounded-2xl bg-white border border-slate-100 p-5 shadow-sm">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon bg-red-50">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                    </div>
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </div>
                <div class="stat-num text-red-500">{{ $habisHariIni }}</div>
                <p class="mt-1.5 text-xs text-slate-400 font-medium">Habis Hari Ini</p>
            </a>
        </div>
    </div>

    {{-- ── Stats Row 2: Mini badges ── --}}
    <div class="grid grid-cols-2 gap-3 xl:grid-cols-4">

        <a href="{{ route('admin.reminders.index') }}" class="mini-stat block rounded-2xl bg-white border border-slate-100 p-4 shadow-sm">
            <div class="flex items-center gap-2 mb-2.5">
                <span class="w-2 h-2 rounded-full bg-yellow-400 flex-shrink-0"></span>
                <p class="text-xs text-slate-400 font-medium">Segera Reset</p>
            </div>
            <div class="stat-num" style="font-size:1.6rem;color:#eab308;">{{ $segeraReset }}</div>
        </a>

        <a href="{{ route('admin.reminders.index') }}" class="mini-stat block rounded-2xl bg-white border border-slate-100 p-4 shadow-sm">
            <div class="flex items-center gap-2 mb-2.5">
                <span class="w-2 h-2 rounded-full bg-red-400 flex-shrink-0"></span>
                <p class="text-xs text-slate-400 font-medium">Lewat Reset</p>
            </div>
            <div class="stat-num" style="font-size:1.6rem;color:#ef4444;">{{ $lewatReset }}</div>
        </a>

        <a href="{{ route('admin.reminders.index') }}" class="mini-stat block rounded-2xl bg-white border border-slate-100 p-4 shadow-sm">
            <div class="flex items-center gap-2 mb-2.5">
                <span class="w-2 h-2 rounded-full bg-yellow-400 flex-shrink-0"></span>
                <p class="text-xs text-slate-400 font-medium">Segera Habis</p>
            </div>
            <div class="stat-num" style="font-size:1.6rem;color:#eab308;">{{ $segeraHabis }}</div>
        </a>

        <a href="{{ route('admin.reminders.index') }}" class="mini-stat block rounded-2xl bg-white border border-slate-100 p-4 shadow-sm">
            <div class="flex items-center gap-2 mb-2.5">
                <span class="w-2 h-2 rounded-full bg-red-400 flex-shrink-0"></span>
                <p class="text-xs text-slate-400 font-medium">Sudah Habis</p>
            </div>
            <div class="stat-num" style="font-size:1.6rem;color:#ef4444;">{{ $sudahHabis }}</div>
        </a>
    </div>

    {{-- ── Detail Panels ── --}}
    <div class="grid grid-cols-1 gap-5 xl:grid-cols-2">

        {{-- Reset Terdekat --}}
        <div class="panel-card">
            <div class="px-5 py-4 border-b border-slate-50 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="section-bar" style="height:14px;"></div>
                    <h3 class="text-sm font-semibold text-slate-800">Reset Terdekat</h3>
                </div>
                <a href="{{ route('admin.netflix-accounts.index') }}"
                   class="text-xs font-medium text-[#7B1E1E] hover:underline flex items-center gap-1">
                    Lihat Semua
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>

            <div class="divide-y divide-slate-50">
                @forelse ($resetTerdekat as $item)
                    <div class="detail-row px-5 py-3.5">
                        <div class="flex items-center justify-between gap-3">
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-slate-400">{{ $item->tipe_sharing }}</span>
                                    <span class="text-slate-200">·</span>
                                    <span class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($item->tanggal_reset)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $item->status_reset['class'] }}">
                                    {{ $item->status_reset['label'] }}
                                </span>
                                <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}"
                                   class="rounded-lg bg-[#7B1E1E] px-2.5 py-1.5 text-xs font-medium text-white hover:opacity-85 transition-opacity">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-5 py-10 text-center">
                        <div style="width:40px;height:40px;border-radius:12px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                        </div>
                        <p class="text-sm text-slate-400">Belum ada data tanggal reset.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Durasi Habis Terdekat --}}
        <div class="panel-card">
            <div class="px-5 py-4 border-b border-slate-50 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="section-bar" style="height:14px;"></div>
                    <h3 class="text-sm font-semibold text-slate-800">Durasi Habis Terdekat</h3>
                </div>
                <a href="{{ route('admin.netflix-week-accounts.index') }}"
                   class="text-xs font-medium text-[#7B1E1E] hover:underline flex items-center gap-1">
                    Lihat Semua
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>

            <div class="divide-y divide-slate-50">
                @forelse ($habisTerdekat as $item)
                    <div class="detail-row px-5 py-3.5">
                        <div class="flex items-center justify-between gap-3">
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-slate-400">Terjual: {{ $item->tanggal_terjual ? \Carbon\Carbon::parse($item->tanggal_terjual)->format('d/m/Y') : '-' }}</span>
                                    <span class="text-slate-200">·</span>
                                    <span class="text-xs text-slate-500">Habis: {{ \Carbon\Carbon::parse($item->durasi_habis)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $item->status_habis['class'] }}">
                                    {{ $item->status_habis['label'] }}
                                </span>
                                <a href="{{ route('admin.netflix-week-accounts.edit', $item->id) }}"
                                   class="rounded-lg bg-[#7B1E1E] px-2.5 py-1.5 text-xs font-medium text-white hover:opacity-85 transition-opacity">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-5 py-10 text-center">
                        <div style="width:40px;height:40px;border-radius:12px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                        </div>
                        <p class="text-sm text-slate-400">Belum ada data durasi habis.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection