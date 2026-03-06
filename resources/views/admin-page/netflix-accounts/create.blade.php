@extends('layouts.admin')

@section('title', 'Tambah Rekapan Netflix - OriRecap')
@section('page-title', 'Tambah Rekapan Netflix')

@section('content')
    <div class="rounded-2xl bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-[#7B1E1E]">Tambah Data Rekapan Netflix</h3>
        <p class="mt-1 text-sm text-gray-500">
            Isi data akun Netflix dengan lengkap.
        </p>

        <form action="{{ route('admin.netflix-accounts.store') }}" method="POST" class="mt-6">
            @csrf
            @include('admin-page.netflix-accounts.form')
        </form>
    </div>
@endsection