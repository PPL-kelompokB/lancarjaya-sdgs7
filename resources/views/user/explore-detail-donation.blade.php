<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $donation->title }} - Detail Donasi | EcoDon</title>
    <meta name="description" content="{{ Str::limit($donation->description ?? 'Detail informasi donasi barang di EcoDon.', 160) }}">

    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,line-clamp"></script>

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
                        "outline-variant": "#bfc9c3",
                        "on-surface": "#1f1b17",
                        "on-surface-variant": "#404944",
                    },
                    fontFamily: {
                        headline: ["Manrope", "sans-serif"],
                        body: ["Inter", "sans-serif"],
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
        h1, h2, h3, h4 { font-family: 'Manrope', sans-serif; }

        .status-open       { background:#dbeafe; color:#1d4ed8; }
        .status-in_progress{ background:#fef9c3; color:#a16207; }
        .status-completed  { background:#dcfce7; color:#15803d; }
        .status-cancelled  { background:#fee2e2; color:#b91c1c; }

        .logistic-waiting_pickup { background:#f3f4f6; color:#374151; }
        .logistic-picked_up      { background:#e0e7ff; color:#3730a3; }
        .logistic-in_transit     { background:#ffedd5; color:#c2410c; }
        .logistic-arrived        { background:#cffafe; color:#0e7490; }
        .logistic-processed      { background:#f3e8ff; color:#7e22ce; }
        .logistic-distributed    { background:#dcfce7; color:#15803d; }

        .detail-card {
            background: #fff;
            border: 1px solid #eae1da;
            border-radius: 1rem;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }
        .detail-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .fade-in { animation: fadeIn .45s ease both; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }
    </style>
</head>

<body class="bg-surface font-body text-on-surface min-h-screen">

@php
    $org      = $donation->organization;
    $orgName  = $org->organization_name ?? 'Organisasi';
    $orgImage = $org->profile_image ?? null;
    $orgInitial = strtoupper(substr($orgName, 0, 1));

    $statusLabel = [
        'open'        => 'Open',
        'in_progress' => 'In Progress',
        'completed'   => 'Completed',
        'cancelled'   => 'Dibatalkan',
    ];
    $logisticLabel = [
        'waiting_pickup' => 'Menunggu Pickup',
        'picked_up'      => 'Sudah Dijemput',
        'in_transit'     => 'Dalam Perjalanan',
        'arrived'        => 'Sudah Tiba',
        'processed'      => 'Sedang Diproses',
        'distributed'    => 'Sudah Didistribusi',
    ];
@endphp

<!-- NAV BAR -->
<nav class="sticky top-0 z-40 bg-white/80 backdrop-blur-xl border-b border-outline-variant/30 px-4 sm:px-8 py-4 flex items-center justify-between">
    <a href="{{ route('user.explore') }}"
       class="inline-flex items-center gap-2 text-secondary font-bold hover:text-primary transition-colors text-sm">
        <span class="material-symbols-outlined text-xl">arrow_back</span>
        Kembali ke Explore
    </a>
    <span class="text-xs font-semibold uppercase tracking-wider text-on-surface-variant bg-surface-container px-3 py-1 rounded-full">
        Detail Donasi
    </span>
</nav>

<div class="max-w-5xl mx-auto px-4 sm:px-6 py-10 fade-in">

    <!-- HERO CARD -->
    <div class="bg-white rounded-3xl shadow-[0_20px_60px_rgba(0,53,39,0.08)] border border-outline-variant/20 overflow-hidden mb-8">

        <!-- GRADIENT HEADER -->
        <div class="bg-gradient-to-br from-[#003527] to-[#006c49] px-6 sm:px-10 py-10 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10"
                 style="background-image: radial-gradient(circle at 80% 20%, #6cf8bb 0%, transparent 60%);"></div>

            <!-- BADGES STATUS -->
            <div class="flex flex-wrap gap-2 mb-5 relative">
                <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider
                    {{ 'status-' . $donation->status }}"
                    style="background:rgba(255,255,255,0.15); color:#fff; border:1px solid rgba(255,255,255,0.3);">
                    📦 {{ $statusLabel[$donation->status] ?? $donation->status }}
                </span>
                @if($donation->logistic_status)
                    <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider"
                          style="background:rgba(255,255,255,0.15); color:#fff; border:1px solid rgba(255,255,255,0.3);">
                        🚚 {{ $logisticLabel[$donation->logistic_status] ?? $donation->logistic_status }}
                    </span>
                @endif
            </div>

            <h1 class="text-2xl sm:text-4xl font-headline font-extrabold text-white leading-tight relative">
                {{ $donation->title }}
            </h1>

            @if($donation->description)
                <p class="mt-3 text-white/75 leading-relaxed max-w-2xl text-sm sm:text-base relative">
                    {{ $donation->description }}
                </p>
            @endif

            <!-- ORG AUTHOR -->
            <a href="{{ $org ? route('organization.public.profile', $org->id) : '#' }}"
               class="inline-flex items-center gap-3 mt-6 bg-white/10 hover:bg-white/20 border border-white/20 rounded-2xl px-4 py-3 transition-all relative">
                <div class="w-10 h-10 rounded-full bg-white/20 border border-white/30 flex items-center justify-center overflow-hidden shrink-0">
                    @if($orgImage)
                        <img src="{{ asset('storage/' . $orgImage) }}" class="w-full h-full object-cover" alt="{{ $orgName }}">
                    @else
                        <span class="font-black text-white text-lg">{{ $orgInitial }}</span>
                    @endif
                </div>
                <div>
                    <p class="font-bold text-white text-sm leading-tight">{{ $orgName }}</p>
                    @if($org && $org->verification_status === 'verified')
                        <p class="text-[11px] text-emerald-300 font-semibold flex items-center gap-1 mt-0.5">
                            <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1;">verified</span>
                            Terverifikasi
                        </p>
                    @endif
                </div>
            </a>
        </div>

        <!-- META PILLS -->
        <div class="px-6 sm:px-10 py-5 border-b border-outline-variant/20 flex flex-wrap gap-3">
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-on-surface-variant bg-surface-container px-3 py-1.5 rounded-full">
                <span class="material-symbols-outlined text-base">calendar_today</span>
                Dibuat {{ $donation->created_at->format('d M Y') }}
            </span>
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-on-surface-variant bg-surface-container px-3 py-1.5 rounded-full">
                <span class="material-symbols-outlined text-base">schedule</span>
                {{ $donation->start_date ? \Carbon\Carbon::parse($donation->start_date)->format('d M Y') : '-' }}
                →
                {{ $donation->end_date ? \Carbon\Carbon::parse($donation->end_date)->format('d M Y') : '-' }}
            </span>
        </div>

        <!-- DETAIL GRID -->
        <div class="px-6 sm:px-10 py-8">
            <h2 class="text-lg font-headline font-bold text-primary mb-5">Informasi Barang Donasi</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">

                <!-- Nama Barang -->
                <div class="detail-card">
                    <div class="detail-icon bg-emerald-100 text-emerald-700">
                        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">inventory_2</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Nama Barang</p>
                        <p class="font-bold text-on-surface truncate">{{ $donation->item_name ?: '-' }}</p>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="detail-card">
                    <div class="detail-icon bg-blue-100 text-blue-700">
                        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">category</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Kategori</p>
                        <p class="font-bold text-on-surface">{{ $donation->category ?: '-' }}</p>
                    </div>
                </div>

                <!-- Jumlah -->
                <div class="detail-card">
                    <div class="detail-icon bg-purple-100 text-purple-700">
                        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">production_quantity_limits</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Jumlah</p>
                        <p class="font-bold text-on-surface">
                            {{ $donation->quantity ? $donation->quantity . ' ' . ($donation->unit ?: '') : '-' }}
                        </p>
                    </div>
                </div>

                <!-- Status Donasi -->
                <div class="detail-card">
                    <div class="detail-icon bg-orange-100 text-orange-700">
                        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">info</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Status Donasi</p>
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider {{ 'status-' . $donation->status }}">
                            {{ $statusLabel[$donation->status] ?? $donation->status }}
                        </span>
                    </div>
                </div>

                <!-- Status Logistik -->
                <div class="detail-card sm:col-span-2">
                    <div class="detail-icon bg-cyan-100 text-cyan-700">
                        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">local_shipping</span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Status Logistik</p>
                        @if($donation->logistic_status)
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider logistic-{{ $donation->logistic_status }}">
                                {{ $logisticLabel[$donation->logistic_status] ?? $donation->logistic_status }}
                            </span>
                        @else
                            <span class="font-bold text-on-surface">-</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- LOKASI & KONTAK -->
            <h2 class="text-lg font-headline font-bold text-primary mb-5">Lokasi & Kontak</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">

                <!-- Alamat -->
                <div class="detail-card sm:col-span-2">
                    <div class="detail-icon bg-red-100 text-red-600">
                        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">location_on</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Alamat Lengkap</p>
                        <p class="font-bold text-on-surface">{{ $donation->address ?: '-' }}</p>
                        <p class="text-sm text-on-surface-variant mt-0.5">
                            {{ $donation->city ?: '' }}{{ $donation->city && $donation->province ? ', ' : '' }}{{ $donation->province ?: '' }}
                        </p>
                    </div>
                </div>

                <!-- Kontak Person -->
                <div class="detail-card">
                    <div class="detail-icon bg-teal-100 text-teal-700">
                        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">person</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Narahubung</p>
                        <p class="font-bold text-on-surface">{{ $donation->contact_person ?: '-' }}</p>
                    </div>
                </div>

                <!-- Nomor Telepon -->
                <div class="detail-card">
                    <div class="detail-icon bg-green-100 text-green-700">
                        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">call</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold mb-1">Nomor Telepon</p>
                        @if($donation->contact_phone)
                            <a href="tel:{{ $donation->contact_phone }}"
                               class="font-bold text-secondary hover:text-primary transition-colors">
                                {{ $donation->contact_phone }}
                            </a>
                        @else
                            <p class="font-bold text-on-surface">-</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- PERIODE -->
            <h2 class="text-lg font-headline font-bold text-primary mb-5">Periode Donasi</h2>

            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl border border-emerald-200 p-5 flex flex-col sm:flex-row items-center gap-4 mb-8">
                <div class="flex-1 text-center sm:text-left">
                    <p class="text-xs uppercase tracking-wider text-emerald-700 font-semibold mb-1">Mulai</p>
                    <p class="text-xl font-headline font-extrabold text-primary">
                        {{ $donation->start_date ? \Carbon\Carbon::parse($donation->start_date)->format('d M Y') : '-' }}
                    </p>
                </div>
                <div class="text-2xl text-emerald-400 hidden sm:block">→</div>
                <div class="flex-1 text-center sm:text-right">
                    <p class="text-xs uppercase tracking-wider text-emerald-700 font-semibold mb-1">Berakhir</p>
                    <p class="text-xl font-headline font-extrabold text-primary">
                        {{ $donation->end_date ? \Carbon\Carbon::parse($donation->end_date)->format('d M Y') : '-' }}
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- INTERAKSI: LIKE & KOMENTAR -->
    <div class="bg-white rounded-3xl shadow-[0_20px_60px_rgba(0,53,39,0.06)] border border-outline-variant/20 p-6 sm:p-8">

        <div class="flex items-center gap-4 mb-6">
            @auth
                <form action="{{ route('like', ['donation', $donation->id]) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2 rounded-full border border-red-200 bg-red-50 text-red-600 font-bold text-sm hover:bg-red-100 transition-all">
                        ❤️ <span>{{ $donation->likes()->count() }}</span> Suka
                    </button>
                </form>
            @else
                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-surface-container text-on-surface-variant text-sm font-semibold">
                    ❤️ {{ $donation->likes()->count() }} Suka
                </span>
            @endauth

            <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-surface-container text-on-surface-variant text-sm font-semibold">
                💬 {{ $donation->comments()->count() }} Komentar
            </span>
        </div>

        <!-- DAFTAR KOMENTAR -->
        <h2 class="text-xl font-headline font-bold text-primary mb-4">Komentar</h2>

        <div class="space-y-3 mb-6">
            @forelse($donation->comments()->with('user')->latest()->get() as $comment)
                <div class="bg-surface-container rounded-2xl px-4 py-4">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-9 h-9 rounded-full bg-white border border-outline-variant/30 flex items-center justify-center overflow-hidden shrink-0">
                            @if($comment->user->profile_photo ?? false)
                                <img src="{{ asset('storage/' . $comment->user->profile_photo) }}"
                                     class="w-full h-full object-cover" alt="{{ $comment->user->name }}">
                            @else
                                <span class="text-sm font-extrabold text-primary">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </span>
                            @endif
                        </div>
                        <div>
                            <p class="font-bold text-sm text-primary">{{ $comment->user->name }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <p class="text-sm text-on-surface leading-relaxed">{{ $comment->body }}</p>
                </div>
            @empty
                <div class="bg-surface-container rounded-2xl px-5 py-6 text-center text-on-surface-variant text-sm">
                    Belum ada komentar. Jadilah yang pertama berkomentar!
                </div>
            @endforelse
        </div>

        <!-- FORM KOMENTAR -->
        @auth
            <form action="{{ route('comment', ['donation', $donation->id]) }}" method="POST">
                @csrf
                <label class="block text-sm font-semibold text-primary mb-2">Tulis Komentar</label>
                <textarea
                    name="body"
                    rows="3"
                    placeholder="Bagikan pendapat atau pertanyaan kamu tentang donasi ini..."
                    class="w-full rounded-2xl border border-outline-variant px-4 py-3 text-sm focus:ring-2 focus:ring-secondary focus:border-secondary resize-none"
                    required
                ></textarea>
                <div class="flex justify-end mt-3">
                    <button type="submit"
                            class="px-7 py-2.5 bg-primary text-white rounded-full font-bold text-sm hover:bg-secondary transition-colors">
                        Kirim Komentar
                    </button>
                </div>
            </form>
        @else
            <div class="bg-surface-container rounded-2xl px-5 py-4 text-center">
                <p class="text-sm text-on-surface-variant">
                    <a href="{{ route('login') }}" class="text-secondary font-bold hover:underline">Login</a>
                    untuk memberikan komentar.
                </p>
            </div>
        @endauth
    </div>

</div>

</body>
</html>
