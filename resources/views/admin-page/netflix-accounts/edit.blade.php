@extends('layouts.admin')

@section('title', 'Edit Rekapan Netflix - OriRecap')
@section('page-title', 'Edit Rekapan Netflix')

@section('content')
    <div class="rounded-2xl bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-[#7B1E1E]">Edit Data Rekapan Netflix</h3>
        <p class="mt-1 text-sm text-gray-500">
            Perbarui data akun Netflix sesuai kebutuhan.
        </p>

        <form action="{{ route('admin.netflix-accounts.update', $netflixAccount->id) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')

            @include('admin-page.netflix-accounts.form')
        </form>
    </div>
@endsection