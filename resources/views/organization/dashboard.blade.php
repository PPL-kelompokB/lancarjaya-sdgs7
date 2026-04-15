<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $organization->organization_name }} - EcoDon Dashboard</title>

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

    <!-- Sidebar -->
    <aside class="hidden md:flex flex-col h-screen w-64 bg-[#f6ece6] text-[#003527] py-8 space-y-2 sticky top-0 rounded-r-[2rem]">
        <div class="px-8 mb-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">eco</span>
                </div>
                <div>
                    <h1 class="font-headline font-extrabold text-[#003527] text-lg leading-tight">EcoDon Org</h1>
                    <p class="text-[10px] uppercase tracking-wider opacity-60">Organization Panel</p>
                </div>
            </div>
        </div>

        <nav class="flex-grow space-y-2">
            <a class="bg-gradient-to-r from-[#003527] to-[#064e3b] text-white rounded-full px-4 py-3 mx-4 flex items-center gap-3" href="{{ url('/organization/dashboard') }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>

            <a class="text-stone-700 px-4 py-3 mx-4 flex items-center gap-3 hover:bg-emerald-100/50 rounded-full transition-all" href="#">
                <span class="material-symbols-outlined">article</span>
                <span class="text-sm font-medium">Blog</span>
            </a>

            <a class="text-stone-700 px-4 py-3 mx-4 flex items-center gap-3 hover:bg-emerald-100/50 rounded-full transition-all" href="#">
                <span class="material-symbols-outlined">card_giftcard</span>
                <span class="text-sm font-medium">Donation Programs</span>
            </a>

            <a class="text-stone-700 px-4 py-3 mx-4 flex items-center gap-3 hover:bg-emerald-100/50 rounded-full transition-all" href="#">
                <span class="material-symbols-outlined">group</span>
                <span class="text-sm font-medium">Volunteer Activity</span>
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
                @if(!empty($organization->cover_image))
                    <img
                        class="w-full h-full object-cover"
                        src="{{ asset('storage/' . $organization->cover_image) }}"
                        alt="Cover organisasi"
                    >
                @endif

                <div class="absolute inset-0 bg-black/10"></div>

                <button
                    type="button"
                    class="absolute top-4 right-4 w-11 h-11 rounded-full bg-white/90 hover:bg-white text-[#003527] shadow-lg flex items-center justify-center"
                    title="Edit cover"
                    id="openCoverModal"
                >
                    <span class="material-symbols-outlined">edit</span>
                </button>
            </div>

            <!-- Profile header -->
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative -mt-16 sm:-mt-20">
                <div class="bg-white/90 backdrop-blur-2xl rounded-2xl p-5 sm:p-8 shadow-[0px_20px_40px_rgba(31,27,23,0.06)]">
                    <div class="flex flex-col lg:flex-row lg:items-end gap-6 justify-between">
                        <div class="flex flex-col sm:flex-row gap-5 items-start sm:items-end">

                            <!-- Foto profil/logo -->
                            <div class="relative w-28 h-28 sm:w-36 sm:h-36 rounded-2xl overflow-hidden border-4 sm:border-8 border-surface bg-white shadow-xl -mt-16 sm:-mt-24">
                                @if(!empty($organization->profile_image))
                                    <img
                                        class="w-full h-full object-cover"
                                        src="{{ asset('storage/' . $organization->profile_image) }}"
                                        alt="Logo organisasi"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-[#f6ece6]">
                                        <span class="material-symbols-outlined text-[#003527] text-5xl">business</span>
                                    </div>
                                @endif

                                <button
                                    type="button"
                                    id="openAvatarModal"
                                    class="absolute bottom-2 right-2 w-10 h-10 rounded-full bg-[#003527] hover:bg-[#064e3b] text-white shadow-md flex items-center justify-center"
                                    title="Edit profil"
                                >
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                            </div>

                            <div class="pb-2">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h2 class="text-2xl sm:text-3xl font-headline font-extrabold tracking-tight text-primary">
                                        {{ $organization->organization_name }}
                                    </h2>

                                    @if ($organization->verification_status === 'verified')
                                        <span class="material-symbols-outlined text-secondary text-2xl" style="font-variation-settings: 'FILL' 1;">verified</span>
                                    @endif
                                </div>

                                <div class="flex flex-wrap items-center gap-3 sm:gap-4 text-on-surface-variant mt-2">
                                    <span class="flex items-center gap-1 text-sm font-medium">
                                        <span class="material-symbols-outlined text-lg">category</span>
                                        {{ $organization->organization_type }}
                                    </span>

                                    @if ($organization->founded_year)
                                        <span class="w-1 h-1 bg-outline-variant rounded-full hidden sm:inline-block"></span>
                                        <span class="text-sm font-medium">Berdiri {{ $organization->founded_year }}</span>
                                    @endif
                                </div>

                                <p class="mt-4 text-on-surface-variant max-w-2xl leading-relaxed text-sm sm:text-base">
                                    {{ $organization->description ?: 'Belum ada deskripsi organisasi.' }}
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
                                {{ $organization->verification_status === 'verified' ? 'Aktif' : 'Review' }}
                            </span>
                            <span class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Status Akun</span>
                        </div>

                        <div class="flex flex-col">
                            <span class="text-2xl font-headline font-black text-primary">
                                {{ $organization->blogs->count() ?? 0 }}
                            </span>
                            <span class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Total Blog</span>
                        </div>

                        <div class="flex flex-col">
                            <span class="text-2xl font-headline font-black text-primary">
                                {{ $organization->donations->count() ?? 0 }}
                            </span>
                            <span class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Program Donasi</span>
                        </div>

                        <div class="flex flex-col">
                            <span class="text-2xl font-headline font-black text-secondary">
                                {{ $organization->pic_name }}
                            </span>
                            <span class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">PIC</span>
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
                <button type="button" class="tab-btn pb-4 text-on-surface-variant font-headline font-bold relative hover:text-primary transition-colors" data-tab="blog">
                    Blog
                </button>
                <button type="button" class="tab-btn active pb-4 text-primary font-headline font-bold relative transition-colors" data-tab="donation-programs">
                    Donation Programs
                </button>
                <button type="button" class="tab-btn pb-4 text-on-surface-variant font-headline font-bold relative hover:text-primary transition-colors whitespace-nowrap" data-tab="volunteer-activity">
                    Volunteer Activity
                </button>
                <button type="button" class="tab-btn pb-4 text-on-surface-variant font-headline font-bold relative hover:text-primary transition-colors whitespace-nowrap" data-tab="data-organisasi">
                    Data Organisasi
                </button>
            </div>

            <!-- Panels -->
            <div class="space-y-6">

                <!-- BLOG -->
                <div id="panel-blog" class="tab-panel">
                    <section class="bg-surface-container rounded-2xl p-6">
                        <div class="flex items-center justify-between gap-4 mb-6">
                            <h3 class="text-xl font-headline font-bold text-primary">Blog</h3>
                            <a href="#" class="text-sm font-bold text-secondary hover:underline">Lihat Semua</a>
                        </div>

                        @if(($organization->blogs->count() ?? 0) > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                @foreach($organization->blogs as $blog)
                                    <article class="bg-white rounded-2xl border border-outline-variant/20 p-5">
                                        <h4 class="text-lg font-headline font-bold text-primary line-clamp-2">
                                            {{ $blog->title ?? 'Judul Blog' }}
                                        </h4>

                                        <p class="mt-3 text-sm text-on-surface-variant line-clamp-4">
                                            {{ $blog->content ?? $blog->excerpt ?? 'Belum ada ringkasan blog.' }}
                                        </p>

                                        @if(!empty($blog->created_at))
                                            <p class="mt-4 text-xs uppercase tracking-widest text-on-surface-variant font-semibold">
                                                {{ \Carbon\Carbon::parse($blog->created_at)->translatedFormat('d M Y') }}
                                            </p>
                                        @endif
                                    </article>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-white rounded-2xl p-6 border border-outline-variant/20 text-on-surface-variant">
                                Belum ada blog yang dibuat.
                            </div>
                        @endif
                    </section>
                </div>

                <!-- DONATION PROGRAMS -->
                <div id="panel-donation-programs" class="tab-panel active">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 space-y-6">
                            <section class="bg-surface-container rounded-2xl p-6">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl font-headline font-bold text-primary">Program Donasi</h3>
                                    <a href="#" class="text-sm font-bold text-secondary hover:underline">Lihat Semua</a>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    @forelse($organization->donations as $donation)
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
                                                    {{ $donation->description ?: 'Belum ada deskripsi program donasi.' }}
                                                </p>

                                                <div class="space-y-2 text-sm text-on-surface-variant">
                                                    <p><span class="font-semibold text-on-surface">Barang:</span> {{ $donation->item_name }}</p>
                                                    <p><span class="font-semibold text-on-surface">Jumlah:</span> {{ $donation->quantity ?? '-' }} {{ $donation->unit ?? '' }}</p>
                                                    <p><span class="font-semibold text-on-surface">Lokasi:</span> {{ $donation->address }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="md:col-span-2 bg-white rounded-2xl p-6 border border-outline-variant/20 text-on-surface-variant">
                                            Belum ada program donasi yang dibuat.
                                        </div>
                                    @endforelse
                                </div>
                            </section>
                        </div>

                        <div class="space-y-6">
                            <section class="bg-surface-container rounded-2xl p-6">
                                <h3 class="text-xl font-headline font-bold text-primary mb-4">Ringkasan Organisasi</h3>

                                <div class="space-y-3">
                                    <div class="bg-white rounded-xl px-4 py-3">
                                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Nama Organisasi</p>
                                        <p class="font-semibold">{{ $organization->organization_name ?: '-' }}</p>
                                    </div>

                                    <div class="bg-white rounded-xl px-4 py-3">
                                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Tipe Organisasi</p>
                                        <p class="font-semibold">{{ $organization->organization_type ?: '-' }}</p>
                                    </div>

                                    <div class="bg-white rounded-xl px-4 py-3">
                                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">PIC</p>
                                        <p class="font-semibold">{{ $organization->pic_name ?: '-' }}</p>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <!-- VOLUNTEER -->
                <div id="panel-volunteer-activity" class="tab-panel">
                    <section class="bg-surface-container rounded-2xl p-6">
                        <div class="flex items-center justify-between gap-4 mb-6">
                            <h3 class="text-xl font-headline font-bold text-primary">Volunteer Activity</h3>
                        </div>

                        <div class="bg-white rounded-2xl p-6 border border-outline-variant/20 text-on-surface-variant">
                            Belum ada data aktivitas volunteer untuk ditampilkan.
                        </div>
                    </section>
                </div>

                <!-- DATA ORGANISASI -->
                <div id="panel-data-organisasi" class="tab-panel">
                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                        <section class="bg-surface-container rounded-2xl p-6">
                            <h3 class="text-xl font-headline font-bold text-primary mb-4">Data Organisasi</h3>

                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Nama Organisasi</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $organization->organization_name }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Tipe Organisasi</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $organization->organization_type }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Tahun Berdiri</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $organization->founded_year ?: '-' }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">No. Telepon Organisasi</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $organization->org_phone }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Alamat</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $organization->address }}</div>
                                </div>
                            </div>
                        </section>

                        <section class="bg-surface-container rounded-2xl p-6">
                            <h3 class="text-xl font-headline font-bold text-primary mb-4">Data PIC</h3>

                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Nama PIC</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $organization->pic_name }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Email PIC</p>
                                    <div class="bg-white rounded-xl px-4 py-3 break-all">{{ $organization->pic_email }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">No. Telepon PIC</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $organization->pic_phone }}</div>
                                </div>
                            </div>
                        </section>

                        <section class="bg-surface-container rounded-2xl p-6">
                            <h3 class="text-xl font-headline font-bold text-primary mb-4">Data Rekening</h3>

                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Nama Bank</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $organization->bank_name ?: '-' }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Atas Nama</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $organization->account_holder_name ?: '-' }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Nomor Rekening</p>
                                    <div class="bg-white rounded-xl px-4 py-3">{{ $organization->rekening_number ?: '-' }}</div>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Bukti Rekening</p>
                                    <div class="bg-white rounded-xl px-4 py-3">
                                        @if (!empty($organization->bank_proof))
                                            <a href="{{ asset('storage/' . $organization->bank_proof) }}" target="_blank" class="text-secondary font-semibold hover:underline">
                                                Lihat Bukti Rekening
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </div>
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

            <form action="{{ route('organization.profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-sm font-semibold">Nama Organisasi</label>
                    <input
                        type="text"
                        name="organization_name"
                        value="{{ old('organization_name', $organization->organization_name) }}"
                        class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2"
                    >
                </div>

                <div>
                    <label class="text-sm font-semibold">Tipe Organisasi</label>
                    <input
                        type="text"
                        name="organization_type"
                        value="{{ old('organization_type', $organization->organization_type) }}"
                        class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2"
                    >
                </div>

                <div>
                    <label class="text-sm font-semibold">Tahun Berdiri</label>
                    <input
                        type="number"
                        name="founded_year"
                        value="{{ old('founded_year', $organization->founded_year) }}"
                        class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2"
                    >
                </div>

                <div>
                    <label class="text-sm font-semibold">Deskripsi</label>
                    <textarea
                        name="description"
                        rows="4"
                        class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2"
                    >{{ old('description', $organization->description) }}</textarea>
                </div>

                <div>
                    <label class="text-sm font-semibold">No. Telepon Organisasi</label>
                    <input
                        type="text"
                        name="org_phone"
                        value="{{ old('org_phone', $organization->org_phone) }}"
                        class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2"
                    >
                </div>

                <div>
                    <label class="text-sm font-semibold">Alamat</label>
                    <textarea
                        name="address"
                        rows="3"
                        class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2"
                    >{{ old('address', $organization->address) }}</textarea>
                </div>

                <div class="pt-2 border-t border-outline-variant/20">
                    <h3 class="text-base font-headline font-bold text-primary mb-3">Data PIC</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-semibold">Nama PIC</label>
                            <input
                                type="text"
                                name="pic_name"
                                value="{{ old('pic_name', $organization->pic_name) }}"
                                class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2"
                            >
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Email PIC</label>
                            <input
                                type="email"
                                name="pic_email"
                                value="{{ old('pic_email', $organization->pic_email) }}"
                                class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2"
                            >
                        </div>

                        <div>
                            <label class="text-sm font-semibold">No. Telepon PIC</label>
                            <input
                                type="text"
                                name="pic_phone"
                                value="{{ old('pic_phone', $organization->pic_phone) }}"
                                class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2"
                            >
                        </div>
                    </div>
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

    <!-- Modal Edit Cover -->
    <div id="coverModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-xl relative max-h-[90vh] overflow-y-auto">
            <button type="button" data-close-modal="coverModal" class="absolute top-4 right-4 text-on-surface-variant hover:text-primary">
                <span class="material-symbols-outlined">close</span>
            </button>

            <h2 class="text-xl font-headline font-bold mb-2 text-primary">Edit Cover</h2>
            <p class="text-sm text-on-surface-variant mb-5">Upload cover landscape. Rekomendasi ukuran 1600 x 600 px.</p>

            <form action="{{ route('organization.cover-image.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="rounded-2xl border border-dashed border-outline-variant p-4 bg-surface-container-low">
                    <label class="block text-sm font-semibold mb-2">Pilih gambar cover</label>
                    <input
                        type="file"
                        name="cover_image"
                        id="coverImageInput"
                        accept="image/*"
                        class="block w-full text-sm"
                    >
                    <p id="coverFileName" class="mt-2 text-xs text-on-surface-variant">Belum ada file dipilih.</p>
                </div>

                <div class="rounded-xl bg-surface-container px-4 py-3">
                    <p class="text-sm font-semibold text-primary">Tips</p>
                    <p class="text-sm text-on-surface-variant mt-1">
                        Pakai gambar horizontal, minimum 1200 x 450 px, biar tidak pecah dan tidak kepotong aneh.
                    </p>
                </div>

                <button
                    type="submit"
                    class="w-full bg-primary text-white py-3 rounded-full font-bold hover:bg-[#064e3b] transition-colors"
                >
                    Simpan Cover
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Edit Avatar -->
    <div id="avatarModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-xl relative max-h-[90vh] overflow-y-auto">
            <button type="button" data-close-modal="avatarModal" class="absolute top-4 right-4 text-on-surface-variant hover:text-primary">
                <span class="material-symbols-outlined">close</span>
            </button>

            <h2 class="text-xl font-headline font-bold mb-2 text-primary">Edit Foto Profil</h2>
            <p class="text-sm text-on-surface-variant mb-5">Upload logo atau foto profil persegi. Rekomendasi ukuran 800 x 800 px.</p>

            <form action="{{ route('organization.profile-image.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="rounded-2xl border border-dashed border-outline-variant p-4 bg-surface-container-low">
                    <label class="block text-sm font-semibold mb-2">Pilih foto profil / logo</label>
                    <input
                        type="file"
                        name="profile_image"
                        id="profileImageInput"
                        accept="image/*"
                        class="block w-full text-sm"
                    >
                    <p id="profileFileName" class="mt-2 text-xs text-on-surface-variant">Belum ada file dipilih.</p>
                </div>

                <div class="rounded-xl bg-surface-container px-4 py-3">
                    <p class="text-sm font-semibold text-primary">Tips</p>
                    <p class="text-sm text-on-surface-variant mt-1">
                        Pakai gambar rasio 1:1 biar hasilnya pas di frame profil.
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
                openCoverModal: 'coverModal',
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

            ['profileModal', 'coverModal', 'avatarModal'].forEach((modalId) => {
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
                    ['profileModal', 'coverModal', 'avatarModal'].forEach((modalId) => {
                        const modal = document.getElementById(modalId);
                        if (modal && !modal.classList.contains('hidden')) {
                            closeModal(modalId);
                        }
                    });
                }
            });

            const coverInput = document.getElementById('coverImageInput');
            const coverFileName = document.getElementById('coverFileName');

            if (coverInput && coverFileName) {
                coverInput.addEventListener('change', function () {
                    coverFileName.textContent = this.files && this.files[0]
                        ? this.files[0].name
                        : 'Belum ada file dipilih.';
                });
            }

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