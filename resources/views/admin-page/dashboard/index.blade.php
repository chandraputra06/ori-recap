@extends('layouts.admin')

@section('title', 'Dashboard - OriRecap')
@section('page-title', 'Dashboard')

@section('content')
    <div class="space-y-6">

        {{-- Stats Row 1 --}}
        <div class="grid grid-cols-2 gap-3 xl:grid-cols-4">
            <a href="{{ route('admin.netflix-accounts.index') }}"
               class="group block rounded-2xl bg-white border border-slate-100 p-5 shadow-sm hover:shadow-md hover:border-[#7B1E1E]/20 transition-all duration-200">
                <p class="text-sm font-medium text-slate-500">Total Rekapan Netflix</p>
                <h3 class="mt-3 text-3xl font-bold text-[#7B1E1E]">{{ $totalNetflixAccounts }}</h3>
                <p class="mt-1 text-xs text-slate-400 group-hover:text-[#7B1E1E] transition-colors">Lihat semua →</p>
            </a>

            <a href="{{ route('admin.netflix-week-accounts.index') }}"
               class="group block rounded-2xl bg-white border border-slate-100 p-5 shadow-sm hover:shadow-md hover:border-[#7B1E1E]/20 transition-all duration-200">
                <p class="text-sm font-medium text-slate-500">Total Netflix 1 Week</p>
                <h3 class="mt-3 text-3xl font-bold text-[#7B1E1E]">{{ $totalNetflixWeekAccounts }}</h3>
                <p class="mt-1 text-xs text-slate-400 group-hover:text-[#7B1E1E] transition-colors">Lihat semua →</p>
            </a>

            <a href="{{ route('admin.reminders.index') }}"
               class="group block rounded-2xl bg-white border border-slate-100 p-5 shadow-sm hover:shadow-md hover:border-[#7B1E1E]/20 transition-all duration-200">
                <p class="text-sm font-medium text-slate-500">Reset Hari Ini</p>
                <h3 class="mt-3 text-3xl font-bold text-[#7B1E1E]">{{ $resetHariIni }}</h3>
                <p class="mt-1 text-xs text-slate-400 group-hover:text-[#7B1E1E] transition-colors">Lihat detail →</p>
            </a>

            <a href="{{ route('admin.reminders.index') }}"
               class="group block rounded-2xl bg-white border border-slate-100 p-5 shadow-sm hover:shadow-md hover:border-[#7B1E1E]/20 transition-all duration-200">
                <p class="text-sm font-medium text-slate-500">Habis Hari Ini</p>
                <h3 class="mt-3 text-3xl font-bold text-[#7B1E1E]">{{ $habisHariIni }}</h3>
                <p class="mt-1 text-xs text-slate-400 group-hover:text-[#7B1E1E] transition-colors">Lihat detail →</p>
            </a>
        </div>

        {{-- Stats Row 2 --}}
        <div class="grid grid-cols-2 gap-3 xl:grid-cols-4">
            <a href="{{ route('admin.reminders.index') }}"
               class="group block rounded-2xl bg-white border border-slate-100 p-5 shadow-sm hover:shadow-md hover:border-[#7B1E1E]/20 transition-all duration-200">
                <p class="text-sm font-medium text-slate-500">Segera Reset</p>
                <h3 class="mt-3 text-3xl font-bold text-[#7B1E1E]">{{ $segeraReset }}</h3>
                <p class="mt-1 text-xs text-slate-400 group-hover:text-[#7B1E1E] transition-colors">Lihat detail →</p>
            </a>

            <a href="{{ route('admin.reminders.index') }}"
               class="group block rounded-2xl bg-white border border-slate-100 p-5 shadow-sm hover:shadow-md hover:border-[#7B1E1E]/20 transition-all duration-200">
                <p class="text-sm font-medium text-slate-500">Lewat Reset</p>
                <h3 class="mt-3 text-3xl font-bold text-[#7B1E1E]">{{ $lewatReset }}</h3>
                <p class="mt-1 text-xs text-slate-400 group-hover:text-[#7B1E1E] transition-colors">Lihat detail →</p>
            </a>

            <a href="{{ route('admin.reminders.index') }}"
               class="group block rounded-2xl bg-white border border-slate-100 p-5 shadow-sm hover:shadow-md hover:border-[#7B1E1E]/20 transition-all duration-200">
                <p class="text-sm font-medium text-slate-500">Segera Habis</p>
                <h3 class="mt-3 text-3xl font-bold text-[#7B1E1E]">{{ $segeraHabis }}</h3>
                <p class="mt-1 text-xs text-slate-400 group-hover:text-[#7B1E1E] transition-colors">Lihat detail →</p>
            </a>

            <a href="{{ route('admin.reminders.index') }}"
               class="group block rounded-2xl bg-white border border-slate-100 p-5 shadow-sm hover:shadow-md hover:border-[#7B1E1E]/20 transition-all duration-200">
                <p class="text-sm font-medium text-slate-500">Sudah Habis</p>
                <h3 class="mt-3 text-3xl font-bold text-[#7B1E1E]">{{ $sudahHabis }}</h3>
                <p class="mt-1 text-xs text-slate-400 group-hover:text-[#7B1E1E] transition-colors">Lihat detail →</p>
            </a>
        </div>

        {{-- Detail Panels --}}
        <div class="grid grid-cols-1 gap-5 xl:grid-cols-2">
            {{-- Reset Terdekat --}}
            <div class="rounded-2xl bg-white border border-slate-100 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                    <h3 class="text-sm font-semibold text-slate-800">Reset Terdekat</h3>
                    <a href="{{ route('admin.netflix-accounts.index') }}"
                       class="text-xs font-medium text-[#7B1E1E] hover:underline">
                        Lihat Semua
                    </a>
                </div>

                <div class="divide-y divide-slate-50">
                    @forelse ($resetTerdekat as $item)
                        <div class="px-5 py-4 hover:bg-slate-50 transition-colors">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">{{ $item->tipe_sharing }}</p>
                                </div>

                                <span class="shrink-0 inline-flex rounded-full border border-[#7B1E1E]/10 bg-[#7B1E1E]/5 px-2.5 py-1 text-xs font-medium text-[#7B1E1E]">
                                    {{ $item->status_reset['label'] }}
                                </span>
                            </div>

                            <div class="mt-2 flex items-center justify-between">
                                <p class="text-xs text-slate-500">
                                    Reset:
                                    <span class="font-medium text-slate-700">
                                        {{ \Carbon\Carbon::parse($item->tanggal_reset)->format('d/m/Y') }}
                                    </span>
                                </p>

                                <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}"
                                   class="inline-flex rounded-lg bg-[#7B1E1E] px-2.5 py-1.5 text-xs font-medium text-white hover:opacity-90">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="px-5 py-8 text-center">
                            <p class="text-sm text-slate-400">Belum ada data tanggal reset.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Durasi Habis Terdekat --}}
            <div class="rounded-2xl bg-white border border-slate-100 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                    <h3 class="text-sm font-semibold text-slate-800">Durasi Habis Terdekat</h3>
                    <a href="{{ route('admin.netflix-week-accounts.index') }}"
                       class="text-xs font-medium text-[#7B1E1E] hover:underline">
                        Lihat Semua
                    </a>
                </div>

                <div class="divide-y divide-slate-50">
                    @forelse ($habisTerdekat as $item)
                        <div class="px-5 py-4 hover:bg-slate-50 transition-colors">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">
                                        Terjual: {{ $item->tanggal_terjual ? \Carbon\Carbon::parse($item->tanggal_terjual)->format('d/m/Y') : '-' }}
                                    </p>
                                </div>

                                <span class="shrink-0 inline-flex rounded-full border border-[#7B1E1E]/10 bg-[#7B1E1E]/5 px-2.5 py-1 text-xs font-medium text-[#7B1E1E]">
                                    {{ $item->status_habis['label'] }}
                                </span>
                            </div>

                            <div class="mt-2 flex items-center justify-between">
                                <p class="text-xs text-slate-500">
                                    Habis:
                                    <span class="font-medium text-slate-700">
                                        {{ \Carbon\Carbon::parse($item->durasi_habis)->format('d/m/Y') }}
                                    </span>
                                </p>

                                <a href="{{ route('admin.netflix-week-accounts.edit', $item->id) }}"
                                   class="inline-flex rounded-lg bg-[#7B1E1E] px-2.5 py-1.5 text-xs font-medium text-white hover:opacity-90">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="px-5 py-8 text-center">
                            <p class="text-sm text-slate-400">Belum ada data durasi habis.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
@endsection