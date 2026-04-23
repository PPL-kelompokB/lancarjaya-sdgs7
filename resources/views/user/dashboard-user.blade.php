<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — EcoDon</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:"#003527",secondary:"#006c49",background:"#fff8f5","surface-container":"#f6ece6","outline-variant":"#bfc9c3","on-surface":"#1f1b17","on-surface-variant":"#404944"},fontFamily:{headline:["Manrope","sans-serif"],body:["Inter","sans-serif"]},borderRadius:{DEFAULT:"1rem",full:"9999px"}}}}</script>
    <style>.material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;}body,p,span{font-family:'Inter',sans-serif;}h1,h2,h3,h4{font-family:'Manrope',sans-serif;}</style>
</head>
<body class="bg-background text-on-surface min-h-screen flex flex-col">

    <nav class="sticky top-0 z-50 bg-[#fff8f5]/90 backdrop-blur-xl shadow-[0px_4px_20px_rgba(31,27,23,0.07)]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="text-xl font-headline font-extrabold text-primary">EcoDon</a>
            <div class="flex items-center gap-3">
                <a href="{{ route('user.feed') }}" class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold bg-primary text-white shadow transition-all">
                    <span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' 1;">dynamic_feed</span> Feed Saya
                </a>
                <a href="{{ route('search.organizations') }}" class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold text-on-surface-variant hover:bg-surface-container">
                    <span class="material-symbols-outlined text-[18px]">search</span> Cari Organisasi
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
        <h1 class="text-2xl font-headline font-extrabold text-primary mb-2">Halo, {{ $user->name }}! 👋</h1>
        <p class="text-on-surface-variant mb-8">Selamat datang di EcoDon. Ikuti organisasi untuk melihat aktivitas terbaru.</p>

        <div class="grid sm:grid-cols-2 gap-5">
            <a href="{{ route('user.feed') }}" class="bg-white rounded-2xl border border-outline-variant/20 shadow-sm p-6 hover:shadow-md transition-all flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-white" style="font-variation-settings:'FILL' 1;">dynamic_feed</span>
                </div>
                <div>
                    <p class="font-headline font-bold text-primary">Feed Aktivitas</p>
                    <p class="text-sm text-on-surface-variant">Update dari organisasi yang Anda ikuti</p>
                </div>
            </a>

            <a href="{{ route('search.organizations') }}" class="bg-white rounded-2xl border border-outline-variant/20 shadow-sm p-6 hover:shadow-md transition-all flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-secondary">search</span>
                </div>
                <div>
                    <p class="font-headline font-bold text-primary">Temukan Organisasi</p>
                    <p class="text-sm text-on-surface-variant">Cari dan ikuti organisasi baru</p>
                </div>
            </a>
        </div>
    </main>
</body>
</html>
