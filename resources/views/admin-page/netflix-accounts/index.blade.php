@extends('layouts.admin')

@section('title', 'Rekapan Netflix - OriRecap')
@section('page-title', 'Rekapan Netflix')

@section('content')
    <div class="space-y-5">

        {{-- Alerts --}}
        @if (session('success'))
            <div class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><circle cx="12" cy="12" r="10"/><line x1="15" x2="9" y1="9" y2="15"/><line x1="9" x2="15" y1="9" y2="15"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->has('file'))
            <div class="flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><circle cx="12" cy="12" r="10"/><line x1="15" x2="9" y1="9" y2="15"/><line x1="9" x2="15" y1="9" y2="15"/></svg>
                {{ $errors->first('file') }}
            </div>
        @endif

        {{-- Header + Actions --}}
        <div class="rounded-2xl bg-white border border-slate-100 shadow-sm p-5">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Data Rekapan Netflix</h3>
                    <p class="mt-0.5 text-sm text-slate-400">Kelola data akun Netflix di halaman ini.</p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.netflix-accounts.export') }}"
                        class="inline-flex items-center gap-1.5 rounded-xl border border-[#7B1E1E] px-3.5 py-2 text-sm font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/5 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                        Export
                    </a>

                    <a href="{{ route('admin.netflix-accounts.template') }}"
                        class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 px-3.5 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Template
                    </a>

                    <a href="{{ route('admin.netflix-accounts.create') }}"
                        class="inline-flex items-center gap-1.5 rounded-xl bg-[#7B1E1E] px-3.5 py-2 text-sm font-medium text-white hover:opacity-90 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        Tambah Data
                    </a>
                </div>
            </div>

            {{-- Import Excel --}}
            <div class="mt-5 rounded-xl border border-dashed border-slate-200 bg-slate-50 p-4">
                <p class="text-sm font-medium text-slate-700">Import Excel</p>
                <p class="mt-0.5 text-xs text-slate-400">Format: email, password, tanggal_reset, tipe_sharing, deskripsi</p>

                <form action="{{ route('admin.netflix-accounts.import') }}" method="POST" enctype="multipart/form-data"
                    class="mt-3 flex flex-col gap-2 sm:flex-row sm:items-center">
                    @csrf
                    <input type="file" name="file" accept=".xlsx,.xls,.csv"
                        class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm text-slate-700 file:mr-3 file:rounded-lg file:border-0 file:bg-[#7B1E1E]/10 file:px-3 file:py-1 file:text-xs file:font-medium file:text-[#7B1E1E]"
                        required>
                    <button type="submit"
                        class="cursor-pointer shrink-0 rounded-xl bg-[#7B1E1E] px-4 py-2.5 text-sm font-medium text-white hover:opacity-90">
                        Import
                    </button>
                </form>
            </div>

            {{-- Filter --}}
            <form action="{{ route('admin.netflix-accounts.index') }}" method="GET" class="mt-5">
                <div class="flex flex-col gap-2 xl:flex-row">
                    <input type="text" name="q" value="{{ $q }}"
                        placeholder="Cari email, password, tipe sharing, atau deskripsi…"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/15">

                    <select name="status"
                        class="w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/15 xl:w-52">
                        <option value="">Semua Status</option>
                        <option value="belum_diatur" @selected($status === 'belum_diatur')>Belum Diatur</option>
                        <option value="aman" @selected($status === 'aman')>Aman</option>
                        <option value="segera_reset" @selected($status === 'segera_reset')>Segera Reset</option>
                        <option value="reset_hari_ini" @selected($status === 'reset_hari_ini')>Reset Hari Ini</option>
                        <option value="lewat_reset" @selected($status === 'lewat_reset')>Lewat Reset</option>
                    </select>

                    <select name="sort"
                        class="w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/15 xl:w-60">
                        <option value="">Urutkan Data</option>
                        <option value="oldest" @selected($sort === 'oldest')>Nomor Terlama</option>
                        <option value="latest" @selected($sort === 'latest')>Nomor Terbaru</option>
                        <option value="reset_asc" @selected($sort === 'reset_asc')>Tanggal Reset Terdekat</option>
                        <option value="reset_desc" @selected($sort === 'reset_desc')>Tanggal Reset Terjauh</option>
                    </select>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="cursor-pointer rounded-xl bg-[#7B1E1E] px-5 py-2.5 text-sm font-medium text-white hover:opacity-90">
                            Terapkan
                        </button>
                        <a href="{{ route('admin.netflix-accounts.index') }}"
                            class="inline-flex items-center rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Mobile Card View --}}
        <div class="space-y-3 lg:hidden">
            @forelse ($netflixAccounts as $item)
                <div class="rounded-2xl bg-white border border-slate-100 p-4 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <p class="font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">#{{ $netflixAccounts->firstItem() + $loop->index }}</p>
                        </div>
                        <span class="shrink-0 inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $item->status_reset['class'] }}">
                            {{ $item->status_reset['label'] }}
                        </span>
                    </div>

                    <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                        <div>
                            <p class="text-xs text-slate-400">Password</p>
                            <div class="mt-0.5 flex items-center gap-1.5">
                                <span id="password-mobile-netflix-{{ $item->id }}" data-hidden="••••••••"
                                    data-full="{{ $item->password }}" class="font-medium text-slate-700 text-xs">
                                    ••••••••
                                </span>
                                <button type="button" data-target="password-mobile-netflix-{{ $item->id }}"
                                    onclick="togglePassword(this)"
                                    class="cursor-pointer rounded border border-[#7B1E1E] px-1.5 py-0.5 text-xs font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/5">
                                    Lihat
                                </button>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs text-slate-400">Tipe Sharing</p>
                            <p class="mt-0.5 font-medium text-slate-700 text-xs">{{ $item->tipe_sharing ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-400">Tanggal Reset</p>
                            <p class="mt-0.5 font-medium text-slate-700 text-xs">
                                {{ $item->tanggal_reset ? \Carbon\Carbon::parse($item->tanggal_reset)->format('d/m/Y') : '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-400">Deskripsi</p>
                            <p class="mt-0.5 font-medium text-slate-700 text-xs">{{ $item->deskripsi ?: '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-3 flex flex-wrap gap-1.5 border-t border-slate-100 pt-3">
                        <a href="{{ route('admin.netflix-accounts.show', $item->id) }}"
                            class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-50">
                            Detail
                        </a>
                        <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}"
                            class="rounded-lg border border-[#7B1E1E] px-3 py-1.5 text-xs font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/5">
                            Edit
                        </a>
                        <form action="{{ route('admin.netflix-accounts.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="cursor-pointer rounded-lg bg-red-500 px-3 py-1.5 text-xs font-medium text-white hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl bg-white border border-dashed border-slate-200 p-8 text-center shadow-sm">
                    <p class="text-sm text-slate-400">Belum ada data rekapan Netflix.</p>
                </div>
            @endforelse

            <div class="rounded-2xl bg-white border border-slate-100 px-4 py-3 shadow-sm">
                {{ $netflixAccounts->links() }}
            </div>
        </div>

        {{-- Desktop Table View --}}
        <div class="hidden overflow-hidden rounded-2xl bg-white border border-slate-100 shadow-sm lg:block">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Password</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tgl Reset</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($netflixAccounts as $item)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="px-4 py-3 text-slate-400 text-xs">{{ $netflixAccounts->firstItem() + $loop->index }}</td>
                                <td class="px-4 py-3 font-medium text-slate-800">{{ $item->email }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <span id="password-netflix-{{ $item->id }}" data-hidden="••••••••"
                                            data-full="{{ $item->password }}" class="text-slate-600">
                                            ••••••••
                                        </span>
                                        <button type="button" data-target="password-netflix-{{ $item->id }}"
                                            onclick="togglePassword(this)"
                                            class="cursor-pointer rounded border border-[#7B1E1E] px-2 py-0.5 text-xs font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/5">
                                            Lihat
                                        </button>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-slate-600">
                                    {{ $item->tanggal_reset ? \Carbon\Carbon::parse($item->tanggal_reset)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-4 py-3 text-slate-600">{{ $item->tipe_sharing }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $item->status_reset['class'] }}">
                                        {{ $item->status_reset['label'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-slate-500 max-w-[180px] truncate">{{ $item->deskripsi ?: '-' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="{{ route('admin.netflix-accounts.show', $item->id) }}"
                                            class="rounded-lg border border-slate-200 px-2.5 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-50">
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}"
                                            class="rounded-lg border border-[#7B1E1E] px-2.5 py-1.5 text-xs font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/5">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.netflix-accounts.destroy', $item->id) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="cursor-pointer rounded-lg bg-red-500 px-2.5 py-1.5 text-xs font-medium text-white hover:bg-red-600">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-10 text-center text-sm text-slate-400">
                                    Belum ada data rekapan Netflix.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-100 px-4 py-3">
                {{ $netflixAccounts->links() }}
            </div>
        </div>

    </div>
@endsection