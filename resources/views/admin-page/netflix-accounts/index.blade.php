@extends('layouts.admin')

@section('title', 'Rekapan Netflix - OriRecap')
@section('page-title', 'Rekapan Netflix')

@section('content')
    <div class="space-y-6">
        @if (session('success'))
            <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->has('file'))
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ $errors->first('file') }}
            </div>
        @endif

        <div class="rounded-2xl bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h3 class="text-lg font-bold text-[#7B1E1E]">Data Rekapan Netflix</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Kelola data akun Netflix di halaman ini.
                    </p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('admin.netflix-accounts.export') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-[#7B1E1E] px-4 py-3 font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/10">
                        Export Data
                    </a>

                    <a href="{{ route('admin.netflix-accounts.template') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 px-4 py-3 font-medium text-gray-700 hover:bg-gray-50">
                        Download Template
                    </a>

                    <a href="{{ route('admin.netflix-accounts.create') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-[#7B1E1E] px-4 py-3 font-medium text-white hover:opacity-90">
                        Tambah Data
                    </a>
                </div>
            </div>

            <div class="mt-6 rounded-2xl border border-dashed border-gray-300 bg-gray-50 p-5">
                <h4 class="text-base font-semibold text-[#7B1E1E]">Import Excel</h4>
                <p class="mt-1 text-sm text-gray-500">
                    Upload file Excel dengan format: email, password, tanggal_reset, tipe_sharing, deskripsi
                </p>

                <form action="{{ route('admin.netflix-accounts.import') }}" method="POST" enctype="multipart/form-data"
                    class="mt-4 flex flex-col gap-3 lg:flex-row lg:items-center">
                    @csrf

                    <input type="file" name="file" accept=".xlsx,.xls,.csv"
                        class="block w-full cursor-pointer rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700"
                        required>

                    <button type="submit"
                        class="cursor-pointer rounded-xl bg-[#7B1E1E] px-5 py-3 font-medium text-white hover:opacity-90">
                        Import Excel
                    </button>
                </form>
            </div>

            <form action="{{ route('admin.netflix-accounts.index') }}" method="GET" class="mt-6">
                <div class="flex flex-col gap-3 xl:flex-row">
                    <input type="text" name="q" value="{{ $q }}"
                        placeholder="Cari nomor, email, password, tipe sharing, atau deskripsi"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/20">

                    <select name="status"
                        class="w-full cursor-pointer rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/20 xl:w-64">
                        <option value="">Semua Status</option>
                        <option value="belum_diatur" @selected($status === 'belum_diatur')>Belum Diatur</option>
                        <option value="aman" @selected($status === 'aman')>Aman</option>
                        <option value="segera_reset" @selected($status === 'segera_reset')>Segera Reset</option>
                        <option value="reset_hari_ini" @selected($status === 'reset_hari_ini')>Reset Hari Ini</option>
                        <option value="lewat_reset" @selected($status === 'lewat_reset')>Lewat Reset</option>
                    </select>

                    <select name="sort"
                        class="w-full cursor-pointer rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/20 xl:w-72">
                        <option value="">Urutkan Data</option>
                        <option value="oldest" @selected($sort === 'oldest')>Nomor Terlama</option>
                        <option value="latest" @selected($sort === 'latest')>Nomor Terbaru</option>
                        <option value="reset_asc" @selected($sort === 'reset_asc')>Tanggal Reset Terdekat</option>
                        <option value="reset_desc" @selected($sort === 'reset_desc')>Tanggal Reset Terjauh</option>
                    </select>

                    <button type="submit"
                        class="cursor-pointer rounded-xl bg-[#7B1E1E] px-5 py-3 font-medium text-white hover:opacity-90">
                        Terapkan
                    </button>
                </div>
            </form>

            <div class="mt-4">
                <a href="{{ route('admin.netflix-accounts.index') }}"
                    class="inline-flex rounded-xl border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Reset Filter
                </a>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-[#7B1E1E] text-white">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Nomor</th>
                            <th class="px-4 py-3 text-left font-semibold">Email</th>
                            <th class="px-4 py-3 text-left font-semibold">Password</th>
                            <th class="px-4 py-3 text-left font-semibold">Tanggal Reset</th>
                            <th class="px-4 py-3 text-left font-semibold">Tipe Sharing</th>
                            <th class="px-4 py-3 text-left font-semibold">Status</th>
                            <th class="px-4 py-3 text-left font-semibold">Deskripsi</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($netflixAccounts as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $netflixAccounts->firstItem() + $loop->index }}</td>
                                <td class="px-4 py-3">{{ $item->email }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <span id="password-netflix-{{ $item->id }}" data-hidden="••••••••"
                                            data-full="{{ $item->password }}" class="font-medium text-gray-700">
                                            ••••••••
                                        </span>
                                        <button type="button" data-target="password-netflix-{{ $item->id }}"
                                            onclick="togglePassword(this)"
                                            class="cursor-pointer rounded-lg border border-[#7B1E1E] px-3 py-1 text-xs font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/10">
                                            Lihat
                                        </button>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    {{ $item->tanggal_reset ? \Carbon\Carbon::parse($item->tanggal_reset)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-4 py-3">{{ $item->tipe_sharing }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium {{ $item->status_reset['class'] }}">
                                        {{ $item->status_reset['label'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">{{ $item->deskripsi ?: '-' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}"
                                            class="rounded-lg border border-[#7B1E1E] px-3 py-2 text-xs font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/10">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.netflix-accounts.destroy', $item->id) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="cursor-pointer rounded-lg bg-red-500 px-3 py-2 text-xs font-medium text-white hover:bg-red-600">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                    Belum ada data rekapan Netflix.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-gray-200 px-4 py-4">
                {{ $netflixAccounts->links() }}
            </div>
        </div>
    </div>
@endsection