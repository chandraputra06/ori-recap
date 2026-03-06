<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Dashboard - OriRecap</title>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen p-6">
        <div class="rounded-2xl bg-white p-6 shadow">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="mt-2 text-gray-600">Login berhasil. Nanti di sini kita isi ringkasan data rekapan.</p>

            <form action="{{ route('logout') }}" method="POST" class="mt-6">
                @csrf
                <button
                    type="submit"
                    class="rounded-lg bg-red-500 px-4 py-2 text-white hover:bg-red-600"
                >
                    Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html>