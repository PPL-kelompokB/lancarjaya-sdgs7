<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penukaran Voucher - EcoDon</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, .brand-font { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-[#fff8f5] text-[#1f1b17] min-h-screen">

<div class="max-w-4xl mx-auto px-6 py-10">

    <!-- Back Button -->
    <a href="{{ route('user.voucher.index') }}" class="inline-flex mb-6 text-[#006c49] font-bold hover:underline">
        ← Kembali ke Vouchers
    </a>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-[#003527] brand-font">
            📋 Riwayat Penukaran Voucher
        </h1>
        <p class="mt-2 text-[#404944]">
            Kelola voucher yang sudah Anda tukarkan
        </p>
    </div>

    <!-- User Points Summary -->
    <section class="bg-white rounded-2xl border border-[#eae1da] p-6 mb-8 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <p class="text-sm text-[#666] uppercase tracking-wide mb-2">Total Poin</p>
                <h2 class="text-3xl font-extrabold text-[#006c49]">
                    {{ $userPoints->total_points ?? 0 }}
                </h2>
            </div>

            <div>
                <p class="text-sm text-[#666] uppercase tracking-wide mb-2">Poin Tersedia</p>
                <h2 class="text-3xl font-extrabold text-blue-600">
                    {{ $userPoints->available_points ?? 0 }}
                </h2>
            </div>

            <div>
                <p class="text-sm text-[#666] uppercase tracking-wide mb-2">Poin Digunakan</p>
                <h2 class="text-3xl font-extrabold text-orange-600">
                    {{ $userPoints->used_points ?? 0 }}
                </h2>
            </div>
        </div>
    </section>

    <!-- Redemptions List -->
    <section>
        @if ($redemptions->count() > 0)
            <div class="bg-white rounded-2xl border border-[#eae1da] overflow-hidden">

                <!-- Table Header -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#f6ece6] border-b border-[#eae1da]">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-bold text-[#003527]">Voucher</th>
                                <th class="px-6 py-4 text-center text-sm font-bold text-[#003527]">Kode Penukaran</th>
                                <th class="px-6 py-4 text-center text-sm font-bold text-[#003527]">Poin Digunakan</th>
                                <th class="px-6 py-4 text-center text-sm font-bold text-[#003527]">Status</th>
                                <th class="px-6 py-4 text-center text-sm font-bold text-[#003527]">Tanggal</th>
                                <th class="px-6 py-4 text-center text-sm font-bold text-[#003527]">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-[#eae1da]">
                            @foreach ($redemptions as $redemption)
                                <tr class="hover:bg-[#f6ece6] transition">
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-semibold text-[#003527]">{{ $redemption->voucher->title }}</p>
                                            <p class="text-xs text-[#666] mt-1">
                                                Diskon: 
                                                @if ($redemption->voucher->discount_type === 'percentage')
                                                    {{ $redemption->voucher->discount_value }}%
                                                @elseif ($redemption->voucher->discount_type === 'nominal')
                                                    Rp {{ number_format($redemption->voucher->discount_value, 0, ',', '.') }}
                                                @else
                                                    {{ $redemption->voucher->discount_value }} Item
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <code class="px-3 py-1 bg-[#f6ece6] rounded text-sm font-mono font-bold text-[#006c49]">
                                            {{ $redemption->redemption_code }}
                                        </code>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="font-bold text-[#006c49]">
                                            {{ $redemption->points_spent }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
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
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm text-[#666]">
                                        {{ $redemption->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('user.voucher.show', $redemption->voucher->id) }}"
                                           class="text-[#006c49] font-semibold hover:text-[#003527] text-sm">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-[#eae1da] bg-[#f6ece6]">
                    {{ $redemptions->links() }}
                </div>

            </div>
        @else
            <div class="text-center py-12 bg-white rounded-2xl border border-[#eae1da]">
                <span class="material-symbols-outlined text-5xl text-gray-300" style="display: inline-block;">card_giftcard</span>
                <p class="mt-4 text-gray-500">Anda belum menukar voucher apapun</p>
                <a href="{{ route('user.voucher.index') }}" class="mt-4 inline-block px-6 py-2 bg-[#006c49] text-white rounded-lg font-semibold hover:bg-[#003527]">
                    Tukar Voucher Sekarang
                </a>
            </div>
        @endif
    </section>

</div>

</body>
</html>
