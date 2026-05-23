<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EcoDon</title>

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
    <section class="hidden lg:flex lg:w-3/5 bg-[#003527] relative overflow-hidden items-center justify-center px-12 py-16">
        <div class="absolute inset-0">
            <img
                src="{{ asset('images/login_ecodon.jpg') }}"
                alt="EcoDon Login Background"
                class="w-full h-full object-cover opacity-30"
            >
            <div class="absolute inset-0 bg-gradient-to-tr from-[#003527] via-[#003527]/85 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-2xl">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-12 h-12 rounded-full bg-[#6cf8bb] flex items-center justify-center text-[#003527] font-extrabold">
                    E
                </div>
                <span class="text-3xl font-extrabold tracking-tight text-white brand-font">EcoDon</span>
            </div>

            <h1 class="text-5xl xl:text-6xl font-extrabold text-white leading-tight tracking-tight">
                Selamat Datang Kembali di
                <span class="text-[#95d3ba]">EcoDon</span>
            </h1>

            <p class="mt-6 text-lg text-white/80 leading-relaxed max-w-xl">
                Masuk untuk melanjutkan kontribusi Anda, mengelola aktivitas donasi, dan memantau dampak baik yang telah dibuat.
            </p>

            <div class="mt-10 bg-white/10 border border-white/10 rounded-2xl p-5 backdrop-blur-sm max-w-lg">
                <h4 class="text-white font-semibold">Platform Donasi Berkelanjutan</h4>
                <p class="text-sm text-white/75 mt-1">
                    Hubungkan donatur, organisasi, dan dampak sosial dalam satu ekosistem digital yang transparan.
                </p>
            </div>
        </div>

        <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-[#6cf8bb]/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    </section>

    <!-- Right login form -->
    <section class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-10 py-8 sm:py-10 bg-[#fff8f5]">
        <div class="w-full max-w-md">

            <!-- Mobile logo -->
            <div class="lg:hidden flex items-center gap-2 mb-8">
                <div class="w-10 h-10 rounded-lg bg-[#003527] flex items-center justify-center text-white font-bold">
                    E
                </div>
                <span class="text-2xl font-bold text-[#003527] brand-font">EcoDon</span>
            </div>

            <div class="bg-white rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.08)] border border-[#e5ddd7] p-6 sm:p-8">
                <div class="mb-8">
                    <h2 class="text-3xl sm:text-4xl font-bold text-[#003527] tracking-tight">
                        Login
                    </h2>
                    <p class="mt-2 text-sm sm:text-base text-[#404944]">
                        Masuk ke akun EcoDon kamu
                    </p>
                </div>

                @if (session('success'))
                    <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        <p class="font-semibold mb-1">Login gagal:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-[#003527] mb-2">
                            Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="contoh@email.com"
                            class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 border border-transparent focus:outline-none focus:ring-2 focus:ring-[#003527] @error('email') border-red-400 ring-1 ring-red-300 @enderror"
                        >
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-[#003527] mb-2">
                            Password
                        </label>

                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                placeholder="Masukkan password"
                                class="w-full rounded-xl bg-[#f6ece6] px-4 py-3.5 pr-12 border border-transparent focus:outline-none focus:ring-2 focus:ring-[#003527] @error('password') border-red-400 ring-1 ring-red-300 @enderror"
                            >

                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[#666] hover:text-[#003527] text-sm"
                            >
                                👁️
                            </button>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full organic-gradient text-white font-bold py-3.5 sm:py-4 rounded-xl sm:rounded-full shadow-lg hover:opacity-95 transition"
                    >
                        Login
                    </button>
                </form>

                <div class="mt-6 text-center text-sm text-[#404944]">
                    Belum punya akun?
                    <a href="{{ url('/register') }}" class="text-[#003527] font-bold hover:underline">
                        Register
                    </a>
                </div>
            </div>

            <div class="mt-6 text-center text-xs uppercase tracking-[0.2em] text-[#777] font-semibold">
                © 2024 EcoDon
            </div>
        </div>
    </section>
</main>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    }
</script>

</body>
</html>