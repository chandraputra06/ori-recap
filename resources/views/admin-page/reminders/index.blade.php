@extends('layouts.admin')

@section('title', 'Reminder - OriRecap')
@section('page-title', 'Reminder')

@section('content')
    <div class="space-y-8">

        {{-- Reminder Rekapan Netflix --}}
        <div>
            <div class="mb-4 flex items-center gap-2">
                <div class="h-4 w-1 rounded-full bg-[#7B1E1E]"></div>
                <h3 class="text-base font-semibold text-slate-800">Reminder Rekapan Netflix</h3>
            </div>

            <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">

                {{-- Reset Hari Ini --}}
                <div class="rounded-2xl bg-white border border-slate-100 shadow-sm overflow-hidden">
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-slate-100 bg-[#7B1E1E]/5">
                        <span class="h-2 w-2 rounded-full bg-[#7B1E1E] shrink-0"></span>
                        <h4 class="text-sm font-semibold text-[#7B1E1E]">Reset Hari Ini</h4>
                    </div>
                    <div class="divide-y divide-slate-50">
                        @forelse ($resetHariIni as $item)
                            <div class="p-4 hover:bg-slate-50/60 transition-colors">
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $item->tipe_sharing }}</p>
                                <p class="mt-1.5 text-xs text-slate-500">
                                    Reset: <span class="font-medium text-slate-700">{{ \Carbon\Carbon::parse($item->tanggal_reset)->format('d M Y') }}</span>
                                </p>
                                <div class="mt-3 flex gap-1.5">
                                    <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}"
                                        class="rounded-lg bg-[#7B1E1E] px-3 py-1.5 text-xs font-medium text-white hover:opacity-90">
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.netflix-accounts.index') }}"
                                        class="rounded-lg border border-[#7B1E1E] px-3 py-1.5 text-xs font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/5">
                                        Buka Rekapan
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="px-4 py-8 text-center">
                                <p class="text-xs text-slate-400">Tidak ada akun reset hari ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Segera Reset --}}
                <div class="rounded-2xl bg-white border border-slate-100 shadow-sm overflow-hidden">
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-slate-100 bg-[#7B1E1E]/5">
                        <span class="h-2 w-2 rounded-full bg-[#7B1E1E] shrink-0"></span>
                        <h4 class="text-sm font-semibold text-[#7B1E1E]">Segera Reset</h4>
                    </div>
                    <div class="divide-y divide-slate-50">
                        @forelse ($segeraReset as $item)
                            <div class="p-4 hover:bg-slate-50/60 transition-colors">
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $item->tipe_sharing }}</p>
                                <p class="mt-1.5 text-xs text-slate-500">
                                    Reset: <span class="font-medium text-slate-700">{{ \Carbon\Carbon::parse($item->tanggal_reset)->format('d M Y') }}</span>
                                </p>
                                <div class="mt-3 flex gap-1.5">
                                    <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}"
                                        class="rounded-lg bg-[#7B1E1E] px-3 py-1.5 text-xs font-medium text-white hover:opacity-90">
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.netflix-accounts.index') }}"
                                        class="rounded-lg border border-[#7B1E1E] px-3 py-1.5 text-xs font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/5">
                                        Buka Rekapan
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="px-4 py-8 text-center">
                                <p class="text-xs text-slate-400">Tidak ada akun yang segera reset.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Lewat Reset --}}
                <div class="rounded-2xl bg-white border border-slate-100 shadow-sm overflow-hidden">
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-slate-100 bg-[#7B1E1E]/5">
                        <span class="h-2 w-2 rounded-full bg-[#7B1E1E] shrink-0"></span>
                        <h4 class="text-sm font-semibold text-[#7B1E1E]">Lewat Reset</h4>
                    </div>
                    <div class="divide-y divide-slate-50">
                        @forelse ($lewatReset as $item)
                            <div class="p-4 hover:bg-slate-50/60 transition-colors">
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $item->tipe_sharing }}</p>
                                <p class="mt-1.5 text-xs text-slate-500">
                                    Reset: <span class="font-medium text-slate-700">{{ \Carbon\Carbon::parse($item->tanggal_reset)->format('d M Y') }}</span>
                                </p>
                                <div class="mt-3 flex gap-1.5">
                                    <a href="{{ route('admin.netflix-accounts.edit', $item->id) }}"
                                        class="rounded-lg bg-[#7B1E1E] px-3 py-1.5 text-xs font-medium text-white hover:opacity-90">
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.netflix-accounts.index') }}"
                                        class="rounded-lg border border-[#7B1E1E] px-3 py-1.5 text-xs font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/5">
                                        Buka Rekapan
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="px-4 py-8 text-center">
                                <p class="text-xs text-slate-400">Tidak ada akun lewat reset.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-slate-100"></div>

        {{-- Reminder Netflix 1 Week --}}
        <div>
            <div class="mb-4 flex items-center gap-2">
                <div class="h-4 w-1 rounded-full bg-[#7B1E1E]"></div>
                <h3 class="text-base font-semibold text-slate-800">Reminder Netflix 1 Week</h3>
            </div>

            <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">

                {{-- Habis Hari Ini --}}
                <div class="rounded-2xl bg-white border border-slate-100 shadow-sm overflow-hidden">
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-slate-100 bg-[#7B1E1E]/5">
                        <span class="h-2 w-2 rounded-full bg-[#7B1E1E] shrink-0"></span>
                        <h4 class="text-sm font-semibold text-[#7B1E1E]">Habis Hari Ini</h4>
                    </div>
                    <div class="divide-y divide-slate-50">
                        @forelse ($habisHariIni as $item)
                            <div class="p-4 hover:bg-slate-50/60 transition-colors">
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                                <p class="mt-1.5 text-xs text-slate-500">
                                    Habis: <span class="font-medium text-slate-700">{{ \Carbon\Carbon::parse($item->durasi_habis)->format('d M Y') }}</span>
                                </p>
                                <div class="mt-3 flex gap-1.5">
                                    <a href="{{ route('admin.netflix-week-accounts.edit', $item->id) }}"
                                        class="rounded-lg bg-[#7B1E1E] px-3 py-1.5 text-xs font-medium text-white hover:opacity-90">
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.netflix-week-accounts.index') }}"
                                        class="rounded-lg border border-[#7B1E1E] px-3 py-1.5 text-xs font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/5">
                                        Buka Netflix 1 Week
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="px-4 py-8 text-center">
                                <p class="text-xs text-slate-400">Tidak ada akun yang habis hari ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Segera Habis --}}
                <div class="rounded-2xl bg-white border border-slate-100 shadow-sm overflow-hidden">
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-slate-100 bg-[#7B1E1E]/5">
                        <span class="h-2 w-2 rounded-full bg-[#7B1E1E] shrink-0"></span>
                        <h4 class="text-sm font-semibold text-[#7B1E1E]">Segera Habis</h4>
                    </div>
                    <div class="divide-y divide-slate-50">
                        @forelse ($segeraHabis as $item)
                            <div class="p-4 hover:bg-slate-50/60 transition-colors">
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                                <p class="mt-1.5 text-xs text-slate-500">
                                    Habis: <span class="font-medium text-slate-700">{{ \Carbon\Carbon::parse($item->durasi_habis)->format('d M Y') }}</span>
                                </p>
                                <div class="mt-3 flex gap-1.5">
                                    <a href="{{ route('admin.netflix-week-accounts.edit', $item->id) }}"
                                        class="rounded-lg bg-[#7B1E1E] px-3 py-1.5 text-xs font-medium text-white hover:opacity-90">
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.netflix-week-accounts.index') }}"
                                        class="rounded-lg border border-[#7B1E1E] px-3 py-1.5 text-xs font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/5">
                                        Buka Netflix 1 Week
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="px-4 py-8 text-center">
                                <p class="text-xs text-slate-400">Tidak ada akun yang segera habis.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Sudah Habis --}}
                <div class="rounded-2xl bg-white border border-slate-100 shadow-sm overflow-hidden">
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-slate-100 bg-[#7B1E1E]/5">
                        <span class="h-2 w-2 rounded-full bg-[#7B1E1E] shrink-0"></span>
                        <h4 class="text-sm font-semibold text-[#7B1E1E]">Sudah Habis</h4>
                    </div>
                    <div class="divide-y divide-slate-50">
                        @forelse ($sudahHabis as $item)
                            <div class="p-4 hover:bg-slate-50/60 transition-colors">
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->email }}</p>
                                <p class="mt-1.5 text-xs text-slate-500">
                                    Habis: <span class="font-medium text-slate-700">{{ \Carbon\Carbon::parse($item->durasi_habis)->format('d M Y') }}</span>
                                </p>
                                <div class="mt-3 flex gap-1.5">
                                    <a href="{{ route('admin.netflix-week-accounts.edit', $item->id) }}"
                                        class="rounded-lg bg-[#7B1E1E] px-3 py-1.5 text-xs font-medium text-white hover:opacity-90">
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.netflix-week-accounts.index') }}"
                                        class="rounded-lg border border-[#7B1E1E] px-3 py-1.5 text-xs font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/5">
                                        Buka Netflix 1 Week
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="px-4 py-8 text-center">
                                <p class="text-xs text-slate-400">Tidak ada akun yang sudah habis.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection