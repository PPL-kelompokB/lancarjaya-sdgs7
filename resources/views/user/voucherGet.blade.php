<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher Reward</title>


<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body{
        font-family: 'Inter', sans-serif;
    }
</style>

</head>

<body class="bg-slate-100 min-h-screen">

<!-- HEADER -->
<div class="bg-gradient-to-r from-[#006c49] to-[#009966] shadow-xl">

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">

        <div class="flex flex-col md:flex-row justify-between items-center gap-6">

            <div>
                <h1 class="text-4xl font-extrabold text-white">
                    Voucher Reward
                </h1>

                <p class="text-green-100 mt-2">
                    Tukarkan poin reward kamu dengan voucher menarik
                </p>
            </div>

            <a href="{{ url()->previous() }}"
                class="bg-white text-[#006c49] px-5 py-3 rounded-xl font-semibold shadow hover:shadow-lg transition">

                ← Kembali

            </a>

        </div>

    </div>

</div>

<!-- CONTENT -->
<div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">

    <!-- POINT CARD -->
    <div class="mb-10">

        <div class="bg-gradient-to-r from-amber-400 to-yellow-500 rounded-3xl p-8 shadow-xl text-white">

            <p class="uppercase tracking-wider text-sm font-semibold">
                Poin Reward Kamu
            </p>

            <h2 class="text-5xl font-extrabold mt-3">
                ⭐ {{ number_format($userPoints) }}
            </h2>

            <p class="mt-3 text-yellow-100">
                Kumpulkan poin dari aktivitas volunteer dan donasi
            </p>

        </div>

    </div>

    <!-- TITLE -->
    <div class="mb-8">

        <h2 class="text-3xl font-bold text-slate-800">
            Voucher Tersedia
        </h2>

        <p class="text-slate-500 mt-2">
            Pilih voucher yang ingin kamu tukarkan menggunakan poin reward
        </p>

    </div>

    <!-- LIST -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($vouchers as $voucher)

            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200">

                <!-- IMAGE -->
                @if($voucher->image)

                    <img
                        src="{{ asset('storage/' . $voucher->image) }}"
                        alt="{{ $voucher->title }}"
                        class="w-full h-52 object-cover">

                @else

                    <div class="h-52 bg-slate-200 flex items-center justify-center text-5xl">
                        🎁
                    </div>

                @endif

                <!-- BODY -->
                <div class="p-6">

                    <div class="flex justify-between items-start gap-3">

                        <h3 class="text-xl font-bold text-slate-800">
                            {{ $voucher->title }}
                        </h3>

                        <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap">

                            {{ number_format($voucher->points_cost) }} Poin

                        </span>

                    </div>

                    <p class="text-slate-500 mt-3 text-sm leading-relaxed">

                        {{ $voucher->description }}

                    </p>

                    <!-- INFO -->
                    <div class="mt-5 space-y-3 text-sm">

                        <div class="flex justify-between">

                            <span class="text-slate-500">
                                Kode Voucher
                            </span>

                            <span class="font-semibold">
                                {{ $voucher->code }}
                            </span>

                        </div>

                        <div class="flex justify-between">

                            <span class="text-slate-500">
                                Kuota Tersisa
                            </span>

                            <span class="font-semibold">
                                {{ $voucher->quota - $voucher->used_count }}
                            </span>

                        </div>

                        <div class="flex justify-between">

                            <span class="text-slate-500">
                                Berlaku Sampai
                            </span>

                            <span class="font-semibold">
                                {{ \Carbon\Carbon::parse($voucher->end_date)->format('d M Y') }}
                            </span>

                        </div>

                    </div>

                    <!-- POINT STATUS -->
                    @if($userPoints < $voucher->points_cost)

                        <div class="mt-5 bg-red-50 border border-red-200 rounded-xl p-3">

                            <p class="text-red-600 text-sm font-medium">

                                Kurang
                                {{ number_format($voucher->points_cost - $userPoints) }}
                                poin lagi

                            </p>

                        </div>

                    @endif

                    <!-- BUTTON -->
                    <div class="mt-6">

                        @if($userPoints >= $voucher->points_cost)

                            <form
                                action="{{ route('user.voucher.redeem', $voucher->id) }}"
                                method="POST">

                                @csrf

                                <button
                                    type="submit"
                                    class="w-full bg-[#006c49] hover:bg-[#004d35]
                                    text-white font-semibold py-3 rounded-xl transition">

                                    Tukar Voucher

                                </button>

                            </form>

                        @else

                            <button
                                disabled
                                class="w-full bg-slate-300 text-slate-500
                                font-semibold py-3 rounded-xl cursor-not-allowed">

                                Poin Tidak Cukup

                            </button>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full">

                <div class="bg-white rounded-3xl p-12 text-center shadow-sm">

                    <div class="text-6xl mb-4">
                        🎁
                    </div>

                    <h3 class="text-2xl font-bold text-slate-700">
                        Belum Ada Voucher
                    </h3>

                    <p class="text-slate-500 mt-2">
                        Voucher reward belum tersedia saat ini.
                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>

</body>
</html>
