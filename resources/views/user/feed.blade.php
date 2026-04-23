<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed Organisasi — EcoDon</title>
    <meta name="description" content="Update terbaru dari organisasi sosial yang Anda ikuti di EcoDon.">

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
            color: #fff;
            border: 2px solid #003527;
        }

        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .blog-card { animation: fadeSlideIn .35s ease both; }
    </style>
</head>
<body class="bg-background text-on-surface font-body min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 bg-[#fff8f5]/90 backdrop-blur-xl shadow-[0px_4px_20px_rgba(31,27,23,0.07)]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-4">
            <a href="{{ url('/') }}" class="text-xl font-headline font-extrabold text-primary tracking-tight">EcoDon</a>

            <div class="flex items-center gap-3">
                <a href="{{ route('search.organizations') }}"
                   class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold text-on-surface-variant hover:bg-surface-container transition-all">
                    <span class="material-symbols-outlined text-[18px]">search</span>
                    Temukan Organisasi
                </a>

                <a href="{{ route('user.feed') }}"
                   class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold bg-primary text-white shadow transition-all">
                    <span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' 1;">dynamic_feed</span>
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

    {{-- MAIN --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10 grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- LEFT: Feed --}}
        <section class="lg:col-span-8 space-y-6">

            {{-- Header --}}
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center shadow">
                    <span class="material-symbols-outlined text-white text-[20px]" style="font-variation-settings:'FILL' 1;">dynamic_feed</span>
                </div>
                <div>
                    <h1 class="text-2xl font-headline font-extrabold text-primary">Feed Aktivitas</h1>
                    <p class="text-sm text-on-surface-variant">Update terbaru dari organisasi yang Anda ikuti</p>
                </div>
            </div>

            @if(session('success'))
                <div class="flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    <span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' 1;">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Blog cards --}}
            @forelse($blogs as $blog)
                <article class="blog-card bg-white rounded-2xl border border-outline-variant/20 shadow-sm hover:shadow-md transition-all overflow-hidden">
                    <div class="p-6">
                        {{-- Org header --}}
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center overflow-hidden flex-shrink-0">
                                @if(!empty($blog->organization->profile_image))
                                    <img src="{{ asset('storage/' . $blog->organization->profile_image) }}"
                                         alt="{{ $blog->organization->organization_name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-primary text-[20px]">business</span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-sm text-primary truncate">{{ $blog->organization->organization_name ?? 'Organisasi' }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $blog->created_at->diffForHumans() }}</p>
                            </div>

                            {{-- Inline follow button --}}
                            @php
                                $isFollowing = auth()->user()->isFollowing($blog->organization);
                            @endphp
                            <button
                                class="follow-btn text-xs font-bold px-4 py-1.5 rounded-full transition-all"
                                data-org-id="{{ $blog->organization->id }}"
                                data-following="{{ $isFollowing ? 'true' : 'false' }}"
                                onclick="toggleFollow(this)"
                            >
                                {{ $isFollowing ? 'Mengikuti' : 'Ikuti' }}
                            </button>
                        </div>

                        {{-- Blog content --}}
                        <h2 class="text-lg font-headline font-bold text-primary mb-2 leading-snug">
                            {{ $blog->title }}
                        </h2>
                        <p class="text-sm text-on-surface-variant leading-relaxed line-clamp-3">
                            {{ $blog->content }}
                        </p>

                        <div class="mt-4 flex items-center gap-2 text-xs text-on-surface-variant">
                            <span class="material-symbols-outlined text-[15px]">calendar_today</span>
                            {{ $blog->created_at->translatedFormat('d F Y') }}
                        </div>
                    </div>
                </article>
            @empty
                <div class="bg-white rounded-2xl border border-outline-variant/20 p-12 text-center">
                    <div class="w-20 h-20 rounded-full bg-surface-container mx-auto flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-4xl text-on-surface-variant">inbox</span>
                    </div>
                    <h3 class="text-xl font-headline font-bold text-primary mb-2">Feed Kosong</h3>
                    <p class="text-on-surface-variant text-sm max-w-xs mx-auto mb-6">
                        Anda belum mengikuti organisasi mana pun, atau organisasi yang Anda ikuti belum memposting blog.
                    </p>
                    <a href="{{ route('search.organizations') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold text-sm shadow hover:scale-105 transition-all">
                        <span class="material-symbols-outlined text-[18px]">search</span>
                        Temukan Organisasi
                    </a>
                </div>
            @endforelse

            {{-- Pagination --}}
            @if($blogs->hasPages())
                <div class="pt-4">
                    {{ $blogs->links() }}
                </div>
            @endif
        </section>

        {{-- RIGHT: Following sidebar --}}
        <aside class="lg:col-span-4 space-y-6">

            {{-- Following list --}}
            <div class="bg-white rounded-2xl border border-outline-variant/20 shadow-sm p-6 sticky top-24">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-base font-headline font-bold text-primary">Organisasi Diikuti</h2>
                    <span class="text-xs font-bold bg-secondary-container text-on-secondary-container px-2.5 py-1 rounded-full">
                        {{ $followingOrganizations->count() }}
                    </span>
                </div>

                @forelse($followingOrganizations as $org)
                    <div class="flex items-center gap-3 py-3 border-b border-outline-variant/10 last:border-0">
                        <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center overflow-hidden flex-shrink-0">
                            @if(!empty($org->profile_image))
                                <img src="{{ asset('storage/' . $org->profile_image) }}"
                                     alt="{{ $org->organization_name }}" class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-primary text-[20px]">business</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-primary truncate">{{ $org->organization_name }}</p>
                            <p class="text-xs text-on-surface-variant truncate">{{ $org->organization_type }}</p>
                        </div>
                        <button
                            class="follow-btn text-[11px] font-bold px-3 py-1 rounded-full transition-all flex-shrink-0"
                            data-org-id="{{ $org->id }}"
                            data-following="true"
                            onclick="toggleFollow(this)"
                        >
                            Mengikuti
                        </button>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <span class="material-symbols-outlined text-4xl text-on-surface-variant block mb-3">group_off</span>
                        <p class="text-sm text-on-surface-variant">Belum ada organisasi yang diikuti.</p>
                    </div>
                @endforelse

                @if($followingOrganizations->count() > 0)
                    <a href="{{ route('search.organizations') }}"
                       class="mt-4 block text-center text-sm font-bold text-secondary hover:underline">
                        + Temukan lebih banyak
                    </a>
                @endif
            </div>

        </aside>
    </main>

    <script>
        async function toggleFollow(btn) {
            const orgId    = btn.dataset.orgId;
            const isFollow = btn.dataset.following === 'true';
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            btn.disabled = true;
            btn.style.opacity = '0.6';

            try {
                const response = await fetch(`/organizations/${orgId}/follow`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                });

                const data = await response.json();

                // Update ALL buttons for this org
                document.querySelectorAll(`.follow-btn[data-org-id="${orgId}"]`).forEach(b => {
                    b.dataset.following = data.followed ? 'true' : 'false';
                    b.textContent       = data.followed ? 'Mengikuti' : 'Ikuti';
                });

                // If unfollowed, remove from sidebar (small delay for UX)
                if (!data.followed) {
                    setTimeout(() => {
                        // Remove from sidebar list
                        const sidebarRow = document.querySelector(`.follow-btn[data-org-id="${orgId}"]`)
                                                   ?.closest('.flex.items-center.gap-3.py-3');
                        if (sidebarRow) {
                            sidebarRow.style.transition = 'opacity .3s';
                            sidebarRow.style.opacity = '0';
                            setTimeout(() => sidebarRow.remove(), 300);
                        }
                    }, 400);
                }

            } catch (e) {
                console.error(e);
            } finally {
                btn.disabled = false;
                btn.style.opacity = '1';
            }
        }
    </script>
</body>
</html>
