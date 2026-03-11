@extends('layouts.admin')

@section('title', 'Detail Netflix 1 Week - OriRecap')
@section('page-title', 'Detail Netflix 1 Week')

@section('content')
    <div class="rounded-2xl bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg font-bold text-[#7B1E1E]">Detail Akun Netflix 1 Week</h3>
                <p class="mt-1 text-sm text-gray-500">Informasi lengkap akun Netflix 1 Week.</p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('admin.netflix-week-accounts.edit', $netflixWeekAccount->id) }}"
                    class="inline-flex items-center justify-center rounded-xl bg-[#7B1E1E] px-4 py-3 font-medium text-white hover:opacity-90">
                    Edit Data
                </a>

                <a href="{{ route('admin.netflix-week-accounts.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-300 px-4 py-3 font-medium text-gray-700 hover:bg-gray-50">
                    Kembali
                </a>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="rounded-xl border border-gray-200 p-4">
                <p class="text-sm text-gray-500">Email</p>
                <p class="mt-1 font-semibold text-gray-800">{{ $netflixWeekAccount->email }}</p>
            </div>

            <div class="rounded-xl border border-gray-200 p-4">
                <p class="text-sm text-gray-500">Password</p>
                <p class="mt-1 font-semibold text-gray-800">{{ $netflixWeekAccount->password }}</p>
            </div>

            <div class="rounded-xl border border-gray-200 p-4">
                <p class="text-sm text-gray-500">Tanggal Terjual</p>
                <p class="mt-1 font-semibold text-gray-800">
                    {{ $netflixWeekAccount->tanggal_terjual ? \Carbon\Carbon::parse($netflixWeekAccount->tanggal_terjual)->format('d/m/Y') : '-' }}
                </p>
            </div>

            <div class="rounded-xl border border-gray-200 p-4">
                <p class="text-sm text-gray-500">Durasi Habis</p>
                <p class="mt-1 font-semibold text-gray-800">
                    {{ $netflixWeekAccount->durasi_habis ? \Carbon\Carbon::parse($netflixWeekAccount->durasi_habis)->format('d/m/Y') : '-' }}
                </p>
            </div>

            <div class="rounded-xl border border-gray-200 p-4 md:col-span-2">
                <p class="text-sm text-gray-500">Deskripsi</p>
                <p class="mt-1 font-semibold text-gray-800">{{ $netflixWeekAccount->deskripsi ?: '-' }}</p>
            </div>

            <div class="rounded-xl border border-gray-200 p-4 md:col-span-2">
                <p class="text-sm text-gray-500">Status</p>
                <span class="mt-2 inline-flex rounded-full px-3 py-1 text-xs font-medium {{ $netflixWeekAccount->status_habis['class'] }}">
                    {{ $netflixWeekAccount->status_habis['label'] }}
                </span>
            </div>
        </div>
    </div>
@endsection