<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User - EcoDon</title>

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

    <header class="w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 flex items-center justify-between">
            <div class="text-xl sm:text-2xl font-bold text-[#003527] brand-font">
                EcoDon
            </div>
            <a href="#" class="text-sm font-semibold text-[#006c49] hover:underline">
                Pusat Bantuan
            </a>
        </div>
    </header>

    <main class="px-4 sm:px-6 lg:px-8 py-6 sm:py-10">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">

            <!-- Left -->
            <div class="lg:col-span-5 flex flex-col justify-center gap-6 order-2 lg:order-1">
                <div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#003527] leading-tight">
                        Mulai Perjalanan Kebaikan Anda.
                    </h1>
                    <p class="mt-3 text-sm sm:text-base lg:text-lg text-[#404944] leading-relaxed">
                        Bergabunglah dengan ribuan donatur lainnya untuk menciptakan dampak nyata bagi lingkungan dan masyarakat.
                    </p>
                </div>

                <div class="relative rounded-2xl overflow-hidden shadow-lg aspect-[4/3]">
                    <img
                        src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?q=80&w=1200&auto=format&fit=crop"
                        alt="Tanaman tumbuh"
                        class="w-full h-full object-cover"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-[#003527]/70 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20">
                            <p class="text-white text-sm italic">
                                "EcoDon membantu saya menyalurkan bantuan ke organisasi yang tepat dengan transparansi penuh."
                            </p>
                            <p class="text-white font-bold text-xs mt-2">
                                — Sarah J., Impact Partner
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right -->
            <div class="lg:col-span-7 order-1 lg:order-2">
                <div class="bg-[#f6ece6] rounded-2xl p-5 sm:p-7 lg:p-10 shadow-lg border border-[#bfc9c3]/20">

                    <div class="mb-6">
                        <h2 class="text-2xl sm:text-3xl font-bold text-[#003527]">
                            Daftar sebagai User
                        </h2>
                        <p class="mt-2 text-sm sm:text-base text-[#404944]">
                            Buat akun pendonasi untuk mulai berdonasi dengan mudah.
                        </p>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <p class="font-semibold mb-1">Terjadi kesalahan:</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('/register') }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#1f1b17]/70 mb-2">
                                    Nama
                                </label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name') }}"
                                    placeholder="Nama lengkap Anda"
                                    class="w-full rounded-xl sm:rounded-full border border-transparent bg-white px-4 sm:px-5 py-3 sm:py-4 text-sm sm:text-base focus:border-[#003527] focus:ring-2 focus:ring-[#003527] @error('name') border-red-400 ring-1 ring-red-300 @enderror"
                                >
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#1f1b17]/70 mb-2">
                                    Email
                                </label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    placeholder="contoh@mail.com"
                                    class="w-full rounded-xl sm:rounded-full border border-transparent bg-white px-4 sm:px-5 py-3 sm:py-4 text-sm sm:text-base focus:border-[#003527] focus:ring-2 focus:ring-[#003527] @error('email') border-red-400 ring-1 ring-red-300 @enderror"
                                >
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="address" class="block text-xs font-bold uppercase tracking-wider text-[#1f1b17]/70 mb-2">
                                Alamat
                            </label>
                            <textarea
                                id="address"
                                name="address"
                                rows="3"
                                placeholder="Alamat lengkap rumah atau kantor"
                                class="w-full rounded-xl border border-transparent bg-white px-4 sm:px-5 py-3 sm:py-4 text-sm sm:text-base resize-none focus:border-[#003527] focus:ring-2 focus:ring-[#003527] @error('address') border-red-400 ring-1 ring-red-300 @enderror"
                            >{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-[#1f1b17]/70 mb-2">
                                No HP
                            </label>
                            <div class="flex gap-2">
                                <div class="shrink-0 flex items-center justify-center rounded-xl sm:rounded-full bg-[#eae1da] px-4 text-sm font-semibold text-[#1f1b17]">
                                    +62
                                </div>
                                <input
                                    id="phone"
                                    name="phone"
                                    type="text"
                                    value="{{ old('phone') }}"
                                    placeholder="81234567890"
                                    class="w-full rounded-xl sm:rounded-full border border-transparent bg-white px-4 sm:px-5 py-3 sm:py-4 text-sm sm:text-base focus:border-[#003527] focus:ring-2 focus:ring-[#003527] @error('phone') border-red-400 ring-1 ring-red-300 @enderror"
                                >
                            </div>
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                            <div>
                                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#1f1b17]/70 mb-2">
                                    Password
                                </label>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    placeholder="Minimal 8 karakter"
                                    class="w-full rounded-xl sm:rounded-full border border-transparent bg-white px-4 sm:px-5 py-3 sm:py-4 text-sm sm:text-base focus:border-[#003527] focus:ring-2 focus:ring-[#003527] @error('password') border-red-400 ring-1 ring-red-300 @enderror"
                                >
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-[#1f1b17]/70 mb-2">
                                    Konfirmasi Password
                                </label>
                                <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    placeholder="Ulangi password"
                                    class="w-full rounded-xl sm:rounded-full border border-transparent bg-white px-4 sm:px-5 py-3 sm:py-4 text-sm sm:text-base focus:border-[#003527] focus:ring-2 focus:ring-[#003527]"
                                >
                            </div>
                        </div>

                        <div class="pt-2">
                            <button
                                type="submit"
                                class="w-full organic-gradient text-white font-bold py-3.5 sm:py-4 rounded-xl sm:rounded-full shadow-lg hover:opacity-95 transition"
                            >
                                Daftar sebagai User
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 p-4 sm:p-5 bg-[#6cf8bb]/10 rounded-2xl border border-[#6cf8bb]/30 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                        <div class="text-center sm:text-left">
                            <p class="text-sm font-semibold text-[#003527]">
                                Mau daftar sebagai organisasi sosial?
                            </p>
                            <p class="text-xs sm:text-sm text-[#404944] mt-1">
                                Kelola donasi dan program keberlanjutan Anda.
                            </p>
                        </div>
                        <a
                            href="{{ url('/register/organization') }}"
                            class="inline-flex justify-center items-center px-5 py-3 bg-[#006c49] text-white text-sm font-semibold rounded-xl sm:rounded-full hover:bg-[#003527] transition"
                        >
                            Register Organisasi
                        </a>
                    </div>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-[#404944]">
                            Sudah punya akun?
                            <a href="{{ url('/login') }}" class="text-[#003527] font-bold hover:underline">
                                Login
                            </a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="bg-[#003527] mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="text-center md:text-left">
                <p class="text-white font-bold text-lg">EcoDon</p>
                <p class="text-stone-300 text-sm">© 2024 EcoDon. All rights reserved.</p>
            </div>
            <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
                <a href="#" class="text-stone-300 text-sm hover:text-white">Privacy Policy</a>
                <a href="#" class="text-stone-300 text-sm hover:text-white">Terms of Service</a>
                <a href="#" class="text-stone-300 text-sm hover:text-white">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>