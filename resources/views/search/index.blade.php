<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian — EcoDon</title>
    <meta name="description" content="Hasil pencarian blog dan organisasi di EcoDon.">

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
                        "surface-container-high": "#f0e6e0",
                        "outline-variant": "#bfc9c3",
                        "on-surface": "#1f1b17",
                        "on-surface-variant": "#404944",
                        "secondary-container": "#6cf8bb",
                        "on-secondary-container": "#00714d",
                    },
                    fontFamily: { headline: ["Manrope","sans-serif"], body: ["Inter","sans-serif"] },
                    borderRadius: { DEFAULT:"1rem", lg:"2rem", xl:"3rem", full:"9999px" },
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;}
        body{font-family:'Inter',sans-serif;}
        h1,h2,h3,h4,.font-headline{font-family:'Manrope',sans-serif;}
        .follow-btn[data-following="true"]{background:#f6ece6;color:#003527;border:2px solid #003527;}
        .follow-btn[data-following="false"]{background:#003527;color:white;border:2px solid #003527;}
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen flex flex-col">

    <nav class="sticky top-0 z-50 bg-[#fff8f5]/90 backdrop-blur-xl shadow-[0px_4px_20px_rgba(31,27,23,0.07)]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-4">
            <a href="{{ url('/') }}" class="text-xl font-headline font-extrabold text-primary">EcoDon</a>
            <div class="flex items-center gap-3">
                <a href="{{ route('user.feed') }}" class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold text-on-surface-variant hover:bg-surface-container transition-all">
                    <span class="material-symbols-outlined text-[18px]">dynamic_feed</span> Feed
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="flex items-center gap-1 px-4 py-2 rounded-full text-sm font-semibold text-on-surface-variant hover:bg-surface-container transition-all">
                        <span class="material-symbols-outlined text-[18px]">logout</span> Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-headline font-extrabold text-primary mb-6">
            Hasil Pencarian: "{{ $keyword }}"
        </h1>

        <form method="GET" action="{{ route('search.global') }}" class="mb-8">
            <div class="relative max-w-xl">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input type="text" name="keyword" value="{{ $keyword }}"
                    placeholder="Cari blog atau organisasi..."
                    class="w-full pl-12 pr-4 py-3.5 rounded-full border border-outline-variant bg-white shadow-sm focus:ring-2 focus:ring-secondary/30 text-sm">
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 px-5 py-2 bg-primary text-white rounded-full text-sm font-bold">Cari</button>
            </div>
        </form>

        {{-- Organizations --}}
        @if($organizations->count() > 0)
            <section class="mb-10">
                <h2 class="text-lg font-headline font-bold text-primary mb-4">
                    Organisasi ({{ $organizations->count() }})
                </h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($organizations as $org)
                        @php $isFollowing = auth()->user()->isFollowing($org); @endphp
                        <div class="bg-white rounded-2xl border border-outline-variant/20 shadow-sm p-5 flex flex-col gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-surface-container flex-shrink-0">
                                    @if(!empty($org->profile_image))
                                        <img src="{{ asset('storage/'.$org->profile_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center"><span class="material-symbols-outlined text-primary">business</span></div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-sm text-primary truncate">{{ $org->organization_name }}</p>
                                    <p class="text-xs text-on-surface-variant">{{ $org->organization_type }}</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('organization.public-profile', $org->id) }}"
                                   class="flex-1 text-center px-3 py-1.5 text-sm font-semibold text-primary bg-surface-container rounded-full hover:bg-surface-container-high transition-all">
                                    Profil
                                </a>
                                <button class="follow-btn flex-1 text-sm font-bold px-3 py-1.5 rounded-full"
                                    data-org-id="{{ $org->id }}"
                                    data-following="{{ $isFollowing ? 'true' : 'false' }}"
                                    onclick="toggleFollow(this)">
                                    {{ $isFollowing ? 'Mengikuti' : 'Ikuti' }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Blogs --}}
        @if($blogs->count() > 0)
            <section>
                <h2 class="text-lg font-headline font-bold text-primary mb-4">Blog ({{ $blogs->count() }})</h2>
                <div class="space-y-4">
                    @foreach($blogs as $blog)
                        <article class="bg-white rounded-2xl border border-outline-variant/20 shadow-sm p-5">
                            <p class="text-xs text-secondary font-semibold mb-1">{{ $blog->organization->organization_name ?? '-' }}</p>
                            <h3 class="font-headline font-bold text-primary">{{ $blog->title }}</h3>
                            <p class="text-sm text-on-surface-variant mt-1 line-clamp-2">{{ $blog->content }}</p>
                            <p class="text-xs text-on-surface-variant mt-3">{{ $blog->created_at->diffForHumans() }}</p>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        @if($organizations->isEmpty() && $blogs->isEmpty())
            <div class="text-center py-16 text-on-surface-variant">
                <span class="material-symbols-outlined text-5xl block mb-3">search_off</span>
                <p class="font-headline font-bold text-primary text-lg mb-1">Tidak Ada Hasil</p>
                <p class="text-sm">Coba kata kunci yang berbeda.</p>
            </div>
        @endif
    </main>

    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;
        async function toggleFollow(btn) {
            const orgId = btn.dataset.orgId;
            btn.disabled = true; btn.style.opacity = '0.6';
            try {
                const resp = await fetch(`/organizations/${orgId}/follow`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
                });
                const data = await resp.json();
                document.querySelectorAll(`.follow-btn[data-org-id="${orgId}"]`).forEach(b => {
                    b.dataset.following = data.followed ? 'true' : 'false';
                    b.textContent = data.followed ? 'Mengikuti' : 'Ikuti';
                });
            } catch(e) { console.error(e); }
            finally { btn.disabled=false; btn.style.opacity='1'; }
        }
    </script>
</body>
</html>
