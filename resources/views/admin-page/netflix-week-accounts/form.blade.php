<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">
            Akun / Email
        </label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $netflixWeekAccount->email ?? '') }}"
            class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/20"
            placeholder="Masukkan email akun"
            required
        >
        @error('email')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">
            Password
        </label>
        <input
            type="text"
            id="password"
            name="password"
            value="{{ old('password', $netflixWeekAccount->password ?? '') }}"
            class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/20"
            placeholder="Masukkan password akun"
            required
        >
        @error('password')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="tanggal_terjual" class="mb-1.5 block text-sm font-medium text-gray-700">
            Tanggal Terjual
        </label>
        <input
            type="date"
            id="tanggal_terjual"
            name="tanggal_terjual"
            value="{{ old('tanggal_terjual', $netflixWeekAccount->tanggal_terjual ?? '') }}"
            class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/20"
        >
        @error('tanggal_terjual')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="durasi_habis" class="mb-1.5 block text-sm font-medium text-gray-700">
            Durasi Habis
        </label>
        <input
            type="date"
            id="durasi_habis"
            name="durasi_habis"
            value="{{ old('durasi_habis', $netflixWeekAccount->durasi_habis ?? '') }}"
            class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/20"
        >
        @error('durasi_habis')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="deskripsi" class="mb-1.5 block text-sm font-medium text-gray-700">
            Deskripsi
        </label>
        <textarea
            id="deskripsi"
            name="deskripsi"
            rows="4"
            class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/20"
            placeholder="Masukkan deskripsi jika ada"
        >{{ old('deskripsi', $netflixWeekAccount->deskripsi ?? '') }}</textarea>
        @error('deskripsi')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button
        type="submit"
        class="cursor-pointer rounded-xl bg-[#7B1E1E] px-5 py-3 font-semibold text-white hover:opacity-90"
    >
        Simpan
    </button>

    <a
        href="{{ route('admin.netflix-week-accounts.index') }}"
        class="rounded-xl border border-gray-300 px-5 py-3 font-medium text-gray-700 hover:bg-gray-50"
    >
        Batal
    </a>
</div>