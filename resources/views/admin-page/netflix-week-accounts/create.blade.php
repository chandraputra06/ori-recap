@extends('layouts.admin')

@section('title', 'Tambah Netflix 1 Week - OriRecap')
@section('page-title', 'Tambah Netflix 1 Week')

@section('content')
    <div class="rounded-2xl bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-[#7B1E1E]">Tambah Data Netflix 1 Week</h3>
        <p class="mt-1 text-sm text-gray-500">
            Isi data akun Netflix 1 Week dengan lengkap.
        </p>

        <form action="{{ route('admin.netflix-week-accounts.store') }}" method="POST" class="mt-6">
            @csrf
            @include('admin-page.netflix-week-accounts.form')
        </form>
    </div>
@endsection