<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher Saya - EcoDon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1,h2,h3 { font-family: 'Manrope', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-[#fff8f5] text-[#1f1b17] min-h-screen">

<div class="max-w-3xl mx-auto px-4 py-10">

    <!-- Header -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('user.vouchers.index') }}" class="inline-flex items-center gap-1 text-sm text-[#006c49] font-semibold mb-3 hover:underline">
                <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Tukar Poin
            </a>
            <h1 class="text-3xl font-extrabold text-[#003527]">Voucher Saya</h1>
            <p class="text-sm text-[#666] mt-1">Riwayat penukaran poin dan voucher yang kamu miliki.</p>
        </div>

        <!-- Poin -->
        <div class="flex items-center gap-3 bg-gradient-to-br from-[#003527] to-[#006c49] text-white rounded-2xl px-6 py-4 shadow-lg min-w-[160px]">
            <span class="material-symbols-outlined text-3xl text-yellow-300">stars</span>
            <div>
                <p class="text-xs opacity-80 uppercase tracking-wide">Poin Kamu</p>
                <p class="text-2xl font-extrabold">{{ number_format($userPoints) }}</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    @if($myVouchers->isEmpty())
        <div class="bg-white rounded-3xl border border-[#eae1da] p-16 text-center shadow-sm">
            <span class="material-symbols-outlined text-6xl text-[#ccc]">confirmation_number</span>
            <h2 class="mt-4 text-xl font-bold text-[#003527]">Belum Ada Voucher</h2>
            <p class="text-sm text-[#999] mt-2">Tukar poin kamu untuk mendapatkan voucher.</p>
            <a href="{{ route('user.vouchers.index') }}"
               class="mt-5 inline-block px-6 py-2.5 rounded-full bg-[#003527] text-white text-sm font-bold hover:bg-[#006c49] transition">
                Tukar Poin Sekarang
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($myVouchers as $uv)
                @php $v = $uv->voucher; @endphp
                <div class="bg-white rounded-2xl border border-[#eae1da] shadow-sm overflow-hidden">
                    <div class="flex items-stretch">

                        <!-- Strip kiri -->
                        <div class="w-2 bg-gradient-to-b from-[#003527] to-[#006c49] flex-shrink-0"></div>

                        <!-- Gambar -->
                        <div class="flex-shrink-0 w-24 sm:w-32">
                            @if($v && $v->image)
                                <img src="{{ asset('storage/' . $v->image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full min-h-[96px] bg-[#e6f5ef] flex items-center justify-center">
                                    <span class="material-symbols-outlined text-3xl text-[#006c49]">confirmation_number</span>
                                </div>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="flex-1 p-4 sm:p-5">
                            <div class="flex flex-wrap items-start justify-between gap-3">
                                <div>
                                    <h3 class="font-bold text-[#1f1b17] text-base">
                                        {{ $v ? $v->title : 'Voucher Dihapus' }}
                                    </h3>
                                    @if($v && $v->description)
                                        <p class="text-xs text-[#888] mt-0.5 line-clamp-1">{{ $v->description }}</p>
                                    @endif
                                </div>

                                @if($v)
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                                        {{ $v->status === 'active' ? 'bg-green-100 text-green-700' :
                                           ($v->status === 'expired' ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-600') }}">
                                        {{ ucfirst($v->status) }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex flex-wrap gap-4 mt-3 text-xs text-[#888]">
                                @if($uv->code_used)
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">key</span>
                                        Kode: <code class="bg-[#f6ece6] px-2 py-0.5 rounded text-[#003527] font-bold ml-1">{{ $uv->code_used }}</code>
                                    </span>
                                @endif

                                @if($v)
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">stars</span>
                                        {{ number_format($v->points_cost) }} poin
                                    </span>
                                @endif

                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">schedule</span>
                                    Ditukar {{ $uv->redeemed_at ? $uv->redeemed_at->format('d M Y, H:i') : '-' }}
                                </span>

                                @if($v && $v->end_date)
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">event</span>
                                        Berlaku s.d. {{ \Carbon\Carbon::parse($v->end_date)->format('d M Y') }}
                                    </span>
                                @endif
                            </div>

                            @if($v)
                                <div class="mt-3 pt-3 border-t border-[#f0e8e2]">
                                    <p class="text-xs font-semibold text-[#003527]">
                                        @if($v->discount_type === 'percentage')
                                            Diskon {{ $v->discount_value }}%
                                        @elseif($v->discount_type === 'nominal')
                                            Diskon Rp {{ number_format($v->discount_value, 0, ',', '.') }}
                                        @else
                                            Diskon Item
                                        @endif
                                    </p>
                                </div>
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
