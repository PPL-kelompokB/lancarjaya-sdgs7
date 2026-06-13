<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Donasi - EcoDon</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1,h2,h3,h4 {
            font-family: 'Manrope', sans-serif;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#003527",
                        secondary: "#006c49",
                        surface: "#fff8f5",
                        cream: "#f6ece6",
                    }
                }
            }
        }
    </script>

</head>

<body class="bg-surface min-h-screen text-gray-800">

<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- SUCCESS ALERT --}}
    @if(session('success'))

        <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-2xl">

            {{ session('success') }}

        </div>

    @endif

    {{-- BACK --}}
    <div class="mb-6">

        <a href="{{ route('organization.dashboard') }}"
           class="inline-flex items-center gap-2 text-primary font-bold hover:underline">

            ← Kembali ke Dashboard

        </a>

    </div>

    {{-- HERO --}}
    <div class="bg-gradient-to-r from-primary to-secondary rounded-[2.5rem] p-8 lg:p-12 text-white shadow-2xl overflow-hidden relative">

        <div class="absolute right-0 top-0 opacity-10 text-[200px] font-black leading-none">
            ECO
        </div>

        <div class="relative z-10">

            <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-10">

                <div class="max-w-3xl">

                    <p class="uppercase tracking-[0.35em] text-sm text-white/70 font-bold">
                        Program Donasi
                    </p>

                    <h1 class="text-4xl lg:text-5xl font-black mt-4 leading-tight">
                        {{ $donation->title }}
                    </h1>

                    <p class="mt-5 text-white/80 leading-relaxed text-lg">
                        {{ $donation->description }}
                    </p>

                    <div class="flex flex-wrap gap-3 mt-8">

                        <span class="px-4 py-2 rounded-full bg-white/10 backdrop-blur text-sm font-bold">
                            {{ $donation->category }}
                        </span>

                        <span class="px-4 py-2 rounded-full bg-white/10 backdrop-blur text-sm font-bold">
                            {{ $donation->city }},
                            {{ $donation->province }}
                        </span>

                        <span class="px-4 py-2 rounded-full bg-white/10 backdrop-blur text-sm font-bold capitalize">
                            {{ $donation->status }}
                        </span>

                    </div>

                </div>

                {{-- STATS --}}
                <div class="grid grid-cols-2 gap-5 min-w-[320px]">

                    <div class="bg-white/10 backdrop-blur rounded-3xl p-6">

                        <p class="text-white/70 text-sm">
                            Target Donasi
                        </p>

                        <h2 class="text-3xl font-black mt-2">
                            {{ $donation->quantity }}
                        </h2>

                        <p class="text-white/70 mt-1">
                            {{ $donation->unit }}
                        </p>

                    </div>

                    <div class="bg-white/10 backdrop-blur rounded-3xl p-6">

                        <p class="text-white/70 text-sm">
                            Total Donatur
                        </p>

                        <h2 class="text-3xl font-black mt-2">
                            {{ $donation->submissions->count() }}
                        </h2>

                        <p class="text-white/70 mt-1">
                            Orang
                        </p>

                    </div>

                    <div class="bg-white/10 backdrop-blur rounded-3xl p-6">

                        <p class="text-white/70 text-sm">
                            Barang Dibutuhkan
                        </p>

                        <h2 class="text-2xl font-black mt-2">
                            {{ $donation->item_name }}
                        </h2>

                    </div>

                    <div class="bg-white/10 backdrop-blur rounded-3xl p-6">

                        <p class="text-white/70 text-sm">
                            Periode
                        </p>

                        <h2 class="text-lg font-bold mt-2">

                            {{ \Carbon\Carbon::parse($donation->start_date)->format('d M') }}
                            -
                            {{ \Carbon\Carbon::parse($donation->end_date)->format('d M Y') }}

                        </h2>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- DONATUR --}}
    <div class="mt-12">

        <div class="mb-8">

            <h2 class="text-3xl font-black text-primary">
                Donatur Yang Bergabung
            </h2>

            <p class="text-gray-500 mt-2">
                Daftar user yang sudah mendaftar untuk membantu program donasi ini.
            </p>

        </div>

        @forelse($donation->submissions as $submission)

            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-lg overflow-hidden mb-8 hover:shadow-2xl transition">

                <div class="p-8">

                    {{-- HEADER --}}
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                        <div class="flex items-center gap-5">

                            <div class="w-20 h-20 rounded-[1.5rem] bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white text-3xl font-black shadow-lg">

                                {{ strtoupper(substr($submission->user->name, 0, 1)) }}

                            </div>

                            <div>

                                <h3 class="text-2xl font-black text-gray-800">
                                    {{ $submission->user->name }}
                                </h3>

                                <p class="text-gray-500 mt-1">
                                    {{ $submission->phone_number }}
                                </p>

                                <p class="text-gray-400 text-sm mt-2">

                                    Pickup:
                                    {{ \Carbon\Carbon::parse($submission->pickup_date)->format('d M Y') }}

                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- STATUS FLOW --}}
                    <div class="mt-8">

                        <h4 class="font-black text-primary mb-4 text-lg">
                            Donation Status Flow
                        </h4>

                        <div class="flex flex-wrap gap-3 items-center">

                            <div class="px-4 py-2 rounded-full text-sm font-bold
                                {{ in_array($submission->status, ['pending','approved','pickup_on_the_way','picked_up','completed'])
                                    ? 'bg-yellow-100 text-yellow-700'
                                    : 'bg-gray-100 text-gray-400' }}">

                                Pending

                            </div>

                            <div class="px-4 py-2 rounded-full text-sm font-bold
                                {{ in_array($submission->status, ['approved','pickup_on_the_way','picked_up','completed'])
                                    ? 'bg-blue-100 text-blue-700'
                                    : 'bg-gray-100 text-gray-400' }}">

                                Approved

                            </div>

                            <div class="px-4 py-2 rounded-full text-sm font-bold
                                {{ in_array($submission->status, ['pickup_on_the_way','picked_up','completed'])
                                    ? 'bg-purple-100 text-purple-700'
                                    : 'bg-gray-100 text-gray-400' }}">

                                Pickup On The Way

                            </div>

                            <div class="px-4 py-2 rounded-full text-sm font-bold
                                {{ in_array($submission->status, ['picked_up','completed'])
                                    ? 'bg-orange-100 text-orange-700'
                                    : 'bg-gray-100 text-gray-400' }}">

                                Picked Up

                            </div>

                            <div class="px-4 py-2 rounded-full text-sm font-bold
                                {{ $submission->status == 'completed'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-100 text-gray-400' }}">

                                Completed

                            </div>

                            @if($submission->status == 'cancelled')

                                <div class="px-4 py-2 rounded-full text-sm font-bold bg-red-100 text-red-700">

                                    Rejected

                                </div>

                            @endif

                        </div>

                    </div>

                    {{-- REJECTION NOTE --}}
                    @if($submission->status == 'cancelled' && $submission->rejection_note)

                        <div class="mt-6 bg-red-50 border border-red-200 rounded-[2rem] p-6">

                            <h4 class="font-black text-red-700 mb-3">
                                Rejection Reason
                            </h4>

                            <p class="text-red-600 leading-relaxed">
                                {{ $submission->rejection_note }}
                            </p>

                        </div>

                    @endif

                    {{-- INFO GRID --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mt-10">

                        <div class="bg-[#f9f7f5] rounded-3xl p-5">

                            <p class="text-gray-400 text-sm font-bold">
                                Barang
                            </p>

                            <p class="font-black text-xl text-primary mt-2">
                                {{ $submission->item_name }}
                            </p>

                        </div>

                        <div class="bg-[#f9f7f5] rounded-3xl p-5">

                            <p class="text-gray-400 text-sm font-bold">
                                Jumlah
                            </p>

                            <p class="font-black text-xl text-primary mt-2">

                                {{ $submission->quantity }}
                                {{ $submission->unit }}

                            </p>

                        </div>

                        <div class="bg-[#f9f7f5] rounded-3xl p-5">

                            <p class="text-gray-400 text-sm font-bold">
                                Pickup Address
                            </p>

                            <p class="font-semibold text-gray-700 mt-2">
                                {{ $submission->pickup_address }}
                            </p>

                        </div>

                        <div class="bg-[#f9f7f5] rounded-3xl p-5">

                            <p class="text-gray-400 text-sm font-bold">
                                Catatan
                            </p>

                            <p class="font-semibold text-gray-700 mt-2">
                                {{ $submission->notes ?? '-' }}
                            </p>

                        </div>

                    </div>

                    {{-- IMAGE --}}
                    @if($submission->pickup_proof_image)

                        <div class="mt-8">

                            <p class="text-primary font-bold mb-4">
                                Bukti Barang
                            </p>

                            <img
                                src="{{ asset('storage/' . $submission->pickup_proof_image) }}"
                                class="w-full max-w-md rounded-3xl border border-gray-200 shadow-lg object-cover"
                            >

                        </div>

                    @endif

                    {{-- ACTION --}}
                    <div class="flex flex-wrap gap-4 mt-10">

                        <form action="{{ route('submission.updateStatus', $submission->id) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <input type="hidden" name="status" value="approved">

                            <button type="submit"
                                    class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-black transition">

                                Approve

                            </button>

                        </form>

                        <form action="{{ route('submission.updateStatus', $submission->id) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <input type="hidden" name="status" value="pickup_on_the_way">

                            <button type="submit"
                                    class="px-6 py-3 rounded-2xl bg-purple-600 hover:bg-purple-700 text-white font-black transition">

                                Pickup On The Way

                            </button>

                        </form>

                        <form action="{{ route('submission.updateStatus', $submission->id) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <input type="hidden" name="status" value="picked_up">

                            <button type="submit"
                                    class="px-6 py-3 rounded-2xl bg-orange-500 hover:bg-orange-600 text-white font-black transition">

                                Picked Up

                            </button>

                        </form>

                        <form action="{{ route('submission.updateStatus', $submission->id) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <input type="hidden" name="status" value="completed">

                            <button type="submit"
                                    class="px-6 py-3 rounded-2xl bg-green-600 hover:bg-green-700 text-white font-black transition">

                                Complete

                            </button>

                        </form>

                        @php
                            $wa = preg_replace(
                                '/^0/',
                                '62',
                                preg_replace('/[^0-9]/', '', $submission->phone_number)
                            );
                        @endphp

                        <a href="https://wa.me/{{ $wa }}"
                           target="_blank"
                           class="px-6 py-3 rounded-2xl bg-green-500 hover:bg-green-600 text-white font-black transition flex items-center gap-2">

                            💬 WhatsApp

                        </a>

                    </div>

                    {{-- REJECT FORM --}}
                    <form action="{{ route('submission.updateStatus', $submission->id) }}"
                          method="POST"
                          class="mt-6">

                        @csrf
                        @method('PUT')

                        <input type="hidden"
                               name="status"
                               value="cancelled">

                        <div class="bg-red-50 border border-red-200 rounded-[2rem] p-6">

                            <div class="flex items-center gap-3 mb-4">

                                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center">

                                    ❌

                                </div>

                                <div>

                                    <h3 class="font-black text-red-700">
                                        Reject Donation
                                    </h3>

                                    <p class="text-sm text-red-500">
                                        Berikan alasan kenapa donasi ditolak.
                                    </p>

                                </div>

                            </div>

                            <textarea
                                name="rejection_note"
                                rows="4"
                                placeholder="Contoh: Barang tidak sesuai kategori donasi..."
                                class="w-full rounded-2xl border border-red-200 px-5 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-red-300"
                                required
                            ></textarea>

                            <div class="flex justify-end mt-4">

                                <button type="submit"
                                        class="px-6 py-3 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-black transition">

                                    Reject Donation

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-[2rem] p-10 text-center border border-gray-200 shadow-sm">

                <div class="text-6xl mb-5">
                    📦
                </div>

                <h3 class="text-2xl font-black text-primary">
                    Belum Ada Donatur
                </h3>

                <p class="mt-3 text-gray-500">
                    Saat ini belum ada user yang mendaftar untuk program donasi ini.
                </p>

            </div>

        @endforelse

    </div>

</div>

</body>
</html>