@extends('layouts.admin')

@section('title', 'Rekapan Netflix - OriRecap')
@section('page-title', 'Rekapan Netflix')

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
        transition:opacity .15s, transform .12s;white-space:nowrap;
    }
    .btn-primary:hover { opacity:.88; transform:translateY(-1px); }
    .btn-outline-brand {
        display:inline-flex;align-items:center;gap:6px;
        border-radius:10px;border:1.5px solid #7B1E1E;
        padding:8px 14px;font-size:.8125rem;font-weight:500;color:#7B1E1E;
        transition:background .15s, transform .12s;white-space:nowrap;
    }
    .btn-outline-brand:hover { background:rgba(123,30,30,0.05); transform:translateY(-1px); }
    .btn-outline {
        display:inline-flex;align-items:center;gap:6px;
        border-radius:10px;border:1.5px solid #e2e8f0;
        padding:8px 14px;font-size:.8125rem;font-weight:500;color:#64748b;
        transition:background .15s;white-space:nowrap;
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

    /* Search with icon */
    .search-wrapper {
        position: relative;
    }
    .search-wrapper .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        pointer-events: none;
        transition: color .15s;
    }
    .search-wrapper input:focus ~ .search-icon,
    .search-wrapper input:focus + .search-icon {
        color: #7B1E1E;
    }
    .search-wrapper input {
        padding-left: 38px;
    }

    /* Reset icon button */
    .btn-icon-reset {
        display:inline-flex;align-items:center;justify-content:center;
        border-radius:10px;border:1.5px solid #e2e8f0;
        width: 38px; height: 38px;
        color:#64748b;
        transition:background .15s, color .15s, border-color .15s;
        flex-shrink: 0;
    }
    .btn-icon-reset:hover {
        background:#fff1f2;
        color:#ef4444;
        border-color:#fecaca;
    }

    /* Import file button inline */
    .file-import-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .file-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 10px;
        border: 1.5px solid #e2e8f0;
        padding: 7px 13px;
        font-size: .8125rem;
        font-weight: 500;
        color: #64748b;
        cursor: pointer;
        transition: background .15s, border-color .15s;
        white-space: nowrap;
    }
    .file-label:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }
    .file-label.has-file {
        border-color: #7B1E1E;
        color: #7B1E1E;
        background: rgba(123,30,30,0.03);
    }
    #file-name-display {
        font-size: .75rem;
        color: #64748b;
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Action bar separator */
    .action-sep {
        width: 1px;
        height: 28px;
        background: #e2e8f0;
        flex-shrink: 0;
    }
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

        {{-- Title row + all action buttons aligned --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <div class="section-bar"></div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-800">Data Rekapan Netflix</h3>
                    <p class="mt-0.5 text-xs text-slate-400">Kelola data akun Netflix di halaman ini.</p>
                </div>
            </div>

            {{-- All action buttons in one row --}}
            <div class="flex flex-wrap items-center gap-2">
                {{-- Import inline --}}
                <form action="{{ route('admin.netflix-accounts.import') }}" method="POST" enctype="multipart/form-data"
                    class="flex items-center gap-2" id="import-form-netflix">
                    @csrf
                    <label for="import-file-netflix" class="file-label" id="file-label-netflix">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                        <span id="file-label-text-netflix">Pilih File</span>
                        <input type="file" id="import-file-netflix" name="file" accept=".xlsx,.xls,.csv"
                            class="sr-only" required>
                    </label>
                    <span id="file-name-display-netflix" class="hidden text-xs text-slate-500 max-w-[140px] truncate"></span>
                    <button type="submit" id="import-btn-netflix"
                        class="btn-primary hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                        Import
                    </button>
                </form>

                <div class="action-sep hidden sm:block"></div>

                <a href="{{ route('admin.netflix-accounts.export') }}" class="btn-outline-brand">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                    Export
                </a>
                <a href="{{ route('admin.netflix-accounts.template') }}" class="btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                    Template
                </a>
                <a href="{{ route('admin.netflix-accounts.create') }}" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Tambah Data
                </a>
            </div>
        </div>

        {{-- Format hint --}}
        <div class="mt-4 flex items-center gap-2 px-1">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
            <p class="text-[11px] text-slate-400">Format import: <span class="font-mono text-slate-500">email, password, tanggal_reset, tipe_sharing, deskripsi</span></p>
        </div>

        {{-- Filter: search + sort auto-submit, reset icon --}}
        <form action="{{ route('admin.netflix-accounts.index') }}" method="GET" id="filter-form-netflix" class="mt-4">
            <div class="flex flex-col gap-2 xl:flex-row">

                {{-- Search with icon --}}
                <div class="search-wrapper flex-1 relative">
                    <svg class="search-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    <input type="text" name="q" value="{{ $q }}"
                        placeholder="Cari email, password, tipe sharing, atau deskripsi…"
                        class="filter-input w-full rounded-xl border border-slate-200 bg-white py-2.5 pr-4 text-sm transition"
                        id="search-input-netflix"
                        autocomplete="off">
                </div>

                {{-- Status filter --}}
                <select name="status" id="status-filter-netflix"
                    class="filter-input w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm transition xl:w-52">
                    <option value="">Semua Status</option>
                    <option value="belum_diatur" @selected($status === 'belum_diatur')>Belum Diatur</option>
                    <option value="aman" @selected($status === 'aman')>Aman</option>
                    <option value="segera_reset" @selected($status === 'segera_reset')>Segera Reset</option>
                    <option value="reset_hari_ini" @selected($status === 'reset_hari_ini')>Reset Hari Ini</option>
                    <option value="lewat_reset" @selected($status === 'lewat_reset')>Lewat Reset</option>
                </select>

                {{-- Sort filter --}}
                <select name="sort" id="sort-filter-netflix"
                    class="filter-input w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm transition xl:w-56">
                    <option value="">Urutkan Data</option>
                    <option value="oldest" @selected($sort === 'oldest')>Nomor Terlama</option>
                    <option value="latest" @selected($sort === 'latest')>Nomor Terbaru</option>
                    <option value="reset_asc" @selected($sort === 'reset_asc')>Tanggal Reset Terdekat</option>
                    <option value="reset_desc" @selected($sort === 'reset_desc')>Tanggal Reset Terjauh</option>
                </select>

                {{-- Reset icon button --}}
                <a href="{{ route('admin.netflix-accounts.index') }}" class="btn-icon-reset" title="Reset filter">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                </a>
            </div>
        </form>
    </div>

    {{-- ── Mobile Card View ── --}}
    <div class="space-y-3 lg:hidden">
        @forelse ($netflixAccounts as $item)
            <div class="data-card rounded-2xl bg-white border border-slate-100 p-4 shadow-sm">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="font-semibold text-slate-800 truncate text-sm">{{ $item->email }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">#{{ $netflixAccounts->firstItem() + $loop->index }}</p>
                    </div>
                    <span class="shrink-0 inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $item->status_reset['class'] }}">
                        {{ $item->status_reset['label'] }}
                    </span>
                </div>

                <div class="mt-3 grid grid-cols-2 gap-x-4 gap-y-2.5">
                    <div>
                        <p class="text-[10px] font-medium text-slate-400 tracking-wide">Password</p>
                        <div class="mt-1 flex items-center gap-1.5">
                            <span id="password-mobile-netflix-{{ $item->id }}" data-hidden="••••••••"
                                data-full="{{ $item->password }}" class="font-medium text-slate-700 text-xs">
                                ••••••••
                            </span>
                            <button type="button" data-target="password-mobile-netflix-{{ $item->id }}"
                                onclick="togglePassword(this)" class="pw-reveal">Lihat</button>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium text-slate-400 tracking-wide">Tipe Sharing</p>
                        <p class="mt-1 font-medium text-slate-700 text-xs">{{ $item->tipe_sharing ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium text-slate-400 tracking-wide">Tanggal Reset</p>
                        <p class="mt-1 font-medium text-slate-700 text-xs">
                            {{ $item->tanggal_reset ? \Carbon\Carbon::parse($item->tanggal_reset)->format('d/m/Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium text-slate-400 tracking-wide">Deskripsi</p>
                        <p class="mt-1 font-medium text-slate-700 text-xs">{{ $item->deskripsi ?: '-' }}</p>
                    </div>
                </div>

                <div class="mt-3 flex flex-wrap gap-1.5 border-t border-slate-50 pt-3">
                    <a href="{{ route('admin.netflix-accounts.show', $item->id) }}" class="btn-outline" style="padding:5px 10px;font-size:.6875rem;">Detail</a>
                    <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}" class="btn-outline-brand" style="padding:5px 10px;font-size:.6875rem;">Edit</a>
                    <form action="{{ route('admin.netflix-accounts.destroy', $item->id) }}" method="POST"
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
                <p class="text-sm text-slate-400 font-medium">Belum ada data rekapan Netflix.</p>
            </div>
        @endforelse

        <div class="rounded-2xl bg-white border border-slate-100 px-4 py-3 shadow-sm">
            {{ $netflixAccounts->links() }}
        </div>
    </div>

    {{-- ── Desktop Table View ── --}}
    <div class="hidden overflow-hidden rounded-2xl bg-white border border-slate-100 shadow-sm lg:block">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr style="background:#fafbff;border-bottom:1.5px solid #f1f5f9;">
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 tracking-widest">No</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 tracking-widest">Email</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 tracking-widest">Password</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 tracking-widest">Tgl Reset</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 tracking-widest">Tipe</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 tracking-widest">Status</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold text-slate-400 tracking-widest">Deskripsi</th>
                        <th class="px-4 py-3.5 text-center text-[10px] font-bold text-slate-400 tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($netflixAccounts as $item)
                        <tr class="tbl-row border-b border-slate-50">
                            <td class="px-4 py-3.5 text-slate-400 text-xs font-medium">{{ $netflixAccounts->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-3.5 font-semibold text-slate-800 text-sm">{{ $item->email }}</td>
                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-2">
                                    <span id="password-netflix-{{ $item->id }}" data-hidden="••••••••"
                                        data-full="{{ $item->password }}" class="text-slate-600 text-sm font-mono">
                                        ••••••••
                                    </span>
                                    <button type="button" data-target="password-netflix-{{ $item->id }}"
                                        onclick="togglePassword(this)" class="pw-reveal">Lihat</button>
                                </div>
                            </td>
                            <td class="px-4 py-3.5 text-slate-600 text-sm">
                                {{ $item->tanggal_reset ? \Carbon\Carbon::parse($item->tanggal_reset)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="px-4 py-3.5 text-slate-600 text-sm">{{ $item->tipe_sharing }}</td>
                            <td class="px-4 py-3.5">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $item->status_reset['class'] }}">
                                    {{ $item->status_reset['label'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3.5 text-slate-500 text-sm max-w-[180px] truncate">{{ $item->deskripsi ?: '-' }}</td>
                            <td class="px-4 py-3.5">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.netflix-accounts.show', $item->id) }}" class="btn-outline" style="padding:5px 10px;font-size:.6875rem;">Detail</a>
                                    <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}" class="btn-outline-brand" style="padding:5px 10px;font-size:.6875rem;">Edit</a>
                                    <form action="{{ route('admin.netflix-accounts.destroy', $item->id) }}"
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
                                <p class="text-sm text-slate-400 font-medium">Belum ada data rekapan Netflix.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-50 px-4 py-3">
            {{ $netflixAccounts->links() }}
        </div>
    </div>

</div>

<script>
    // File input display
    const fileInput = document.getElementById('import-file-netflix');
    const fileLabel = document.getElementById('file-label-netflix');
    const fileLabelText = document.getElementById('file-label-text-netflix');
    const fileNameDisplay = document.getElementById('file-name-display-netflix');
    const importBtn = document.getElementById('import-btn-netflix');

    if (fileInput) {
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const name = this.files[0].name;
                fileLabelText.textContent = 'Ganti File';
                fileLabel.classList.add('has-file');
                fileNameDisplay.textContent = name;
                fileNameDisplay.classList.remove('hidden');
                importBtn.classList.remove('hidden');
            } else {
                fileLabelText.textContent = 'Pilih File';
                fileLabel.classList.remove('has-file');
                fileNameDisplay.classList.add('hidden');
                importBtn.classList.add('hidden');
            }
        });
    }

    // Auto-submit on select change
    const statusFilter = document.getElementById('status-filter-netflix');
    const sortFilter = document.getElementById('sort-filter-netflix');
    const filterForm = document.getElementById('filter-form-netflix');

    if (statusFilter) statusFilter.addEventListener('change', () => filterForm.submit());
    if (sortFilter) sortFilter.addEventListener('change', () => filterForm.submit());

    // Search debounce auto-submit
    const searchInput = document.getElementById('search-input-netflix');
    if (searchInput) {
        let debounceTimer;
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => filterForm.submit(), 500);
        });
    }
</script>
@endsection