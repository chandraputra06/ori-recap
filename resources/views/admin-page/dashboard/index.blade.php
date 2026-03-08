@extends('layouts.admin')

@section('title', 'Dashboard - OriRecap')
@section('page-title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            <a href="{{ route('admin.netflix-accounts.index') }}"
               class="block rounded-2xl bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <p class="text-sm text-gray-500">Total Rekapan Netflix</p>
                <h3 class="mt-2 text-3xl font-bold text-[#7B1E1E]">{{ $totalNetflixAccounts }}</h3>
            </a>

            <a href="{{ route('admin.netflix-week-accounts.index') }}"
               class="block rounded-2xl bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <p class="text-sm text-gray-500">Total Netflix 1 Week</p>
                <h3 class="mt-2 text-3xl font-bold text-[#7B1E1E]">{{ $totalNetflixWeekAccounts }}</h3>
            </a>

            <a href="{{ route('admin.reminders.index') }}"
               class="block rounded-2xl bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <p class="text-sm text-gray-500">Reset Hari Ini</p>
                <h3 class="mt-2 text-3xl font-bold text-orange-600">{{ $resetHariIni }}</h3>
            </a>

            <a href="{{ route('admin.reminders.index') }}"
               class="block rounded-2xl bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <p class="text-sm text-gray-500">Habis Hari Ini</p>
                <h3 class="mt-2 text-3xl font-bold text-red-600">{{ $habisHariIni }}</h3>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            <a href="{{ route('admin.reminders.index') }}"
               class="block rounded-2xl bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <p class="text-sm text-gray-500">Segera Reset</p>
                <h3 class="mt-2 text-3xl font-bold text-yellow-600">{{ $segeraReset }}</h3>
            </a>

            <a href="{{ route('admin.reminders.index') }}"
               class="block rounded-2xl bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <p class="text-sm text-gray-500">Lewat Reset</p>
                <h3 class="mt-2 text-3xl font-bold text-red-600">{{ $lewatReset }}</h3>
            </a>

            <a href="{{ route('admin.reminders.index') }}"
               class="block rounded-2xl bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <p class="text-sm text-gray-500">Segera Habis</p>
                <h3 class="mt-2 text-3xl font-bold text-yellow-600">{{ $segeraHabis }}</h3>
            </a>

            <a href="{{ route('admin.reminders.index') }}"
               class="block rounded-2xl bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <p class="text-sm text-gray-500">Sudah Habis</p>
                <h3 class="mt-2 text-3xl font-bold text-red-600">{{ $sudahHabis }}</h3>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-[#7B1E1E]">Reset Terdekat</h3>
                    <a href="{{ route('admin.netflix-accounts.index') }}"
                       class="text-sm font-medium text-[#7B1E1E] hover:underline">
                        Lihat Semua
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse ($resetTerdekat as $item)
                        <div class="rounded-xl border border-gray-200 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $item->email }}</p>
                                    <p class="mt-1 text-sm text-gray-500">{{ $item->tipe_sharing }}</p>
                                </div>
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium {{ $item->status_reset['class'] }}">
                                    {{ $item->status_reset['label'] }}
                                </span>
                            </div>

                            <p class="mt-3 text-sm text-gray-600">
                                Tanggal Reset:
                                <span class="font-medium">
                                    {{ \Carbon\Carbon::parse($item->tanggal_reset)->format('d M Y') }}
                                </span>
                            </p>

                            <div class="mt-4">
                                <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}"
                                   class="inline-flex rounded-lg bg-[#7B1E1E] px-3 py-2 text-xs font-medium text-white hover:opacity-90">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-xl border border-dashed border-gray-300 p-4 text-sm text-gray-500">
                            Belum ada data tanggal reset.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-[#7B1E1E]">Durasi Habis Terdekat</h3>
                    <a href="{{ route('admin.netflix-week-accounts.index') }}"
                       class="text-sm font-medium text-[#7B1E1E] hover:underline">
                        Lihat Semua
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse ($habisTerdekat as $item)
                        <div class="rounded-xl border border-gray-200 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $item->email }}</p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Tanggal Terjual:
                                        {{ $item->tanggal_terjual ? \Carbon\Carbon::parse($item->tanggal_terjual)->format('d M Y') : '-' }}
                                    </p>
                                </div>
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium {{ $item->status_habis['class'] }}">
                                    {{ $item->status_habis['label'] }}
                                </span>
                            </div>

                            <p class="mt-3 text-sm text-gray-600">
                                Durasi Habis:
                                <span class="font-medium">
                                    {{ \Carbon\Carbon::parse($item->durasi_habis)->format('d M Y') }}
                                </span>
                            </p>

                            <div class="mt-4">
                                <a href="{{ route('admin.netflix-week-accounts.edit', $item->id) }}"
                                   class="inline-flex rounded-lg bg-[#7B1E1E] px-3 py-2 text-xs font-medium text-white hover:opacity-90">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-xl border border-dashed border-gray-300 p-4 text-sm text-gray-500">
                            Belum ada data durasi habis.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection