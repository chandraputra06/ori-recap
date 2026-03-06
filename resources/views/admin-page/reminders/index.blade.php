@extends('layouts.admin')

@section('title', 'Reminder - OriRecap')
@section('page-title', 'Reminder')

@section('content')
    <div class="space-y-8">
        <div>
            <h3 class="mb-4 text-xl font-bold text-[#7B1E1E]">Reminder Rekapan Netflix</h3>

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
                <div class="rounded-2xl bg-white p-5 shadow-sm">
                    <h4 class="text-lg font-semibold text-orange-600">Reset Hari Ini</h4>
                    <div class="mt-4 space-y-3">
                        @forelse ($resetHariIni as $item)
                            <div class="rounded-xl border border-gray-200 p-4">
                                <p class="font-semibold text-gray-800">{{ $item->email }}</p>
                                <p class="mt-1 text-sm text-gray-500">{{ $item->tipe_sharing }}</p>
                                <p class="mt-2 text-sm text-gray-600">
                                    Tanggal Reset:
                                    <span class="font-medium">
                                        {{ \Carbon\Carbon::parse($item->tanggal_reset)->format('d M Y') }}
                                    </span>
                                </p>
                            </div>
                        @empty
                            <div class="rounded-xl border border-dashed border-gray-300 p-4 text-sm text-gray-500">
                                Tidak ada akun reset hari ini.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-5 shadow-sm">
                    <h4 class="text-lg font-semibold text-yellow-600">Segera Reset</h4>
                    <div class="mt-4 space-y-3">
                        @forelse ($segeraReset as $item)
                            <div class="rounded-xl border border-gray-200 p-4">
                                <p class="font-semibold text-gray-800">{{ $item->email }}</p>
                                <p class="mt-1 text-sm text-gray-500">{{ $item->tipe_sharing }}</p>
                                <p class="mt-2 text-sm text-gray-600">
                                    Tanggal Reset:
                                    <span class="font-medium">
                                        {{ \Carbon\Carbon::parse($item->tanggal_reset)->format('d M Y') }}
                                    </span>
                                </p>
                            </div>
                        @empty
                            <div class="rounded-xl border border-dashed border-gray-300 p-4 text-sm text-gray-500">
                                Tidak ada akun yang segera reset.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-5 shadow-sm">
                    <h4 class="text-lg font-semibold text-red-600">Lewat Reset</h4>
                    <div class="mt-4 space-y-3">
                        @forelse ($lewatReset as $item)
                            <div class="rounded-xl border border-gray-200 p-4">
                                <p class="font-semibold text-gray-800">{{ $item->email }}</p>
                                <p class="mt-1 text-sm text-gray-500">{{ $item->tipe_sharing }}</p>
                                <p class="mt-2 text-sm text-gray-600">
                                    Tanggal Reset:
                                    <span class="font-medium">
                                        {{ \Carbon\Carbon::parse($item->tanggal_reset)->format('d M Y') }}
                                    </span>
                                </p>
                            </div>
                        @empty
                            <div class="rounded-xl border border-dashed border-gray-300 p-4 text-sm text-gray-500">
                                Tidak ada akun lewat reset.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h3 class="mb-4 text-xl font-bold text-[#7B1E1E]">Reminder Netflix 1 Week</h3>

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
                <div class="rounded-2xl bg-white p-5 shadow-sm">
                    <h4 class="text-lg font-semibold text-orange-600">Habis Hari Ini</h4>
                    <div class="mt-4 space-y-3">
                        @forelse ($habisHariIni as $item)
                            <div class="rounded-xl border border-gray-200 p-4">
                                <p class="font-semibold text-gray-800">{{ $item->email }}</p>
                                <p class="mt-2 text-sm text-gray-600">
                                    Durasi Habis:
                                    <span class="font-medium">
                                        {{ \Carbon\Carbon::parse($item->durasi_habis)->format('d M Y') }}
                                    </span>
                                </p>
                            </div>
                        @empty
                            <div class="rounded-xl border border-dashed border-gray-300 p-4 text-sm text-gray-500">
                                Tidak ada akun yang habis hari ini.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-5 shadow-sm">
                    <h4 class="text-lg font-semibold text-yellow-600">Segera Habis</h4>
                    <div class="mt-4 space-y-3">
                        @forelse ($segeraHabis as $item)
                            <div class="rounded-xl border border-gray-200 p-4">
                                <p class="font-semibold text-gray-800">{{ $item->email }}</p>
                                <p class="mt-2 text-sm text-gray-600">
                                    Durasi Habis:
                                    <span class="font-medium">
                                        {{ \Carbon\Carbon::parse($item->durasi_habis)->format('d M Y') }}
                                    </span>
                                </p>
                            </div>
                        @empty
                            <div class="rounded-xl border border-dashed border-gray-300 p-4 text-sm text-gray-500">
                                Tidak ada akun yang segera habis.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-5 shadow-sm">
                    <h4 class="text-lg font-semibold text-red-600">Sudah Habis</h4>
                    <div class="mt-4 space-y-3">
                        @forelse ($sudahHabis as $item)
                            <div class="rounded-xl border border-gray-200 p-4">
                                <p class="font-semibold text-gray-800">{{ $item->email }}</p>
                                <p class="mt-2 text-sm text-gray-600">
                                    Durasi Habis:
                                    <span class="font-medium">
                                        {{ \Carbon\Carbon::parse($item->durasi_habis)->format('d M Y') }}
                                    </span>
                                </p>
                            </div>
                        @empty
                            <div class="rounded-xl border border-dashed border-gray-300 p-4 text-sm text-gray-500">
                                Tidak ada akun yang sudah habis.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection