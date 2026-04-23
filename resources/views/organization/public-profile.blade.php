<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $organization->organization_name }} — EcoDon</title>
    <meta name="description" content="{{ Str::limit($organization->description, 160) }}">

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

        #followBtn[data-following="true"] {
            background: #f6ece6;
            color: #003527;
            border: 2px solid #003527;
        }
        #followBtn[data-following="false"] {
            background: linear-gradient(135deg, #003527, #064e3b);
            color: white;
            border: 2px solid transparent;
            box-shadow: 0 8px 20px rgba(0,53,39,.25);
        }
        #followBtn:hover { transform: scale(1.04); }
        #followBtn:active { transform: scale(0.97); }
        #followBtn { transition: all .2s ease; }

        @keyframes pulse-ring {
            0%   { transform: scale(1); opacity: .6; }
            100% { transform: scale(1.5); opacity: 0; }
        }
        .pulse-ring::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 9999px;
            border: 2px solid #006c49;
            animation: pulse-ring 1.5s ease-out infinite;
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body min-h-screen">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 bg-[#fff8f5]/90 backdrop-blur-xl shadow-[0px_4px_20px_rgba(31,27,23,0.07)]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-4">
            <a href="{{ url('/') }}" class="text-xl font-headline font-extrabold text-primary tracking-tight">EcoDon</a>

            <div class="flex items-center gap-3">
                <a href="{{ route('search.organizations') }}"
                   class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold text-on-surface-variant hover:bg-surface-container transition-all">
                    <span class="material-symbols-outlined text-[18px]">search</span>
                    Cari Organisasi
                </a>
                @auth
                    <a href="{{ route('user.feed') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold text-on-surface-variant hover:bg-surface-container transition-all">
                        <span class="material-symbols-outlined text-[18px]">dynamic_feed</span>
                        Feed
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="flex items-center gap-1 px-4 py-2 rounded-full text-sm font-semibold text-on-surface-variant hover:bg-surface-container transition-all">
                            <span class="material-symbols-outlined text-[18px]">logout</span>
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="px-5 py-2 rounded-full text-sm font-bold bg-primary text-white shadow hover:scale-105 transition-all">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- COVER --}}
    <div class="relative h-56 sm:h-72 w-full bg-gradient-to-r from-[#003527] to-[#064e3b] overflow-hidden">
        @if(!empty($organization->cover_image))
            <img src="{{ asset('storage/' . $organization->cover_image) }}"
                 alt="Cover {{ $organization->organization_name }}"
                 class="w-full h-full object-cover">
        @endif
        <div class="absolute inset-0 bg-black/20"></div>
    </div>

    {{-- PROFILE HEADER --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 sm:-mt-20 relative z-10">
        <div class="bg-white/95 backdrop-blur-2xl rounded-2xl p-5 sm:p-8 shadow-[0px_20px_40px_rgba(31,27,23,0.08)]">
            <div class="flex flex-col sm:flex-row gap-5 items-start sm:items-end justify-between">

                <div class="flex flex-col sm:flex-row gap-5 items-start sm:items-end">
                    {{-- Avatar --}}
                    <div class="relative w-24 h-24 sm:w-32 sm:h-32 rounded-2xl overflow-hidden border-4 border-white bg-surface-container shadow-xl -mt-14 sm:-mt-20 flex-shrink-0">
                        @if(!empty($organization->profile_image))
                            <img src="{{ asset('storage/' . $organization->profile_image) }}"
                                 alt="{{ $organization->organization_name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-surface-container-high">
                                <span class="material-symbols-outlined text-primary text-5xl">business</span>
                            </div>
                        @endif
                    </div>

                    {{-- Name & meta --}}
                    <div class="pb-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h1 class="text-2xl sm:text-3xl font-headline font-extrabold tracking-tight text-primary">
                                {{ $organization->organization_name }}
                            </h1>
                            @if($organization->verification_status === 'verified')
                                <span class="material-symbols-outlined text-secondary text-2xl" style="font-variation-settings:'FILL' 1;">verified</span>
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center gap-3 mt-1.5 text-on-surface-variant text-sm">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">category</span>
                                {{ $organization->organization_type }}
                            </span>
                            @if($organization->founded_year)
                                <span class="w-1 h-1 bg-outline-variant rounded-full"></span>
                                <span>Berdiri {{ $organization->founded_year }}</span>
                            @endif
                        </div>

                        {{-- Followers count --}}
                        <div class="mt-2 flex items-center gap-1.5 text-sm font-semibold text-secondary" id="followersLabel">
                            <span class="material-symbols-outlined text-[16px]" style="font-variation-settings:'FILL' 1;">group</span>
                            <span id="followersCount">{{ $followersCount }}</span> pengikut
                        </div>
                    </div>
                </div>

                {{-- Follow Button --}}
                @auth
                    <div class="relative pb-1">
                        <button
                            id="followBtn"
                            data-org-id="{{ $organization->id }}"
                            data-following="{{ $isFollowing ? 'true' : 'false' }}"
                            onclick="toggleFollow()"
                            class="relative px-8 py-3 rounded-full font-headline font-bold text-base flex items-center gap-2"
                        >
                            <span class="material-symbols-outlined text-[20px]" id="followIcon"
                                  style="font-variation-settings:'FILL' {{ $isFollowing ? '1' : '0' }};">
                                {{ $isFollowing ? 'favorite' : 'favorite_border' }}
                            </span>
                            <span id="followLabel">{{ $isFollowing ? 'Mengikuti' : 'Ikuti Organisasi' }}</span>
                        </button>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="px-8 py-3 rounded-full font-headline font-bold text-base bg-primary text-white shadow-lg hover:scale-105 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">favorite_border</span>
                        Ikuti Organisasi
                    </a>
                @endauth
            </div>

            {{-- Description --}}
            @if($organization->description)
                <p class="mt-5 text-on-surface-variant text-sm sm:text-base leading-relaxed max-w-3xl border-t border-outline-variant/10 pt-5">
                    {{ $organization->description }}
                </p>
            @endif

            {{-- Stats --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6 pt-5 border-t border-outline-variant/10">
                <div>
                    <p class="text-xl font-headline font-black text-primary">{{ $followersCount }}</p>
                    <p class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Pengikut</p>
                </div>
                <div>
                    <p class="text-xl font-headline font-black text-primary">{{ $organization->blogs->count() }}</p>
                    <p class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Blog</p>
                </div>
                <div>
                    <p class="text-xl font-headline font-black text-primary">{{ $organization->donations->count() }}</p>
                    <p class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Program Donasi</p>
                </div>
                <div>
                    <p class="text-xl font-headline font-black text-secondary">
                        {{ $organization->verification_status === 'verified' ? 'Aktif' : 'Review' }}
                    </p>
                    <p class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Status</p>
                </div>
            </div>
        </div>
    </div>

    {{-- BLOG POSTS --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pb-20">
        <h2 class="text-xl font-headline font-bold text-primary mb-5">Blog & Aktivitas</h2>

        @forelse($organization->blogs as $blog)
            <article class="bg-white rounded-2xl border border-outline-variant/20 shadow-sm p-6 mb-4 hover:shadow-md transition-all">
                <h3 class="text-lg font-headline font-bold text-primary mb-2">{{ $blog->title }}</h3>
                <p class="text-sm text-on-surface-variant leading-relaxed line-clamp-4">{{ $blog->content }}</p>
                <p class="mt-4 text-xs text-on-surface-variant font-medium">
                    {{ $blog->created_at->translatedFormat('d F Y') }}
                </p>
            </article>
        @empty
            <div class="bg-white rounded-2xl border border-outline-variant/20 p-10 text-center text-on-surface-variant">
                <span class="material-symbols-outlined text-4xl block mb-3">article</span>
                Organisasi ini belum memiliki blog.
            </div>
        @endforelse
    </div>

    @auth
    <script>
        async function toggleFollow() {
            const btn       = document.getElementById('followBtn');
            const orgId     = btn.dataset.orgId;
            const isFollow  = btn.dataset.following === 'true';
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            btn.disabled = true;
            btn.style.opacity = '0.65';

            try {
                const resp = await fetch(`/organizations/${orgId}/follow`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                });

                const data = await resp.json();

                btn.dataset.following = data.followed ? 'true' : 'false';

                document.getElementById('followLabel').textContent = data.followed ? 'Mengikuti' : 'Ikuti Organisasi';
                const icon = document.getElementById('followIcon');
                icon.textContent = data.followed ? 'favorite' : 'favorite_border';
                icon.style.fontVariationSettings = `'FILL' ${data.followed ? 1 : 0}`;

                // Update follower count everywhere
                document.getElementById('followersCount').textContent = data.followers_count;
                document.querySelectorAll('[id^="statFollowers"]').forEach(el => {
                    el.textContent = data.followers_count;
                });

                // Animate count
                document.getElementById('followersLabel').classList.add('text-secondary');
                setTimeout(() => document.getElementById('followersLabel').classList.remove('text-secondary'), 600);

            } catch (e) {
                console.error(e);
            } finally {
                btn.disabled = false;
                btn.style.opacity = '1';
            }
        }
    </script>
    @endauth
</body>
</html>
