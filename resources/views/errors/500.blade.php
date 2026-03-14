<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo-orinimo.png') }}">
    @include('layouts.styles.tailwind')
    <title>500 - Terjadi Kesalahan</title>
</head>
<body class="min-h-screen bg-gray-100">
    <div class="flex min-h-screen items-center justify-center px-4">
        <div class="w-full max-w-lg rounded-3xl bg-white p-8 text-center shadow-lg">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-[#7B1E1E]/10">
                <span class="text-3xl font-bold text-[#7B1E1E]">500</span>
            </div>

            <h1 class="mt-6 text-2xl font-bold text-[#7B1E1E]">Terjadi Kesalahan</h1>
            <p class="mt-3 text-gray-600">
                Maaf, sistem sedang mengalami gangguan. Coba lagi beberapa saat lagi.
            </p>

            <div class="mt-6 flex flex-col justify-center gap-3 sm:flex-row">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-[#7B1E1E] px-5 py-3 font-medium text-white hover:opacity-90">
                    Kembali ke Dashboard
                </a>

                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-300 px-5 py-3 font-medium text-gray-700 hover:bg-gray-50">
                    Coba Lagi
                </a>
            </div>
        </div>
    </div>
</body>
</html>