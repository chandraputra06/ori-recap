@extends('layouts.admin')

@section('title', 'Netflix 1 Week - OriRecap')
@section('page-title', 'Netflix 1 Week')

@section('content')
<style>
    .section-bar { width:3px;height:16px;background:#7B1E1E;border-radius:2px; }

    @keyframes alertIn {
        from { opacity:0; transform:translateY(-8px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .alert-box { animation: alertIn .3s ease both; }

    .tbl-row { transition: background .12s; }
    .tbl-row:hover { background: #f8fafc; }

    @keyframes cardIn {
        from { opacity:0; transform:translateY(12px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .data-card {
        animation: cardIn .35s ease both;
        transition: box-shadow .18s;
    }
    .data-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.07); }

    .filter-input:focus {
        border-color: #7B1E1E;
        box-shadow: 0 0 0 3px rgba(123,30,30,0.1);
        outline: none;
    }

    .import-zone {
        border: 1.5px dashed #e2e8f0;
        border-radius: 14px;
        background: #fafbff;
        transition: border-color .15s, background .15s;
    }
    .import-zone:hover {
        border-color: rgba(123,30,30,0.4);
        background: rgba(123,30,30,0.02);
    }

    .btn-primary {
        display:inline-flex;align-items:center;gap:6px;
        border-radius:10px;background:#7B1E1E;
        padding:8px 14px;font-size:.8125rem;font-weight:500;color:#fff;
        transition:opacity .15s, transform .12s;
    }
    .btn-primary:hover { opacity:.88; transform:translateY(-1px); }
    .btn-outline-brand {
        display:inline-flex;align-items:center;gap:6px;
        border-radius:10px;border:1.5px solid #7B1E1E;
        padding:8px 14px;font-size:.8125rem;font-weight:500;color:#7B1E1E;
        transition:background .15s, transform .12s;
    }
    .btn-outline-brand:hover { background:rgba(123,30,30,0.05); transform:translateY(-1px); }
    .btn-outline {
        display:inline-flex;align-items:center;gap:6px;
        border-radius:10px;border:1.5px solid #e2e8f0;
        padding:8px 14px;font-size:.8125rem;font-weight:500;color:#64748b;
        transition:background .15s;
    }
    .btn-outline:hover { background:#f8fafc; }

    .pw-reveal {
        border-radius:6px;border:1px solid #7B1E1E;
        padding:2px 8px;font-size:.6875rem;font-weight:500;color:#7B1E1E;
        cursor:pointer;transition:background .12s;
    }
    .pw-reveal:hover { background:rgba(123,30,30,0.06); }

    .btn-delete {
        border-radius:8px;background:#ef4444;
        padding:5px 10px;font-size:.6875rem;font-weight:500;color:#fff;cursor:pointer;
        transition:background .12s, transform .12s;
        border:none;
    }
    .btn-delete:hover { background:#dc2626; transform:translateY(-1px); }
</style>

<div class="space-y-5">

    {{-- Alerts --}}
    @if (session('success'))
        <div class="alert-box flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-box flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><circle cx="12" cy="12" r="10"/><line x1="15" x2="9" y1="9" y2="15"/><line x1="9" x2="15" y1="9" y2="15"/></svg>
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->has('file'))
        <div class="alert-box flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><circle cx="12" cy="12" r="10"/><line x1="15" x2="9" y1="9" y2="15"/><line x1="9" x2="15" y1="9" y2="15"/></svg>
            {{ $errors->first('file') }}
        </div>
    @endif

    {{-- ── Header Card ── --}}
    <div class="rounded-2xl bg-white border border-slate-100 shadow-sm p-5">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div class="flex items-center gap-3">
                <div class="section-bar"></div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-800">Data Netflix 1 Week</h3>
                    <p class="mt-0.5 text-xs text-slate-400">Kelola data akun Netflix 1 Week di halaman ini.</p>
                </div>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.netflix-week-accounts.export') }}" class="btn-outline-brand">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                    Export
                </a>
                <a href="{{ route('admin.netflix-week-accounts.template') }}" class="btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                    Template
                </a>
                <a href="{{ route('admin.netflix-week-accounts.create') }}" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Tambah Data
                </a>
            </div>
        </div>

        {{-- Import Excel --}}
        <div class="import-zone mt-5 p-4">
            <div class="flex items-start gap-3 mb-3">
                <div style="width:32px;height:32px;border-radius:8px;background:rgba(123,30,30,0.08);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#7B1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-700">Import Excel</p>
                    <p class="mt-0.5 text-xs text-slate-400">Format kolom: <span class="font-mono text-slate-500 text-[11px]">email, password, tanggal_terjual, durasi_habis, deskripsi</span></p>
                </div>
            </div>
            <form action="{{ route('admin.netflix-week-accounts.import') }}" method="POST"
                enctype="multipart/form-data" class="flex flex-col gap-2 sm:flex-row sm:items-center">
                @csrf
                <input type="file" name="file" accept=".xlsx,.xls,.csv"
                    class="filter-input block w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-sm text-slate-700 transition file:mr-3 file:rounded-lg file:border-0 file:bg-[#7B1E1E]/10 file:px-3 file:py-1 file:text-xs file:font-medium file:text-[#7B1E1E]"
                    required>
                <button type="submit" class="btn-primary cursor-pointer shrink-0">
                    Import
                </button>
            </form>
        </div>

        {{-- Filter --}}
        <form action="{{ route('admin.netflix-week-accounts.index') }}" method="GET" class="mt-4">
            <div class="flex flex-col gap-2 xl:flex-row">
                <input type="text" name="q" value="{{ $q }}"
                    placeholder="Cari email, password, atau deskripsi…"
                    class="filter-input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm transition">

                <select name="status"
                    class="filter-input w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm transition xl:w-52">
                    <option value="">Semua Status</option>
                    <option value="belum_diatur" @selected($status === 'belum_diatur')>Belum Diatur</option>
                    <option value="aktif" @selected($status === 'aktif')>Aktif</option>
                    <option value="segera_habis" @selected($status === 'segera_habis')>Segera Habis</option>
                    <option value="habis_hari_ini" @selected($status === 'habis_hari_ini')>Habis Hari Ini</option>
                    <option value="sudah_habis" @selected($status === 'sudah_habis')>Sudah Habis</option>
                </select>

                <select name="sort"
                    class="filter-input w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm transition xl:w-60">
                    <option value="">Urutkan Data</option>
                    <option value="oldest" @selected($sort === 'oldest')>Nomor Terlama</option>
                    <option value="latest" @selected($sort === 'latest')>Nomor Terbaru</option>
                    <option value="expired_asc" @selected($sort === 'expired_asc')>Durasi Habis Terdekat</option>
                    <option value="expired_desc" @selected($sort === 'expired_desc')>Durasi Habis Terjauh</option>
                </select>

                <div class="flex gap-2">
                    <button type="submit" class="btn-primary cursor-pointer">Terapkan</button>
                    <a href="{{ route('admin.netflix-week-accounts.index') }}" class="btn-outline">Reset</a>
                </div>
            </div>
        </form>
    </div>

    {{-- ── Mobile Card View ── --}}
    <div class="space-y-3 lg:hidden">
        @forelse ($netflixWeekAccounts as $item)
            <div class="data-card rounded-2xl bg-white border border-slate-100 p-4 shadow-sm">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="font-semibold text-slate-800 truncate text-sm">{{ $item->email }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">#{{ $netflixWeekAccounts->firstItem() + $loop->index }}</p>
                    </div>
                    <span class="shrink-0 inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $item->status_habis['class'] }}">
                        {{ $item->status_habis['label'] }}
                    </span>
                </div>

                <div class="mt-3 grid grid-cols-2 gap-x-4 gap-y-2.5">
                    <div>
                        <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Password</p>
                        <div class="mt-1 flex items-center gap-1.5">
                            <span id="password-mobile-week-{{ $item->id }}" data-hidden="••••••••"
                                data-full="{{ $item->password }}" class="font-medium text-slate-700 text-xs">
                                ••••••••
                            </span>
                            <button type="button" data-target="password-mobile-week-{{ $item->id }}"
                                onclick="togglePassword(this)" class="pw-reveal">Lihat</button>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Tanggal Terjual</p>
                        <p class="mt-1 font-medium text-slate-700 text-xs">
                            {{ $item->tanggal_terjual ? \Carbon\Carbon::parse($item->tanggal_terjual)->format('d/m/Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Durasi Habis</p>
                        <p class="mt-1 font-medium text-slate-700 text-xs">
                            {{ $item->durasi_habis ? \Carbon\Carbon::parse($item->durasi_habis)->format('d/m/Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Deskripsi</p>
                        <p class="mt-1 font-medium text-slate-700 text-xs">{{ $item->deskripsi ?: '-' }}</p>
                    </div>
                </div>

                <div class="mt-3 flex flex-wrap gap-1.5 border-t border-slate-50 pt-3">
                    <a href="{{ route('admin.netflix-week-accounts.show', $item->id) }}" class="btn-outline" style="padding:5px 10px;font-size:.6875rem;">Detail</a>
                    <a href="{{ route('admin.netflix-week-accounts.edit', $item->id) }}" class="btn-outline-brand" style="padding:5px 10px;font-size:.6875rem;">Edit</a>
                    <form action="{{ route('admin.netflix-week-accounts.destroy', $item->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="rounded-2xl bg-white border border-dashed border-slate-200 p-12 text-center shadow-sm">
                <div style="width:48px;height:48px;border-radius:14px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                </div>
                <p class="text-sm text-slate-400 font-medium">Belum ada data Netflix 1 Week.</p>
            </div>
        @endforelse

        <div class="rounded-2xl bg-white border border-slate-100 px-4 py-3 shadow-sm">
            {{ $netflixWeekAccounts->links() }}
        </div>
    </div>

    {{-- ── Desktop Table View ── --}}
    <div class="hidden overflow-hidden rounded-2xl bg-white border border-slate-100 shadow-sm lg:block">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr style="background:#fafbff;border-bottom:1.5px solid #f1f5f9;">
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">No</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Email</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Password</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tgl Terjual</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Durasi Habis</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Deskripsi</th>
                        <th class="px-4 py-3.5 text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($netflixWeekAccounts as $item)
                        <tr class="tbl-row border-b border-slate-50">
                            <td class="px-4 py-3.5 text-slate-400 text-xs font-medium">{{ $netflixWeekAccounts->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-3.5 font-semibold text-slate-800 text-sm">{{ $item->email }}</td>
                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-2">
                                    <span id="password-week-{{ $item->id }}" data-hidden="••••••••"
                                        data-full="{{ $item->password }}" class="text-slate-600 text-sm font-mono">
                                        ••••••••
                                    </span>
                                    <button type="button" data-target="password-week-{{ $item->id }}"
                                        onclick="togglePassword(this)" class="pw-reveal">Lihat</button>
                                </div>
                            </td>
                            <td class="px-4 py-3.5 text-slate-600 text-sm">
                                {{ $item->tanggal_terjual ? \Carbon\Carbon::parse($item->tanggal_terjual)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="px-4 py-3.5 text-slate-600 text-sm">
                                {{ $item->durasi_habis ? \Carbon\Carbon::parse($item->durasi_habis)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="px-4 py-3.5">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $item->status_habis['class'] }}">
                                    {{ $item->status_habis['label'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3.5 text-slate-500 text-sm max-w-[180px] truncate">{{ $item->deskripsi ?: '-' }}</td>
                            <td class="px-4 py-3.5">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.netflix-week-accounts.show', $item->id) }}" class="btn-outline" style="padding:5px 10px;font-size:.6875rem;">Detail</a>
                                    <a href="{{ route('admin.netflix-week-accounts.edit', $item->id) }}" class="btn-outline-brand" style="padding:5px 10px;font-size:.6875rem;">Edit</a>
                                    <form action="{{ route('admin.netflix-week-accounts.destroy', $item->id) }}"
                                        method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-14 text-center">
                                <div style="width:48px;height:48px;border-radius:14px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                                </div>
                                <p class="text-sm text-slate-400 font-medium">Belum ada data Netflix 1 Week.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-50 px-4 py-3">
            {{ $netflixWeekAccounts->links() }}
        </div>
    </div>

</div>
@endsection