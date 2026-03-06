<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">
            Akun / Email
        </label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $netflixAccount->email ?? '') }}"
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
            value="{{ old('password', $netflixAccount->password ?? '') }}"
            class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/20"
            placeholder="Masukkan password akun"
            required
        >
        @error('password')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="tanggal_reset" class="mb-1.5 block text-sm font-medium text-gray-700">
            Tanggal Reset
        </label>
        <input
            type="date"
            id="tanggal_reset"
            name="tanggal_reset"
            value="{{ old('tanggal_reset', $netflixAccount->tanggal_reset ?? '') }}"
            class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/20"
        >
        @error('tanggal_reset')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="tipe_sharing" class="mb-1.5 block text-sm font-medium text-gray-700">
            Tipe Sharing
        </label>
        <select
            id="tipe_sharing"
            name="tipe_sharing"
            class="w-full cursor-pointer rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#7B1E1E] focus:ring-2 focus:ring-[#7B1E1E]/20"
            required
        >
            <option value="">Pilih tipe sharing</option>
            @foreach ($sharingOptions as $option)
                <option
                    value="{{ $option }}"
                    @selected(old('tipe_sharing', $netflixAccount->tipe_sharing ?? '') === $option)
                >
                    {{ $option }}
                </option>
            @endforeach
        </select>
        @error('tipe_sharing')
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
        >{{ old('deskripsi', $netflixAccount->deskripsi ?? '') }}</textarea>
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
        href="{{ route('admin.netflix-accounts.index') }}"
        class="rounded-xl border border-gray-300 px-5 py-3 font-medium text-gray-700 hover:bg-gray-50"
    >
        Batal
    </a>
</div>