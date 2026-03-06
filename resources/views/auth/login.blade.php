<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Login - OriRecap</title>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md rounded-2xl bg-white p-8 shadow-lg">
            <h1 class="text-2xl font-bold text-gray-800 text-center">Login Admin</h1>
            <p class="mt-2 text-sm text-gray-500 text-center">Masuk ke sistem rekapan OriRecap</p>

            <form action="{{ route('login.process') }}" method="POST" class="mt-6 space-y-4">
                @csrf

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:outline-none"
                        placeholder="Masukkan email"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:outline-none"
                        placeholder="Masukkan password"
                    >
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full rounded-lg bg-blue-600 px-4 py-2.5 font-medium text-white hover:bg-blue-700"
                >
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>