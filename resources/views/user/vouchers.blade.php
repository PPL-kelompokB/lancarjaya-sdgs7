<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tukar Poin - EcoDon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1,h2,h3 { font-family: 'Manrope', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .voucher-card { transition: transform 0.2s, box-shadow 0.2s; }
        .voucher-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,53,39,0.12); }
    </style>
</head>
<body class="bg-[#fff8f5] text-[#1f1b17] min-h-screen">

<div class="max-w-5xl mx-auto px-4 py-10">

    <!-- Header -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('user.dashboard') }}" class="inline-flex items-center gap-1 text-sm text-[#006c49] font-semibold mb-3 hover:underline">
                <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Dashboard
            </a>
            <h1 class="text-3xl font-extrabold text-[#003527]">Tukar Poin</h1>
            <p class="text-sm text-[#666] mt-1">Gunakan poin kamu untuk mendapatkan voucher menarik.</p>
        </div>

        <!-- Poin user -->
        <div class="flex items-center gap-3 bg-gradient-to-br from-[#003527] to-[#006c49] text-white rounded-2xl px-6 py-4 shadow-lg min-w-[160px]">
            <span class="material-symbols-outlined text-3xl text-yellow-300">stars</span>
            <div>
                <p class="text-xs opacity-80 uppercase tracking-wide">Poin Kamu</p>
                <p class="text-2xl font-extrabold">{{ number_format($userPoints) }}</p>
            </div>
        </div>
    </div>

    <!-- Riwayat link -->
    <div class="mb-6 text-right">
        <a href="{{ route('user.vouchers.my') }}"
           class="inline-flex items-center gap-2 text-sm font-semibold text-[#006c49] hover:underline">
            <span class="material-symbols-outlined text-sm">confirmation_number</span>
            Lihat Voucher Saya →
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            <span class="material-symbols-outlined">error</span>
            {{ session('error') }}
        </div>
    @endif

    <!-- Daftar Voucher -->
    @if($vouchers->isEmpty())
        <div class="bg-white rounded-3xl border border-[#eae1da] p-16 text-center shadow-sm">
            <span class="material-symbols-outlined text-6xl text-[#ccc]">confirmation_number</span>
            <h2 class="mt-4 text-xl font-bold text-[#003527]">Belum Ada Voucher Tersedia</h2>
            <p class="text-sm text-[#999] mt-2">Pantau terus, admin akan menambahkan voucher baru segera.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($vouchers as $voucher)
                @php
                    $canAfford = $userPoints >= $voucher->points_cost;
                    $alreadyOwned = $myVoucherIds->contains($voucher->id);
                @endphp
                <div class="voucher-card bg-white rounded-3xl border border-[#eae1da] overflow-hidden shadow-sm flex flex-col">

                    <!-- Gambar / Placeholder -->
                    <div class="relative">
                        @if($voucher->image)
                            <img src="{{ asset('storage/' . $voucher->image) }}"
                                 alt="{{ $voucher->title }}"
                                 class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gradient-to-br from-[#e6f5ef] to-[#c6e8da] flex items-center justify-center">
                                <span class="material-symbols-outlined text-6xl text-[#006c49]">confirmation_number</span>
                            </div>
                        @endif

                        <!-- Discount badge -->
                        <div class="absolute top-3 right-3 bg-[#003527] text-white text-xs font-bold px-3 py-1 rounded-full">
                            @if($voucher->discount_type === 'percentage')
                                {{ $voucher->discount_value }}% OFF
                            @elseif($voucher->discount_type === 'nominal')
                                Rp {{ number_format($voucher->discount_value, 0, ',', '.') }}
                            @else
                                ITEM
                            @endif
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="font-bold text-[#1f1b17] text-base leading-snug">{{ $voucher->title }}</h3>
                        @if($voucher->description)
                            <p class="text-xs text-[#888] mt-1 line-clamp-2">{{ $voucher->description }}</p>
                        @endif

                        <!-- Info baris -->
                        <div class="mt-4 space-y-2">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-[#666]">Harga Poin</span>
                                <span class="font-bold text-[#003527] flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm text-yellow-500">stars</span>
                                    {{ number_format($voucher->points_cost) }} poin
                                </span>
                            </div>

                            @if($voucher->quota > 0)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-[#666]">Sisa Kuota</span>
                                    <span class="font-semibold {{ ($voucher->quota - $voucher->used_count) <= 5 ? 'text-red-600' : 'text-[#1f1b17]' }}">
                                        {{ $voucher->quota - $voucher->used_count }} tersisa
                                    </span>
                                </div>
                            @endif

                            @if($voucher->end_date)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-[#666]">Berlaku hingga</span>
                                    <span class="font-semibold text-[#1f1b17]">
                                        {{ \Carbon\Carbon::parse($voucher->end_date)->format('d M Y') }}
                                    </span>
                                </div>
                            @endif

                            @if($voucher->code)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-[#666]">Kode</span>
                                    <code class="bg-[#f6ece6] px-2 py-0.5 rounded text-[#003527] font-bold text-xs">{{ $voucher->code }}</code>
                                </div>
                            @endif
                        </div>

                        <!-- Aksi -->
                        <div class="mt-5 pt-4 border-t border-[#f0e8e2]">
                            @if($alreadyOwned)
                                <button disabled
                                        class="w-full py-2.5 rounded-full bg-gray-100 text-gray-400 text-sm font-semibold cursor-not-allowed">
                                    ✓ Sudah Ditukar
                                </button>
                            @elseif(!$canAfford)
                                <button disabled
                                        class="w-full py-2.5 rounded-full bg-[#f6ece6] text-[#999] text-sm font-semibold cursor-not-allowed">
                                    Poin Tidak Cukup
                                </button>
                                <p class="text-center text-xs text-red-400 mt-1">
                                    Kurang {{ number_format($voucher->points_cost - $userPoints) }} poin
                                </p>
                            @else
                                <form action="{{ route('user.vouchers.redeem', $voucher->id) }}" method="POST"
                                      onsubmit="return confirm('Tukar {{ $voucher->points_cost }} poin untuk voucher \'{{ $voucher->title }}\'?')">
                                    @csrf
                                    <button type="submit"
                                            class="w-full py-2.5 rounded-full bg-[#003527] text-white text-sm font-bold hover:bg-[#006c49] transition">
                                        Tukar Sekarang
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
</body>
</html>
