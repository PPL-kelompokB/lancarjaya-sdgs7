<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Dashboard Pendonasi</title>

    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,line-clamp"></script>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#003527",
                        secondary: "#006c49",
                        background: "#fff8f5",
                        surface: "#fff8f5",
                        "surface-container": "#f6ece6",
                        "surface-container-low": "#fcf2eb",
                        "surface-container-high": "#f0e6e0",
                        "surface-container-highest": "#eae1da",
                        "outline-variant": "#bfc9c3",
                        "on-surface": "#1f1b17",
                        "on-surface-variant": "#404944",
                        "secondary-container": "#6cf8bb",
                        "on-secondary-container": "#00714d",
                    },
                    fontFamily: {
                        headline: ["Manrope", "sans-serif"],
                        body: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "1rem",
                        lg: "2rem",
                        xl: "3rem",
                        full: "9999px",
                    },
                    boxShadow: {
                        soft: "0 10px 30px rgba(31,27,23,0.06)",
                        lift: "0 18px 40px rgba(0,53,39,0.10)",
                    }
                }
            }
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, .font-headline {
            font-family: 'Manrope', sans-serif;
        }

        .tab-btn.active {
            color: #003527;
            position: relative;
        }

        .tab-btn.active::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -1px;
            width: 100%;
            height: 4px;
            border-radius: 999px;
            background: #006c49;
        }

        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .modal-open {
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface min-h-screen flex">

    @php
        $donations = $donations ?? collect();
    @endphp

    <!-- Sidebar -->
    <aside class="hidden md:flex flex-col h-screen w-64 bg-[#f6ece6] text-[#003527] py-8 space-y-2 sticky top-0 rounded-r-[2rem]">
        <div class="px-8 mb-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">volunteer_activism</span>
                </div>
                <div>
                    <h1 class="font-headline font-extrabold text-[#003527] text-lg leading-tight">EcoDon User</h1>
                    <p class="text-[10px] uppercase tracking-wider opacity-60">Pendonasi Panel</p>
                </div>
            </div>
        </div>

        <nav class="flex-grow space-y-2">
            <a class="bg-gradient-to-r from-[#003527] to-[#064e3b] text-white rounded-full px-4 py-3 mx-4 flex items-center gap-3" href="{{ route('user.dashboard') }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>

            <a class="text-stone-700 px-4 py-3 mx-4 flex items-center gap-3 hover:bg-emerald-100/50 rounded-full transition-all" href="#">
                <span class="material-symbols-outlined">card_giftcard</span>
                <span class="text-sm font-medium">Donasi Saya</span>
            </a>

            <a  href="{{ route('user.explore') }}"
                class="text-stone-700 px-4 py-3 mx-4 flex items-center gap-3 hover:bg-emerald-100/50 rounded-full transition-all" href="#">
                <span class="material-symbols-outlined">home</span>
                <span class="text-sm font-medium">Beranda Saya</span>
            </a>

             <a href="{{ route('user.blog.index') }}"
                class="text-stone-700 px-4 py-3 mx-4 flex items-center gap-3 hover:bg-emerald-100/50 rounded-full transition-all" href="#">
                <span class="material-symbols-outlined">person</span>
                <span class="text-sm font-medium">Blog Saya</span>
            </a>


        </nav>

        <div class="px-4 mt-auto space-y-2">
            <div class="pt-6 border-t border-outline-variant/20">
                <form action="{{ route('logout') }}" method="POST" class="px-4">
                    @csrf
                    <button type="submit" class="w-full text-stone-700 py-3 flex items-center gap-3 hover:bg-emerald-100/50 rounded-full transition-all">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="text-sm font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main -->
    <main class="flex-grow min-h-screen relative overflow-y-auto">

        <!-- Cover -->
        <div class="relative w-full">
            <div class="h-72 sm:h-80 w-full overflow-hidden bg-gradient-to-r from-[#003527] to-[#064e3b] relative">
                <div class="absolute inset-0 bg-black/10"></div>
            </div>

            <!-- Header -->
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative -mt-16 sm:-mt-20">
                <div class="bg-white/90 backdrop-blur-2xl rounded-2xl p-5 sm:p-8 shadow-[0px_20px_40px_rgba(31,27,23,0.06)]">
                    <div class="flex flex-col lg:flex-row lg:items-end gap-6 justify-between">
                        <div class="flex flex-col sm:flex-row gap-5 items-start sm:items-end">

                            <div class="relative w-28 h-28 sm:w-36 sm:h-36 rounded-2xl overflow-hidden border-4 sm:border-8 border-surface bg-white shadow-xl -mt-16 sm:-mt-24">
                                @if(!empty($user->profile_photo))
                                    <img
                                        class="w-full h-full object-cover"
                                        src="{{ asset('storage/' . $user->profile_photo) }}"
                                        alt="Foto profil user"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-[#f6ece6]">
                                        <span class="material-symbols-outlined text-[#003527] text-5xl">person</span>
                                    </div>
                                @endif

                                <button
                                    type="button"
                                    id="openAvatarModal"
                                    class="absolute bottom-2 right-2 w-10 h-10 rounded-full bg-[#003527] hover:bg-[#064e3b] text-white shadow-md flex items-center justify-center"
                                    title="Edit foto profil"
                                >
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                            </div>

                            <div class="pb-2">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h2 class="text-2xl sm:text-3xl font-headline font-extrabold tracking-tight text-primary">
                                        Halo, {{ $user->name }}
                                    </h2>
                                </div>

                                <div class="flex flex-wrap items-center gap-3 sm:gap-4 text-on-surface-variant mt-2">
                                    <span class="flex items-center gap-1 text-sm font-medium">
                                        <span class="material-symbols-outlined text-lg">mail</span>
                                        {{ $user->email }}
                                    </span>

                                    @if(!empty($user->phone))
                                        <span class="w-1 h-1 bg-outline-variant rounded-full hidden sm:inline-block"></span>
                                        <span class="flex items-center gap-1 text-sm font-medium">
                                            <span class="material-symbols-outlined text-lg">call</span>
                                            {{ $user->phone }}
                                        </span>
                                    @endif
                                </div>

                                <p class="mt-4 text-on-surface-variant max-w-2xl leading-relaxed text-sm sm:text-base">
                                    Selamat datang di dashboard pendonasi. Kamu bisa melihat informasi akun, mengelola profil, dan memantau aktivitas donasi kamu dari sini.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3 sm:gap-4 pb-2">
                            <button
                                type="button"
                                id="openProfileModal"
                                class="px-6 sm:px-8 py-3 bg-primary text-white rounded-full font-headline font-bold shadow-lg hover:scale-105 active:scale-95 transition-all"
                            >
                                Edit Profil
                            </button>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 pt-6 border-t border-outline-variant/20">
                        <div class="flex flex-col">
                            <span class="text-2xl font-headline font-black text-primary">
                                {{ $donations->count() }}
                            </span>
                            <span class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Total Donasi</span>
                        </div>

                        <div class="flex flex-col">
                            <span class="text-2xl font-headline font-black text-primary">
                                {{ $donations->where('status', 'open')->count() }}
                            </span>
                            <span class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Open</span>
                        </div>

                        <div class="flex flex-col">
                            <span class="text-2xl font-headline font-black text-primary">
                                {{ $donations->where('status', 'in_progress')->count() }}
                            </span>
                            <span class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Diproses</span>
                        </div>

                        <div class="flex flex-col">
                            <span class="text-2xl font-headline font-black text-secondary">
                                {{ $donations->where('status', 'completed')->count() }}
                            </span>
                            <span class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Selesai</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pb-20">

            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <p class="font-semibold mb-2">Ada error pada form:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Tabs -->
            <div class="flex gap-8 sm:gap-12 mb-8 border-b border-outline-variant/10 overflow-x-auto hide-scrollbar" id="profileTabs">
                <button type="button" class="tab-btn active pb-4 text-primary font-headline font-bold relative transition-colors" data-tab="ringkasan">
                    Ringkasan
                </button>
                <button type="button" class="tab-btn pb-4 text-on-surface-variant font-headline font-bold relative hover:text-primary transition-colors whitespace-nowrap" data-tab="riwayat-donasi">
                    Riwayat Donasi
                </button>
                <button type="button" class="tab-btn pb-4 text-on-surface-variant font-headline font-bold relative hover:text-primary transition-colors whitespace-nowrap" data-tab="profil-saya">
                    Profil Saya
                </button>
            </div>

            <div class="space-y-6">

                <!-- RINGKASAN -->
                <div id="panel-ringkasan" class="tab-panel active">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 space-y-6">
                            <section class="bg-surface-container rounded-2xl p-6">
                                <h3 class="text-xl font-headline font-bold text-primary mb-6">Ringkasan Aktivitas</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div class="bg-white rounded-2xl border border-outline-variant/20 p-5">
                                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center mb-4">
                                            <span class="material-symbols-outlined">inventory_2</span>
                                        </div>
                                        <h4 class="text-lg font-headline font-bold text-primary">Total Donasi</h4>
                                        <p class="text-3xl font-black text-primary mt-2">{{ $donations->count() }}</p>
                                        <p class="text-sm text-on-surface-variant mt-2">Jumlah aktivitas donasi yang tercatat di akun kamu.</p>
                                    </div>

                                    <div class="bg-white rounded-2xl border border-outline-variant/20 p-5">
                                        <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center mb-4">
                                            <span class="material-symbols-outlined">local_shipping</span>
                                        </div>
                                        <h4 class="text-lg font-headline font-bold text-primary">Donasi Diproses</h4>
                                        <p class="text-3xl font-black text-primary mt-2">{{ $donations->where('status', 'in_progress')->count() }}</p>
                                        <p class="text-sm text-on-surface-variant mt-2">Donasi yang saat ini sedang dalam proses penanganan.</p>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="space-y-6">
                            <section class="bg-surface-container rounded-2xl p-6">
                                <h3 class="text-xl font-headline font-bold text-primary mb-4">Informasi Akun</h3>

                                <div class="space-y-3">
                                    <div class="bg-white rounded-xl px-4 py-3">
                                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Nama</p>
                                        <p class="font-semibold">{{ $user->name ?: '-' }}</p>
                                    </div>

                                    <div class="bg-white rounded-xl px-4 py-3">
                                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Email</p>
                                        <p class="font-semibold break-all">{{ $user->email ?: '-' }}</p>
                                    </div>

                                    <div class="bg-white rounded-xl px-4 py-3">
                                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Telepon</p>
                                        <p class="font-semibold">{{ $user->phone ?: '-' }}</p>
                                    </div>

                                    <div class="bg-white rounded-xl px-4 py-3">
                                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Alamat</p>
                                        <p class="font-semibold">{{ $user->address ?: '-' }}</p>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <!-- RIWAYAT DONASI -->
                <div id="panel-riwayat-donasi" class="tab-panel">
                    <section class="bg-surface-container rounded-2xl p-6">
                        <div class="flex items-center justify-between gap-4 mb-6">
                            <h3 class="text-xl font-headline font-bold text-primary">Riwayat Donasi</h3>
                        </div>

                        @if($donations->isEmpty())
                            <div class="bg-white rounded-2xl p-6 border border-outline-variant/20 text-on-surface-variant">
                                Belum ada riwayat donasi yang tampil. Kalau tabel donasi kamu belum terhubung ke user, nanti perlu ditambahkan relasi `user_id`.
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                @foreach($donations as $donation)
                                    <div class="bg-white rounded-2xl overflow-hidden border border-outline-variant/20">
                                        <div class="p-5">
                                            <div class="flex flex-wrap gap-2 mb-3">
                                                @if($donation->status === 'open')
                                                    <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-blue-100 text-blue-700">Open</span>
                                                @elseif($donation->status === 'in_progress')
                                                    <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">In Progress</span>
                                                @elseif($donation->status === 'completed')
                                                    <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-green-100 text-green-700">Completed</span>
                                                @else
                                                    <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-red-100 text-red-700">Cancelled</span>
                                                @endif

                                                @if($donation->logistic_status === 'waiting_pickup')
                                                    <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-gray-100 text-gray-700">Waiting Pickup</span>
                                                @elseif($donation->logistic_status === 'picked_up')
                                                    <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-indigo-100 text-indigo-700">Picked Up</span>
                                                @elseif($donation->logistic_status === 'in_transit')
                                                    <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-orange-100 text-orange-700">In Transit</span>
                                                @elseif($donation->logistic_status === 'arrived')
                                                    <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-cyan-100 text-cyan-700">Arrived</span>
                                                @elseif($donation->logistic_status === 'processed')
                                                    <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-purple-100 text-purple-700">Processed</span>
                                                @elseif($donation->logistic_status === 'distributed')
                                                    <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-emerald-100 text-emerald-700">Distributed</span>
                                                @endif
                                            </div>

                                            <h4 class="text-lg font-headline font-bold text-primary mb-2">
                                                {{ $donation->title }}
                                            </h4>

                                            <p class="text-on-surface-variant text-sm mb-4">
                                                {{ $donation->description ?: 'Belum ada deskripsi donasi.' }}
                                            </p>

                                            <div class="space-y-2 text-sm text-on-surface-variant">
                                                <p><span class="font-semibold text-on-surface">Barang:</span> {{ $donation->item_name ?: '-' }}</p>
                                                <p><span class="font-semibold text-on-surface">Jumlah:</span> {{ $donation->quantity ?: '-' }} {{ $donation->unit ?: '' }}</p>
                                                <p><span class="font-semibold text-on-surface">Organisasi:</span> {{ optional($donation->organization)->organization_name ?: '-' }}</p>
                                                <p><span class="font-semibold text-on-surface">Periode:</span> {{ $donation->start_date ?: '-' }} s/d {{ $donation->end_date ?: '-' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </section>
                </div>

                <!-- PROFIL SAYA -->
                <div id="panel-profil-saya" class="tab-panel">
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                        <section class="bg-surface-container rounded-2xl p-6">
                            <h3 class="text-xl font-headline font-bold text-primary mb-4">Data Pengguna</h3>

                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Nama Lengkap</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $user->name ?: '-' }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Email</p>
                                    <div class="bg-white rounded-xl px-4 py-3 break-all">{{ $user->email ?: '-' }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Nomor Telepon</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $user->phone ?: '-' }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Alamat</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $user->address ?: '-' }}</div>
                                </div>
                            </div>
                        </section>

                        <section class="bg-surface-container rounded-2xl p-6">
                            <h3 class="text-xl font-headline font-bold text-primary mb-4">Statistik Akun</h3>

                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Total Aktivitas Donasi</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $donations->count() }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Donasi Open</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $donations->where('status', 'open')->count() }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Donasi Diproses</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $donations->where('status', 'in_progress')->count() }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Donasi Selesai</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $donations->where('status', 'completed')->count() }}</div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Mobile FAB -->
    <button
        type="button"
        id="openProfileModalMobile"
        class="md:hidden fixed bottom-6 right-6 w-14 h-14 bg-primary text-white rounded-full shadow-2xl flex items-center justify-center z-50"
    >
        <span class="material-symbols-outlined">edit</span>
    </button>

    <!-- Modal Edit Profil -->
    <div id="profileModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-xl relative max-h-[90vh] overflow-y-auto">
            <button type="button" data-close-modal="profileModal" class="absolute top-4 right-4 text-on-surface-variant hover:text-primary">
                <span class="material-symbols-outlined">close</span>
            </button>

            <h2 class="text-xl font-headline font-bold mb-5 text-primary">Edit Profil</h2>

            <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-sm font-semibold">Nama</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2"
                    >
                </div>

                <div>
                    <label class="text-sm font-semibold">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2"
                    >
                </div>

                <div>
                    <label class="text-sm font-semibold">No. Telepon</label>
                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $user->phone) }}"
                        class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2"
                    >
                </div>

                <div>
                    <label class="text-sm font-semibold">Alamat</label>
                    <textarea
                        name="address"
                        rows="3"
                        class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2"
                    >{{ old('address', $user->address) }}</textarea>
                </div>

                <div class="pt-4">
                    <button
                        type="submit"
                        class="w-full bg-primary text-white py-3 rounded-full font-bold hover:bg-[#064e3b] transition-colors"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Foto -->
    <div id="avatarModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-xl relative max-h-[90vh] overflow-y-auto">
            <button type="button" data-close-modal="avatarModal" class="absolute top-4 right-4 text-on-surface-variant hover:text-primary">
                <span class="material-symbols-outlined">close</span>
            </button>

            <h2 class="text-xl font-headline font-bold mb-2 text-primary">Edit Foto Profil</h2>
            <p class="text-sm text-on-surface-variant mb-5">Upload foto profil persegi. Rekomendasi ukuran 800 x 800 px.</p>

            <form action="{{ route('user.photo.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="rounded-2xl border border-dashed border-outline-variant p-4 bg-surface-container-low">
                    <label class="block text-sm font-semibold mb-2">Pilih foto profil</label>
                    <input
                        type="file"
                        name="profile_photo"
                        id="profileImageInput"
                        accept="image/*"
                        class="block w-full text-sm"
                    >
                    <p id="profileFileName" class="mt-2 text-xs text-on-surface-variant">Belum ada file dipilih.</p>
                </div>

                <div class="rounded-xl bg-surface-container px-4 py-3">
                    <p class="text-sm font-semibold text-primary">Tips</p>
                    <p class="text-sm text-on-surface-variant mt-1">
                        Pakai gambar rasio 1:1 supaya hasilnya pas di frame profil.
                    </p>
                </div>

                <button
                    type="submit"
                    class="w-full bg-primary text-white py-3 rounded-full font-bold hover:bg-[#064e3b] transition-colors"
                >
                    Simpan Foto Profil
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabPanels = document.querySelectorAll('.tab-panel');

            tabButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const target = button.dataset.tab;

                    tabButtons.forEach((btn) => {
                        btn.classList.remove('active', 'text-primary');
                        btn.classList.add('text-on-surface-variant');
                    });

                    tabPanels.forEach((panel) => {
                        panel.classList.remove('active');
                    });

                    button.classList.add('active', 'text-primary');
                    button.classList.remove('text-on-surface-variant');

                    const targetPanel = document.getElementById(`panel-${target}`);
                    if (targetPanel) {
                        targetPanel.classList.add('active');
                    }
                });
            });

            const modalMap = {
                openProfileModal: 'profileModal',
                openProfileModalMobile: 'profileModal',
                openAvatarModal: 'avatarModal',
            };

            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                if (!modal) return;

                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('modal-open');
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (!modal) return;

                modal.classList.add('hidden');
                modal.classList.remove('flex');

                const visibleModal = document.querySelector('.fixed.inset-0.z-50.flex:not(.hidden)');
                if (!visibleModal) {
                    document.body.classList.remove('modal-open');
                }
            }

            Object.keys(modalMap).forEach((triggerId) => {
                const trigger = document.getElementById(triggerId);
                if (trigger) {
                    trigger.addEventListener('click', () => openModal(modalMap[triggerId]));
                }
            });

            document.querySelectorAll('[data-close-modal]').forEach((button) => {
                button.addEventListener('click', () => {
                    closeModal(button.getAttribute('data-close-modal'));
                });
            });

            ['profileModal', 'avatarModal'].forEach((modalId) => {
                const modal = document.getElementById(modalId);
                if (!modal) return;

                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closeModal(modalId);
                    }
                });
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    ['profileModal', 'avatarModal'].forEach((modalId) => {
                        const modal = document.getElementById(modalId);
                        if (modal && !modal.classList.contains('hidden')) {
                            closeModal(modalId);
                        }
                    });
                }
            });

            const profileInput = document.getElementById('profileImageInput');
            const profileFileName = document.getElementById('profileFileName');

            if (profileInput && profileFileName) {
                profileInput.addEventListener('change', function () {
                    profileFileName.textContent = this.files && this.files[0]
                        ? this.files[0].name
                        : 'Belum ada file dipilih.';
                });
            }

            @if ($errors->any())
                openModal('profileModal');
            @endif
        });
    </script>
</body>
</html>