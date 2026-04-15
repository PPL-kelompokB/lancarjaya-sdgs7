<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Organisasi - EcoDon</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .brand-font { font-family: 'Manrope', sans-serif; }
        .organic-gradient {
            background: linear-gradient(135deg, #003527 0%, #064e3b 100%);
        }
    </style>
</head>
<body class="bg-[#fff8f5] text-[#1f1b17] min-h-screen">

<main class="min-h-screen flex flex-col lg:flex-row">

    <!-- Left branding -->
    <section class="hidden lg:flex lg:w-2/5 bg-[#003527] px-10 py-12 flex-col justify-between relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#6cf8bb] rounded-xl flex items-center justify-center text-white font-bold">
                    E
                </div>
                <span class="text-2xl font-bold text-white brand-font">EcoDon</span>
            </div>

            <div class="mt-20">
                <h1 class="text-4xl xl:text-5xl font-extrabold text-white leading-tight">
                    Empowering <br>
                    <span class="text-[#95d3ba]">Nature's Guardians.</span>
                </h1>
                <p class="mt-5 text-base text-white/80 leading-relaxed max-w-md">
                    Daftarkan organisasi Anda untuk mengelola donasi, membangun transparansi, dan memperluas dampak sosial.
                </p>
            </div>
        </div>

        <div class="relative z-10 space-y-5">
            <div class="bg-white/10 border border-white/10 rounded-2xl p-5 backdrop-blur-sm">
                <h4 class="text-white font-semibold">Verifikasi Organisasi</h4>
                <p class="text-sm text-white/75 mt-1">
                    Setiap organisasi akan melalui proses verifikasi admin sebelum dapat aktif sepenuhnya.
                </p>
            </div>

            <p class="text-xs uppercase tracking-[0.2em] text-white/40 font-semibold">
                © 2024 EcoDon Registry
            </p>
        </div>

        <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-[#6cf8bb]/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 right-0 w-56 h-56 bg-white/10 rounded-full blur-3xl"></div>
    </section>

    <!-- Right form -->
    <section class="flex-1 px-4 sm:px-6 lg:px-12 py-8 sm:py-10 lg:py-12 bg-white">
        <div class="max-w-3xl mx-auto">

            <div class="mb-8">
                <div class="lg:hidden flex items-center gap-2 mb-5">
                    <div class="w-9 h-9 bg-[#003527] rounded-lg flex items-center justify-center text-white font-bold">
                        E
                    </div>
                    <span class="text-xl font-bold text-[#003527] brand-font">EcoDon</span>
                </div>

                <h2 class="text-2xl sm:text-3xl font-bold text-[#003527]">
                    Registrasi Organisasi
                </h2>
                <p class="mt-2 text-sm sm:text-base text-[#404944]">
                    Lengkapi data berikut untuk membuat akun organisasi.
                </p>
            </div>

            @if (session('success'))
                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <p class="font-semibold mb-1">Terjadi kesalahan:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/register/organization') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf

                <!-- 1. User Account -->
                <div class="space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-[#f0e6e0] text-[#003527] flex items-center justify-center font-bold">1</div>
                        <h3 class="text-lg sm:text-xl font-bold text-[#003527]">User Account</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Nama Akun</label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Nama admin akun"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('name') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">Email Akun</label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="admin@organisasi.com"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('email') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">Password</label>
                            <input
                                type="password"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('password') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">Konfirmasi Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="Ulangi password"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527]"
                            >
                        </div>
                    </div>
                </div>

                <!-- 2. Organization Info -->
                <div class="space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-[#f0e6e0] text-[#003527] flex items-center justify-center font-bold">2</div>
                        <h3 class="text-lg sm:text-xl font-bold text-[#003527]">Organization Info</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold mb-2">Nama Organisasi</label>
                            <input
                                type="text"
                                name="organization_name"
                                value="{{ old('organization_name') }}"
                                placeholder="Nama organisasi"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('organization_name') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                            @error('organization_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">Tipe Organisasi</label>
                            <select
                                name="organization_type"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('organization_type') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                                <option value="">-- Pilih Tipe Organisasi --</option>
                                <option value="ngo" {{ old('organization_type') == 'ngo' ? 'selected' : '' }}>NGO / Non-Profit</option>
                                <option value="foundation" {{ old('organization_type') == 'foundation' ? 'selected' : '' }}>Yayasan</option>
                                <option value="community" {{ old('organization_type') == 'community' ? 'selected' : '' }}>Komunitas</option>
                                <option value="social_enterprise" {{ old('organization_type') == 'social_enterprise' ? 'selected' : '' }}>Social Enterprise</option>
                                <option value="government" {{ old('organization_type') == 'government' ? 'selected' : '' }}>Instansi Pemerintah</option>
                                <option value="other" {{ old('organization_type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('organization_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">Tahun Berdiri</label>
                            <input
                                type="text"
                                name="founded_year"
                                value="{{ old('founded_year') }}"
                                placeholder="2020"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('founded_year') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                            @error('founded_year')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold mb-2">Alamat Organisasi</label>
                            <textarea
                                name="address"
                                rows="3"
                                placeholder="Alamat lengkap organisasi"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent resize-none focus:ring-2 focus:ring-[#003527] @error('address') border-red-400 ring-1 ring-red-300 @enderror"
                            >{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold mb-2">No. Telepon Organisasi</label>
                            <input
                                type="text"
                                name="org_phone"
                                value="{{ old('org_phone') }}"
                                placeholder="08xxxxxxxxxx"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('org_phone') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                            @error('org_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold mb-2">Deskripsi Organisasi</label>
                            <textarea
                                name="description"
                                rows="4"
                                placeholder="Ceritakan visi, misi, atau fokus kegiatan organisasi"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent resize-none focus:ring-2 focus:ring-[#003527] @error('description') border-red-400 ring-1 ring-red-300 @enderror"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 3. PIC -->
                <div class="space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-[#f0e6e0] text-[#003527] flex items-center justify-center font-bold">3</div>
                        <h3 class="text-lg sm:text-xl font-bold text-[#003527]">PIC Info</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-[#fcf2eb] rounded-2xl p-4 sm:p-5">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Nama PIC</label>
                            <input
                                type="text"
                                name="pic_name"
                                value="{{ old('pic_name') }}"
                                placeholder="Nama PIC"
                                class="w-full rounded-xl bg-white px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('pic_name') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                            @error('pic_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">Email PIC</label>
                            <input
                                type="email"
                                name="pic_email"
                                value="{{ old('pic_email') }}"
                                placeholder="pic@organisasi.com"
                                class="w-full rounded-xl bg-white px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('pic_email') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                            @error('pic_email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold mb-2">No. HP PIC</label>
                            <input
                                type="text"
                                name="pic_phone"
                                value="{{ old('pic_phone') }}"
                                placeholder="08xxxxxxxxxx"
                                class="w-full rounded-xl bg-white px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('pic_phone') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                            @error('pic_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 4. Bank -->
                <div class="space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-[#f0e6e0] text-[#003527] flex items-center justify-center font-bold">4</div>
                        <h3 class="text-lg sm:text-xl font-bold text-[#003527]">Informasi Bank</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold mb-2">Nama Bank <span class="text-gray-500">(opsional)</span></label>
                            <input
                                type="text"
                                name="bank_name"
                                value="{{ old('bank_name') }}"
                                placeholder="BCA / BNI / Mandiri / dll"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('bank_name') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                            @error('bank_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">Nama Pemilik Rekening <span class="text-gray-500">(opsional)</span></label>
                            <input
                                type="text"
                                name="account_holder_name"
                                value="{{ old('account_holder_name') }}"
                                placeholder="Atas nama"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('account_holder_name') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                            @error('account_holder_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">Nomor Rekening <span class="text-gray-500">(opsional)</span></label>
                            <input
                                type="text"
                                name="rekening_number"
                                value="{{ old('rekening_number') }}"
                                placeholder="1234567890"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('rekening_number') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                            @error('rekening_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold mb-2">Upload Bukti Rekening <span class="text-gray-500">(opsional)</span></label>
                            <input
                                type="file"
                                name="bank_proof"
                                accept=".jpg,.jpeg,.png,.pdf"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent focus:ring-2 focus:ring-[#003527] @error('bank_proof') border-red-400 ring-1 ring-red-300 @enderror"
                            >
                            <p class="mt-1 text-xs text-gray-500">
                                Upload foto buku rekening, screenshot, atau PDF. Maksimal 2MB.
                            </p>
                            @error('bank_proof')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button
                        type="submit"
                        class="w-full organic-gradient text-white font-bold py-3.5 sm:py-4 rounded-xl sm:rounded-full shadow-lg hover:opacity-95 transition"
                    >
                        Complete Registration
                    </button>

                    <p class="mt-5 text-center text-sm text-[#404944]">
                        Sudah punya akun?
                        <a href="{{ url('/login') }}" class="text-[#003527] font-bold hover:underline">
                            Login
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </section>
</main>

</body>
</html>