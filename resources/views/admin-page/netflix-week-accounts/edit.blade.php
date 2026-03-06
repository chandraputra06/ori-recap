@extends('layouts.admin')

@section('title', 'Edit Netflix 1 Week - OriRecap')
@section('page-title', 'Edit Netflix 1 Week')

@section('content')
    <div class="rounded-2xl bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-[#7B1E1E]">Edit Data Netflix 1 Week</h3>
        <p class="mt-1 text-sm text-gray-500">
            Perbarui data akun Netflix 1 Week sesuai kebutuhan.
        </p>

        <form action="{{ route('admin.netflix-week-accounts.update', $netflixWeekAccount->id) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')

            @include('admin-page.netflix-week-accounts.form')
        </form>
    </div>
@endsection