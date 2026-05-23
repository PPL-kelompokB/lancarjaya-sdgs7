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
        h1, h2, h3, h4, .brand-font { font-family: 'Manrope', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-[#fff8f5] text-[#1f1b17] min-h-screen">

<div class="max-w-6xl mx-auto px-6 py-10">

    <!-- Back Button -->
    <a href="{{ route('user.dashboard') }}" class="inline-flex mb-6 text-[#006c49] font-bold hover:underline">
        ← Kembali ke Dashboard
    </a>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-[#003527] brand-font">
            🎁 Tukar Poin dengan Voucher
        </h1>
        <p class="mt-2 text-[#404944]">
            Kumpulkan poin dari aktivitas Anda dan tukarkan dengan voucher menarik
        </p>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-green-700">
            <div class="flex gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                <div>
                    <p class="font-semibold">Berhasil!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-red-700">
            <div class="flex gap-3">
                <span class="material-symbols-outlined">error</span>
                <div>
                    <p class="font-semibold">Terjadi Kesalahan</p>
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- User Points Card -->
    <section class="bg-white rounded-2xl border border-[#eae1da] p-8 mb-8 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <p class="text-sm text-[#666] uppercase tracking-wide mb-2">Total Poin</p>
                <h2 class="text-4xl font-extrabold text-[#006c49]">
                    {{ $userPoints->total_points ?? 0 }}
                </h2>
            </div>

            <div>
                <p class="text-sm text-[#666] uppercase tracking-wide mb-2">Poin Tersedia</p>
                <h2 class="text-4xl font-extrabold text-blue-600">
                    {{ $userPoints->available_points ?? 0 }}
                </h2>
            </div>

            <div>
                <p class="text-sm text-[#666] uppercase tracking-wide mb-2">Poin Digunakan</p>
                <h2 class="text-4xl font-extrabold text-orange-600">
                    {{ $userPoints->used_points ?? 0 }}
                </h2>
            </div>
        </div>

        <div class="mt-6 pt-6 border-t border-[#eae1da]">
            <p class="text-sm text-[#666] mb-2">Riwayat Poin</p>
            <a href="{{ route('user.voucher.history') }}" class="inline-flex items-center gap-2 text-[#006c49] font-semibold hover:text-[#003527]">
                <span class="material-symbols-outlined" style="font-size: 20px;">history</span>
                Lihat Riwayat Penukaran
            </a>
        </div>
    </section>

    <!-- Available Vouchers -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-[#003527] mb-6">📌 Voucher Tersedia</h2>

        @if ($vouchers->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($vouchers as $voucher)
                    <div class="bg-white rounded-2xl border border-[#eae1da] overflow-hidden hover:shadow-lg transition-shadow">
                        <!-- Voucher Image -->
                        @if ($voucher->image)
                            <img src="{{ asset('storage/' . $voucher->image) }}"
                                 class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gradient-to-br from-[#006c49] to-[#003527] flex items-center justify-center">
                                <span class="material-symbols-outlined text-white" style="font-size: 60px;">card_giftcard</span>
                            </div>
                        @endif

                        <div class="p-5">
                            <!-- Title -->
                            <h3 class="text-lg font-bold text-[#003527] line-clamp-2">
                                {{ $voucher->title }}
                            </h3>

                            <!-- Description -->
                            @if ($voucher->description)
                                <p class="text-sm text-[#666] mt-2 line-clamp-2">
                                    {{ $voucher->description }}
                                </p>
                            @endif

                            <!-- Discount Info -->
                            <div class="mt-4 p-3 bg-[#f6ece6] rounded-lg">
                                <p class="text-2xl font-bold text-[#006c49]">
                                    @if ($voucher->discount_type === 'percentage')
                                        {{ $voucher->discount_value }}%
                                    @elseif ($voucher->discount_type === 'nominal')
                                        Rp {{ number_format($voucher->discount_value, 0, ',', '.') }}
                                    @else
                                        {{ $voucher->discount_value }} Item
                                    @endif
                                </p>
                                <p class="text-xs text-[#666] mt-1">Diskon</p>
                            </div>

                            <!-- Points Required -->
                            <div class="mt-4 flex items-center justify-between bg-blue-50 p-3 rounded-lg border border-blue-200">
                                <div>
                                    <p class="text-xs text-blue-600">Poin Dibutuhkan</p>
                                    <p class="text-xl font-bold text-blue-700">{{ $voucher->points_cost }}</p>
                                </div>
                                <span class="material-symbols-outlined text-blue-600">star</span>
                            </div>

                            <!-- Quota Info -->
                            <div class="mt-3 text-xs text-[#666]">
                                <p>Kuota: {{ $voucher->quota - $voucher->used_count }} dari {{ $voucher->quota }}</p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-5 flex gap-2">
                                @if ($userPoints->available_points >= $voucher->points_cost && $voucher->quota > $voucher->used_count)
                                    <form action="{{ route('user.voucher.redeem', $voucher->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="w-full px-4 py-2 bg-[#006c49] text-white rounded-lg font-semibold hover:bg-[#003527] transition">
                                            Tukar Sekarang
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-full px-4 py-2 bg-gray-300 text-gray-600 rounded-lg font-semibold cursor-not-allowed">
                                        {{ $userPoints->available_points < $voucher->points_cost ? 'Poin Kurang' : 'Kuota Habis' }}
                                    </button>
                                @endif

                                <a href="{{ route('user.voucher.show', $voucher->id) }}"
                                   class="px-4 py-2 border border-[#006c49] text-[#006c49] rounded-lg font-semibold hover:bg-[#f6ece6] transition">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-2xl border border-[#eae1da]">
                <span class="material-symbols-outlined text-5xl text-gray-300" style="display: inline-block;">card_giftcard</span>
                <p class="mt-4 text-gray-500">Tidak ada voucher tersedia saat ini</p>
            </div>
        @endif
    </section>

    <!-- Redeemed Vouchers History -->
    @if ($redeemedVouchers->count() > 0)
    <section class="bg-white rounded-2xl border border-[#eae1da] p-6">
        <h2 class="text-xl font-bold text-[#003527] mb-4">📋 Voucher yang Sudah Ditukar</h2>

        <div class="space-y-3">
            @foreach ($redeemedVouchers as $redemption)
                <div class="flex items-center justify-between p-4 bg-[#f6ece6] rounded-lg border border-[#eae1da]">
                    <div>
                        <p class="font-semibold text-[#003527]">{{ $redemption->voucher->title }}</p>
                        <p class="text-sm text-[#666]">
                            Kode: <span class="font-mono font-bold">{{ $redemption->redemption_code }}</span>
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-bold text-gray-500 uppercase">
                            @if ($redemption->status === 'active')
                                <span class="text-green-600">✓ Aktif</span>
                            @elseif ($redemption->status === 'used')
                                <span class="text-blue-600">✓ Sudah Digunakan</span>
                            @else
                                <span class="text-gray-500">✗ Expired</span>
                            @endif
                        </p>
                        <p class="text-xs text-[#666]">{{ $redemption->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('user.voucher.history') }}" class="text-[#006c49] font-semibold hover:underline">
                Lihat Semua →
            </a>
        </div>
    </section>
    @endif

</div>

</body>
</html>
