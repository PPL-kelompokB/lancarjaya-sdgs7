<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $voucher->title }} - EcoDon</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, .brand-font { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-[#fff8f5] text-[#1f1b17]">

<div class="max-w-2xl mx-auto px-6 py-10">

    <!-- Back Button -->
    <a href="{{ route('user.voucher.index') }}" class="inline-flex mb-6 text-[#006c49] font-bold hover:underline">
        ← Kembali ke Vouchers
    </a>

    <!-- Voucher Detail Card -->
    <div class="bg-white rounded-2xl border border-[#eae1da] overflow-hidden shadow-lg">

        <!-- Image -->
        @if ($voucher->image)
            <img src="{{ asset('storage/' . $voucher->image) }}"
                 class="w-full h-64 object-cover">
        @else
            <div class="w-full h-64 bg-gradient-to-br from-[#006c49] to-[#003527] flex items-center justify-center">
                <span class="material-symbols-outlined text-white" style="font-size: 80px;">card_giftcard</span>
            </div>
        @endif

        <div class="p-8">

            <!-- Title & Status -->
            <div class="flex items-start justify-between mb-4">
                <div>
                    <span class="inline-block px-3 py-1 bg-[#e6f5ef] text-[#006c49] text-xs font-bold rounded-full uppercase">
                        {{ $voucher->discount_type === 'percentage' ? 'Persentase' : ($voucher->discount_type === 'nominal' ? 'Nominal' : 'Item') }}
                    </span>
                    <h1 class="text-4xl font-extrabold text-[#003527] mt-3">
                        {{ $voucher->title }}
                    </h1>
                </div>
            </div>

            <!-- Description -->
            @if ($voucher->description)
                <p class="text-[#404944] leading-relaxed mb-6">
                    {{ $voucher->description }}
                </p>
            @endif

            <!-- Discount Highlight -->
            <div class="bg-gradient-to-r from-[#006c49] to-[#003527] text-white rounded-2xl p-6 mb-6">
                <p class="text-sm opacity-90 mb-2">Nilai Diskon</p>
                <p class="text-5xl font-extrabold">
                    @if ($voucher->discount_type === 'percentage')
                        {{ $voucher->discount_value }}%
                    @elseif ($voucher->discount_type === 'nominal')
                        Rp {{ number_format($voucher->discount_value, 0, ',', '.') }}
                    @else
                        {{ $voucher->discount_value }} Item
                    @endif
                </p>
            </div>

            <!-- Key Info -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-[#f6ece6] rounded-xl p-4">
                    <p class="text-xs text-[#666] uppercase tracking-wide mb-2">Poin Dibutuhkan</p>
                    <p class="text-3xl font-extrabold text-[#006c49]">{{ $voucher->points_cost }}</p>
                </div>

                <div class="bg-blue-50 rounded-xl p-4">
                    <p class="text-xs text-blue-600 uppercase tracking-wide mb-2">Kuota Tersisa</p>
                    <p class="text-3xl font-extrabold text-blue-700">{{ $voucher->quota - $voucher->used_count }}</p>
                </div>

                <div class="bg-orange-50 rounded-xl p-4">
                    <p class="text-xs text-orange-600 uppercase tracking-wide mb-2">Berlaku Sampai</p>
                    <p class="text-lg font-bold text-orange-700">
                        {{ $voucher->end_date ? \Carbon\Carbon::parse($voucher->end_date)->format('d M Y') : 'Unlimited' }}
                    </p>
                </div>

                <div class="bg-purple-50 rounded-xl p-4">
                    <p class="text-xs text-purple-600 uppercase tracking-wide mb-2">Poin Anda</p>
                    <p class="text-3xl font-extrabold text-purple-700">{{ $userPoints->available_points ?? 0 }}</p>
                </div>
            </div>

            <!-- Action Button -->
            @if ($userPoints->available_points >= $voucher->points_cost && $voucher->quota > $voucher->used_count)
                <form action="{{ route('user.voucher.redeem', $voucher->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="w-full px-6 py-3 bg-[#006c49] text-white rounded-xl font-bold text-lg hover:bg-[#003527] transition">
                        ✓ Tukar dengan Poin
                    </button>
                </form>
            @else
                <button disabled class="w-full px-6 py-3 bg-gray-300 text-gray-600 rounded-xl font-bold text-lg cursor-not-allowed">
                    {{ $userPoints->available_points < $voucher->points_cost ? '✗ Poin Tidak Cukup' : '✗ Kuota Habis' }}
                </button>
            @endif

            <a href="{{ route('user.voucher.index') }}" class="block mt-3 px-6 py-3 border border-[#006c49] text-[#006c49] rounded-xl font-bold text-center hover:bg-[#f6ece6] transition">
                Kembali
            </a>

        </div>

    </div>

    <!-- Redemption History for this voucher -->
    @if ($userRedemptions->count() > 0)
    <section class="mt-10 bg-white rounded-2xl border border-[#eae1da] p-8">
        <h2 class="text-2xl font-bold text-[#003527] mb-6">Riwayat Penukaran Anda</h2>

        <div class="space-y-4">
            @foreach ($userRedemptions as $redemption)
                <div class="flex items-center justify-between p-4 bg-[#f6ece6] rounded-lg border border-[#eae1da]">
                    <div>
                        <p class="font-semibold text-[#003527]">Kode: {{ $redemption->redemption_code }}</p>
                        <p class="text-sm text-[#666] mt-1">{{ $redemption->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="text-right">
                        @if ($redemption->status === 'active')
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">
                                ✓ Aktif
                            </span>
                        @elseif ($redemption->status === 'used')
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">
                                ✓ Digunakan
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold">
                                ✗ Expired
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

</div>

</body>
</html>
