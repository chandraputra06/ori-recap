@extends('layouts.admin')

@section('title', 'Reminder - OriRecap')
@section('page-title', 'Reminder')

@section('content')
<style>
    .section-bar { width:3px;height:18px;background:#7B1E1E;border-radius:2px; }

    /* Reminder panel */
    .reminder-panel {
        border-radius: 18px;
        background: #fff;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        overflow: hidden;
        transition: box-shadow .2s;
    }
    .reminder-panel:hover {
        box-shadow: 0 6px 20px rgba(0,0,0,0.07);
    }

    /* Panel header variants */
    .panel-header-orange { background: linear-gradient(135deg, #fff7ed, #ffedd5); border-bottom: 1px solid #fed7aa; }
    .panel-header-yellow { background: linear-gradient(135deg, #fefce8, #fef9c3); border-bottom: 1px solid #fde68a; }
    .panel-header-red    { background: linear-gradient(135deg, #fff1f2, #fee2e2); border-bottom: 1px solid #fecaca; }

    /* Item row */
    .reminder-item {
        padding: 14px 16px;
        transition: background .12s;
        border-bottom: 1px solid #f8fafc;
    }
    .reminder-item:last-child { border-bottom: none; }
    .reminder-item:hover { background: #fafbff; }

    /* Badge dot */
    .status-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
        display: inline-block;
    }

    /* Action btns inside reminder */
    .btn-sm-primary {
        border-radius: 8px; background: #7B1E1E;
        padding: 5px 12px; font-size: .6875rem; font-weight: 500; color: #fff;
        transition: opacity .12s, transform .12s;
        text-decoration: none; display: inline-block;
    }
    .btn-sm-primary:hover { opacity: .85; transform: translateY(-1px); }
    .btn-sm-outline {
        border-radius: 8px; border: 1.5px solid #7B1E1E;
        padding: 4px 10px; font-size: .6875rem; font-weight: 500; color: #7B1E1E;
        transition: background .12s;
        text-decoration: none; display: inline-block;
    }
    .btn-sm-outline:hover { background: rgba(123,30,30,0.05); }

    /* Section group entrance */
    @keyframes sectionIn {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .section-group {
        animation: sectionIn .4s ease both;
    }
    .section-group:nth-child(1) { animation-delay: .05s; }
    .section-group:nth-child(3) { animation-delay: .12s; }

    /* Panel entrance stagger */
    @keyframes panelIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .reminder-panel { animation: panelIn .35s ease both; }
    .panel-col:nth-child(1) .reminder-panel { animation-delay: .05s; }
    .panel-col:nth-child(2) .reminder-panel { animation-delay: .12s; }
    .panel-col:nth-child(3) .reminder-panel { animation-delay: .19s; }

    /* Divider */
    .section-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, #e2e8f0 20%, #e2e8f0 80%, transparent);
    }

    /* Empty state */
    .empty-reminder {
        padding: 28px 16px;
        text-align: center;
    }
    .empty-icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        background: #f8fafc;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 8px;
    }

    /* Count badge */
    .count-chip {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 20px; height: 20px;
        border-radius: 6px;
        font-size: 10px; font-weight: 700;
        padding: 0 5px;
    }
</style>

<div class="space-y-8">

    {{-- ── Reminder Rekapan Netflix ── --}}
    <div class="section-group">
        <div class="flex items-center gap-2.5 mb-5">
            <div class="section-bar"></div>
            <h3 class="text-base font-bold text-slate-800">Reminder Rekapan Netflix</h3>
        </div>

        <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">

            {{-- Reset Hari Ini --}}
            <div class="panel-col">
                <div class="reminder-panel">
                    <div class="panel-header-orange px-4 py-3 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="status-dot bg-orange-400"></span>
                            <h4 class="text-sm font-semibold text-orange-700">Reset Hari Ini</h4>
                        </div>
                        @if($resetHariIni->count() > 0)
                            <span class="count-chip bg-orange-100 text-orange-600">{{ $resetHariIni->count() }}</span>
                        @endif
                    </div>
                    @forelse ($resetHariIni as $item)
                        <div class="reminder-item">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">{{ $item->tipe_sharing }}</p>
                                </div>
                                <span class="text-[10px] font-semibold text-orange-500 bg-orange-50 rounded-full px-2 py-0.5 flex-shrink-0">Hari Ini</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mb-2.5">
                                Reset: <span class="font-semibold text-slate-700">{{ \Carbon\Carbon::parse($item->tanggal_reset)->format('d M Y') }}</span>
                            </p>
                            <div class="flex gap-1.5">
                                <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}" class="btn-sm-primary">Edit</a>
                                <a href="{{ route('admin.netflix-accounts.index') }}" class="btn-sm-outline">Buka Rekapan</a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-reminder">
                            <div class="empty-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                            <p class="text-xs text-slate-400">Tidak ada akun reset hari ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Segera Reset --}}
            <div class="panel-col">
                <div class="reminder-panel">
                    <div class="panel-header-yellow px-4 py-3 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="status-dot bg-yellow-400"></span>
                            <h4 class="text-sm font-semibold text-yellow-700">Segera Reset</h4>
                        </div>
                        @if($segeraReset->count() > 0)
                            <span class="count-chip bg-yellow-100 text-yellow-700">{{ $segeraReset->count() }}</span>
                        @endif
                    </div>
                    @forelse ($segeraReset as $item)
                        <div class="reminder-item">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">{{ $item->tipe_sharing }}</p>
                                </div>
                                <span class="text-[10px] font-semibold text-yellow-600 bg-yellow-50 rounded-full px-2 py-0.5 flex-shrink-0">Segera</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mb-2.5">
                                Reset: <span class="font-semibold text-slate-700">{{ \Carbon\Carbon::parse($item->tanggal_reset)->format('d M Y') }}</span>
                            </p>
                            <div class="flex gap-1.5">
                                <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}" class="btn-sm-primary">Edit</a>
                                <a href="{{ route('admin.netflix-accounts.index') }}" class="btn-sm-outline">Buka Rekapan</a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-reminder">
                            <div class="empty-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                            <p class="text-xs text-slate-400">Tidak ada akun yang segera reset.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Lewat Reset --}}
            <div class="panel-col">
                <div class="reminder-panel">
                    <div class="panel-header-red px-4 py-3 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="status-dot bg-red-400"></span>
                            <h4 class="text-sm font-semibold text-red-700">Lewat Reset</h4>
                        </div>
                        @if($lewatReset->count() > 0)
                            <span class="count-chip bg-red-100 text-red-600">{{ $lewatReset->count() }}</span>
                        @endif
                    </div>
                    @forelse ($lewatReset as $item)
                        <div class="reminder-item">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">{{ $item->tipe_sharing }}</p>
                                </div>
                                <span class="text-[10px] font-semibold text-red-600 bg-red-50 rounded-full px-2 py-0.5 flex-shrink-0">Lewat</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mb-2.5">
                                Reset: <span class="font-semibold text-slate-700">{{ \Carbon\Carbon::parse($item->tanggal_reset)->format('d M Y') }}</span>
                            </p>
                            <div class="flex gap-1.5">
                                <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}" class="btn-sm-primary">Edit</a>
                                <a href="{{ route('admin.netflix-accounts.index') }}" class="btn-sm-outline">Buka Rekapan</a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-reminder">
                            <div class="empty-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                            <p class="text-xs text-slate-400">Tidak ada akun lewat reset.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Divider --}}
    <div class="section-divider"></div>

    {{-- ── Reminder Netflix 1 Week ── --}}
    <div class="section-group">
        <div class="flex items-center gap-2.5 mb-5">
            <div class="section-bar"></div>
            <h3 class="text-base font-bold text-slate-800">Reminder Netflix 1 Week</h3>
        </div>

        <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">

            {{-- Habis Hari Ini --}}
            <div class="panel-col">
                <div class="reminder-panel">
                    <div class="panel-header-orange px-4 py-3 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="status-dot bg-orange-400"></span>
                            <h4 class="text-sm font-semibold text-orange-700">Habis Hari Ini</h4>
                        </div>
                        @if($habisHariIni->count() > 0)
                            <span class="count-chip bg-orange-100 text-orange-600">{{ $habisHariIni->count() }}</span>
                        @endif
                    </div>
                    @forelse ($habisHariIni as $item)
                        <div class="reminder-item">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <p class="text-sm font-semibold text-slate-800 truncate min-w-0">{{ $item->email }}</p>
                                <span class="text-[10px] font-semibold text-orange-500 bg-orange-50 rounded-full px-2 py-0.5 flex-shrink-0">Hari Ini</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mb-2.5">
                                Habis: <span class="font-semibold text-slate-700">{{ \Carbon\Carbon::parse($item->durasi_habis)->format('d M Y') }}</span>
                            </p>
                            <div class="flex gap-1.5">
                                <a href="{{ route('admin.netflix-week-accounts.edit', $item->id) }}" class="btn-sm-primary">Edit</a>
                                <a href="{{ route('admin.netflix-week-accounts.index') }}" class="btn-sm-outline">Buka Netflix 1 Week</a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-reminder">
                            <div class="empty-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                            <p class="text-xs text-slate-400">Tidak ada akun yang habis hari ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Segera Habis --}}
            <div class="panel-col">
                <div class="reminder-panel">
                    <div class="panel-header-yellow px-4 py-3 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="status-dot bg-yellow-400"></span>
                            <h4 class="text-sm font-semibold text-yellow-700">Segera Habis</h4>
                        </div>
                        @if($segeraHabis->count() > 0)
                            <span class="count-chip bg-yellow-100 text-yellow-700">{{ $segeraHabis->count() }}</span>
                        @endif
                    </div>
                    @forelse ($segeraHabis as $item)
                        <div class="reminder-item">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <p class="text-sm font-semibold text-slate-800 truncate min-w-0">{{ $item->email }}</p>
                                <span class="text-[10px] font-semibold text-yellow-600 bg-yellow-50 rounded-full px-2 py-0.5 flex-shrink-0">Segera</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mb-2.5">
                                Habis: <span class="font-semibold text-slate-700">{{ \Carbon\Carbon::parse($item->durasi_habis)->format('d M Y') }}</span>
                            </p>
                            <div class="flex gap-1.5">
                                <a href="{{ route('admin.netflix-week-accounts.edit', $item->id) }}" class="btn-sm-primary">Edit</a>
                                <a href="{{ route('admin.netflix-week-accounts.index') }}" class="btn-sm-outline">Buka Netflix 1 Week</a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-reminder">
                            <div class="empty-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                            <p class="text-xs text-slate-400">Tidak ada akun yang segera habis.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Sudah Habis --}}
            <div class="panel-col">
                <div class="reminder-panel">
                    <div class="panel-header-red px-4 py-3 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="status-dot bg-red-400"></span>
                            <h4 class="text-sm font-semibold text-red-700">Sudah Habis</h4>
                        </div>
                        @if($sudahHabis->count() > 0)
                            <span class="count-chip bg-red-100 text-red-600">{{ $sudahHabis->count() }}</span>
                        @endif
                    </div>
                    @forelse ($sudahHabis as $item)
                        <div class="reminder-item">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <p class="text-sm font-semibold text-slate-800 truncate min-w-0">{{ $item->email }}</p>
                                <span class="text-[10px] font-semibold text-red-600 bg-red-50 rounded-full px-2 py-0.5 flex-shrink-0">Habis</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mb-2.5">
                                Habis: <span class="font-semibold text-slate-700">{{ \Carbon\Carbon::parse($item->durasi_habis)->format('d M Y') }}</span>
                            </p>
                            <div class="flex gap-1.5">
                                <a href="{{ route('admin.netflix-week-accounts.edit', $item->id) }}" class="btn-sm-primary">Edit</a>
                                <a href="{{ route('admin.netflix-week-accounts.index') }}" class="btn-sm-outline">Buka Netflix 1 Week</a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-reminder">
                            <div class="empty-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                            <p class="text-xs text-slate-400">Tidak ada akun yang sudah habis.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>
@endsection