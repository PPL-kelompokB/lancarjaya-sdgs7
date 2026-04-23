<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Organisasi — EcoDon</title>
    <meta name="description" content="Temukan dan ikuti organisasi sosial terpercaya di EcoDon.">

    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,line-clamp"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        tailwind.config = {
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
                }
            }
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Inter', sans-serif; }
        h1,h2,h3,h4,.font-headline { font-family: 'Manrope', sans-serif; }

        .follow-btn[data-following="true"] {
            background: #f6ece6;
            color: #003527;
            border: 2px solid #003527;
        }
        .follow-btn[data-following="false"] {
            background: #003527;
            color: white;
            border: 2px solid #003527;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .org-card { animation: fadeIn .3s ease both; }
    </style>
</head>
<body class="bg-background text-on-surface font-body min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 bg-[#fff8f5]/90 backdrop-blur-xl shadow-[0px_4px_20px_rgba(31,27,23,0.07)]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-4">
            <a href="{{ url('/') }}" class="text-xl font-headline font-extrabold text-primary tracking-tight">EcoDon</a>
            <div class="flex items-center gap-3">
                <a href="{{ route('user.feed') }}"
                   class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold text-on-surface-variant hover:bg-surface-container transition-all">
                    <span class="material-symbols-outlined text-[18px]">dynamic_feed</span>
                    Feed Saya
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="flex items-center gap-1 px-4 py-2 rounded-full text-sm font-semibold text-on-surface-variant hover:bg-surface-container transition-all">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-headline font-extrabold text-primary mb-2">Temukan Organisasi</h1>
            <p class="text-on-surface-variant">Cari dan ikuti organisasi sosial terpercaya yang sesuai dengan minat Anda</p>
        </div>

        {{-- Search bar --}}
        <form method="GET" action="{{ route('search.organizations') }}" class="mb-8">
            <div class="relative max-w-xl">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input
                    type="text"
                    name="keyword"
                    value="{{ $keyword ?? '' }}"
                    placeholder="Cari nama, tipe, atau deskripsi organisasi..."
                    class="w-full pl-12 pr-4 py-3.5 rounded-full border border-outline-variant bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary/30 text-sm"
                >
                <button type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 px-5 py-2 bg-primary text-white rounded-full text-sm font-bold hover:scale-105 transition-all">
                    Cari
                </button>
            </div>
        </form>

        @if(session('success'))
            <div class="flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 mb-6">
                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' 1;">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        {{-- Results --}}
        @if($organizations->total() > 0)
            <p class="text-sm text-on-surface-variant mb-5">
                Menampilkan <strong>{{ $organizations->total() }}</strong> organisasi
                @if($keyword) untuk "<strong>{{ $keyword }}</strong>" @endif
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($organizations as $org)
                    @php
                        $isFollowing = auth()->user()->isFollowing($org);
                    @endphp
                    <div class="org-card bg-white rounded-2xl border border-outline-variant/20 shadow-sm hover:shadow-md transition-all overflow-hidden flex flex-col">

                        {{-- Cover mini --}}
                        <div class="h-24 bg-gradient-to-r from-[#003527] to-[#064e3b] relative overflow-hidden">
                            @if(!empty($org->cover_image))
                                <img src="{{ asset('storage/' . $org->cover_image) }}"
                                     alt="" class="w-full h-full object-cover">
                            @endif
                            <div class="absolute inset-0 bg-black/10"></div>
                        </div>

                        <div class="p-5 flex flex-col flex-1">
                            {{-- Avatar --}}
                            <div class="flex items-start gap-3 -mt-10 mb-3">
                                <div class="w-16 h-16 rounded-2xl overflow-hidden border-4 border-white bg-surface-container flex-shrink-0 shadow">
                                    @if(!empty($org->profile_image))
                                        <img src="{{ asset('storage/' . $org->profile_image) }}"
                                             alt="{{ $org->organization_name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-surface-container-high">
                                            <span class="material-symbols-outlined text-primary text-2xl">business</span>
                                        </div>
                                    @endif
                                </div>
                                @if($org->verification_status === 'verified')
                                    <span class="mt-8 material-symbols-outlined text-secondary text-xl" style="font-variation-settings:'FILL' 1;">verified</span>
                                @endif
                            </div>

                            {{-- Info --}}
                            <h2 class="text-base font-headline font-bold text-primary leading-snug mb-1">
                                {{ $org->organization_name }}
                            </h2>
                            <p class="text-xs text-on-surface-variant mb-2">{{ $org->organization_type }}</p>

                            @if($org->description)
                                <p class="text-sm text-on-surface-variant line-clamp-2 mb-3">{{ $org->description }}</p>
                            @endif

                            {{-- Stats --}}
                            <div class="flex items-center gap-3 text-xs text-on-surface-variant mb-4 mt-auto">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]" style="font-variation-settings:'FILL' 1;">group</span>
                                    <span id="fc-{{ $org->id }}">{{ $org->followers_count }}</span> pengikut
                                </span>
                                <span class="w-1 h-1 bg-outline-variant rounded-full"></span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">article</span>
                                    {{ $org->blogs->count() }} blog
                                </span>
                            </div>

                            {{-- Actions --}}
                            <div class="flex gap-2">
                                <a href="{{ route('organization.public-profile', $org->id) }}"
                                   class="flex-1 text-center px-4 py-2 rounded-full text-sm font-semibold text-primary bg-surface-container hover:bg-surface-container-high transition-all">
                                    Lihat Profil
                                </a>
                                <button
                                    class="follow-btn flex-1 text-sm font-bold px-4 py-2 rounded-full transition-all"
                                    data-org-id="{{ $org->id }}"
                                    data-following="{{ $isFollowing ? 'true' : 'false' }}"
                                    onclick="toggleFollow(this)"
                                >
                                    {{ $isFollowing ? 'Mengikuti' : 'Ikuti' }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($organizations->hasPages())
                <div class="mt-8">
                    {{ $organizations->links() }}
                </div>
            @endif

        @else
            <div class="bg-white rounded-2xl border border-outline-variant/20 p-12 text-center">
                <span class="material-symbols-outlined text-5xl text-on-surface-variant block mb-3">search_off</span>
                <h3 class="text-xl font-headline font-bold text-primary mb-2">
                    {{ $keyword ? 'Organisasi Tidak Ditemukan' : 'Belum Ada Organisasi' }}
                </h3>
                <p class="text-on-surface-variant text-sm">
                    {{ $keyword ? 'Coba kata kunci yang berbeda.' : 'Belum ada organisasi yang terdaftar.' }}
                </p>
            </div>
        @endif
    </main>

    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;

        async function toggleFollow(btn) {
            const orgId = btn.dataset.orgId;
            btn.disabled = true;
            btn.style.opacity = '0.6';

            try {
                const resp = await fetch(`/organizations/${orgId}/follow`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
                });
                const data = await resp.json();

                document.querySelectorAll(`.follow-btn[data-org-id="${orgId}"]`).forEach(b => {
                    b.dataset.following = data.followed ? 'true' : 'false';
                    b.textContent       = data.followed ? 'Mengikuti' : 'Ikuti';
                });

                const counter = document.getElementById(`fc-${orgId}`);
                if (counter) counter.textContent = data.followers_count;

            } catch (e) { console.error(e); }
            finally { btn.disabled = false; btn.style.opacity = '1'; }
        }
    </script>
</body>
</html>
