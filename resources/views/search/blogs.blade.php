<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Blog — EcoDon</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,line-clamp"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: { primary:"#003527",secondary:"#006c49",background:"#fff8f5","surface-container":"#f6ece6","outline-variant":"#bfc9c3","on-surface":"#1f1b17","on-surface-variant":"#404944" },
                fontFamily: { headline:["Manrope","sans-serif"], body:["Inter","sans-serif"] },
                borderRadius: { DEFAULT:"1rem", full:"9999px" },
            }}
        }
    </script>
    <style>.material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;}body{font-family:'Inter',sans-serif;}h1,h2,h3,h4{font-family:'Manrope',sans-serif;}</style>
</head>
<body class="bg-background text-on-surface min-h-screen flex flex-col">

    <nav class="sticky top-0 z-50 bg-[#fff8f5]/90 backdrop-blur-xl shadow-[0px_4px_20px_rgba(31,27,23,0.07)]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="text-xl font-headline font-extrabold text-primary">EcoDon</a>
            <div class="flex items-center gap-3">
                <a href="{{ route('user.feed') }}" class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold text-on-surface-variant hover:bg-surface-container transition-all">
                    <span class="material-symbols-outlined text-[18px]">dynamic_feed</span> Feed
                </a>
                <form action="{{ route('logout') }}" method="POST">@csrf
                    <button class="flex items-center gap-1 px-4 py-2 rounded-full text-sm font-semibold text-on-surface-variant hover:bg-surface-container">
                        <span class="material-symbols-outlined text-[18px]">logout</span> Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-5xl mx-auto w-full px-4 sm:px-6 py-10">
        <h1 class="text-2xl font-headline font-extrabold text-primary mb-6">Cari Blog</h1>

        <form method="GET" action="{{ route('search.blogs') }}" class="mb-8">
            <div class="relative max-w-xl">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input type="text" name="keyword" value="{{ $keyword }}"
                    placeholder="Cari judul atau konten blog..."
                    class="w-full pl-12 pr-4 py-3.5 rounded-full border border-outline-variant bg-white shadow-sm focus:ring-2 focus:ring-secondary/30 text-sm">
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 px-5 py-2 bg-primary text-white rounded-full text-sm font-bold">Cari</button>
            </div>
        </form>

        <div class="space-y-5">
            @forelse($blogs as $blog)
                <article class="bg-white rounded-2xl border border-outline-variant/20 shadow-sm p-6 hover:shadow-md transition-all">
                    <p class="text-xs text-secondary font-semibold mb-1 uppercase tracking-wider">{{ $blog->organization->organization_name ?? '-' }}</p>
                    <h2 class="text-lg font-headline font-bold text-primary mb-2">{{ $blog->title }}</h2>
                    <p class="text-sm text-on-surface-variant line-clamp-3">{{ $blog->content }}</p>
                    <p class="mt-3 text-xs text-on-surface-variant">{{ $blog->created_at->translatedFormat('d F Y') }}</p>
                </article>
            @empty
                <div class="text-center py-16 text-on-surface-variant">
                    <span class="material-symbols-outlined text-5xl block mb-3">article</span>
                    <p class="font-headline font-bold text-primary text-lg mb-1">Tidak Ada Blog</p>
                    <p class="text-sm">Belum ada blog yang sesuai kata kunci.</p>
                </div>
            @endforelse
        </div>

        @if($blogs->hasPages())
            <div class="mt-8">{{ $blogs->links() }}</div>
        @endif
    </main>
</body>
</html>
