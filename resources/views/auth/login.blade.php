<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo-orinimo.png') }}">
    @vite('resources/css/app.css')
    <title>Login - Orinimo Recap</title>
</head>

<body class="min-h-screen bg-gray-100">
    <div class="flex min-h-screen items-center justify-center px-4 py-8">
        <div class="w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-lg">
            <div class="bg-[#7B1E1E] px-6 py-6 text-center">
                <h1 class="text-2xl font-bold text-white">Orinimo Recap</h1>
                <p class="mt-1 text-sm text-white/80">Sistem Rekapan Orinimo</p>
            </div>

            <div class="px-6 py-8">
                <div class="mb-6 text-center">
                    <h2 class="text-xl font-semibold text-[#7B1E1E]">Login Admin</h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Masukkan email dan password untuk masuk
                    </p>
                </div>

                <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            placeholder="Masukkan email"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-800 outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/20"
                            required autofocus>
                        @error('email')
                            <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">
                            Password
                        </label>

                        <div class="relative">
                            <input id="password" type="password" name="password" placeholder="Masukkan password"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 pr-28 text-gray-800 outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/20"
                                required>

                            <button type="button" id="toggle-login-password"
                                class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer rounded-lg border border-[#7B1E1E] px-3 py-1 text-sm font-medium text-[#7B1E1E] hover:bg-[#7B1E1E]/10">
                                Lihat
                            </button>
                        </div>

                        @error('password')
                            <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full cursor-pointer rounded-xl bg-[#7B1E1E] px-4 py-3 font-semibold text-white transition hover:opacity-90">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const loginPasswordInput = document.getElementById('password');
        const toggleLoginPasswordButton = document.getElementById('toggle-login-password');

        if (loginPasswordInput && toggleLoginPasswordButton) {
            toggleLoginPasswordButton.addEventListener('click', function() {
                const isHidden = loginPasswordInput.type === 'password';

                loginPasswordInput.type = isHidden ? 'text' : 'password';
                toggleLoginPasswordButton.textContent = isHidden ? 'Sembunyikan' : 'Lihat';
            });
        }
    </script>
</body>

</html>
