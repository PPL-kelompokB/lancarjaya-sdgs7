<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Kegiatan</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-[#006c49] to-[#009966] shadow-xl">

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div>
                    <h1 class="text-4xl font-extrabold text-white">
                        History Kegiatan
                    </h1>

                    <p class="text-green-100 mt-2 text-lg">
                        Riwayat volunteer dan donasi yang pernah kamu lakukan
                    </p>
                </div>

                <a href="{{ route('user.dashboard') }}"
                    class="bg-white text-[#006c49] font-semibold px-6 py-3 rounded-xl shadow hover:shadow-lg transition w-fit">

                    ← Kembali ke Dashboard

                </a>

            </div>

        </div>

    </div>


    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">

        <!-- VOLUNTEER HISTORY -->
        <section class="mb-12">

            <div class="flex items-center gap-4 mb-8">

                <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-2xl">
                    🌱
                </div>

                <div>
                    <h2 class="text-3xl font-bold text-slate-800">
                        Riwayat Volunteer
                    </h2>

                    <p class="text-slate-500">
                        Semua aktivitas volunteer yang pernah kamu ikuti
                    </p>
                </div>

            </div>

            @if($volunteers->isEmpty())

                <div class="bg-white rounded-2xl p-6 shadow text-gray-500">
                    Belum ada riwayat volunteer.
                </div>

            @else

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    @foreach($volunteers as $volunteer)
                <div
                class="bg-white rounded-3xl p-7 border border-slate-200
                shadow-sm hover:shadow-xl hover:-translate-y-1
                transition-all duration-300">

                            <!-- TOP -->
                            <div class="flex justify-between items-start mb-5">

                                <div>

                                    <!-- TITLE VOLUNTEER -->
                                    <h3 class="text-xl font-bold text-gray-800">

                                        {{ $volunteer->volunteerRequest->title ?? 'Volunteer Tidak Ditemukan' }}

                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $volunteer->email }}
                                    </p>

                                </div>

                                <!-- STATUS -->
                            <div>

                                @if($volunteer->status == 'in_review')

                                    <div class="inline-flex items-center gap-2 bg-yellow-50 text-yellow-700 border border-yellow-200 px-4 py-2 rounded-2xl shadow-sm">

                                        <div class="w-2.5 h-2.5 rounded-full bg-yellow-400 animate-pulse"></div>

                                        <span class="text-xs font-bold tracking-wide uppercase">
                                            In Review
                                        </span>

                                    </div>

                                @elseif($volunteer->status == 'accepted')

                                    <div class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-2 rounded-2xl shadow-sm">

                                        <div class="text-sm">
                                            ✅
                                        </div>

                                        <span class="text-xs font-bold tracking-wide uppercase">
                                            Accepted
                                        </span>

                                    </div>

                                @elseif($volunteer->status == 'rejected')

                                    <div class="inline-flex items-center gap-2 bg-red-50 text-red-700 border border-red-200 px-4 py-2 rounded-2xl shadow-sm">

                                        <div class="text-sm">
                                            ❌
                                        </div>

                                        <span class="text-xs font-bold tracking-wide uppercase">
                                            Rejected
                                        </span>

                                    </div>

                                @elseif($volunteer->status == 'done')

                                    <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 border border-blue-200 px-4 py-2 rounded-2xl shadow-sm">

                                        <div class="text-sm">
                                            🎉
                                        </div>

                                        <span class="text-xs font-bold tracking-wide uppercase">
                                            Completed
                                        </span>

                                    </div>

                                @endif

                            </div>

                            </div>

                            <!-- CONTENT -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">

                                <div>
                                    <p class="text-xs uppercase tracking-wide text-slate-400">
                                        Nama Volunteer
                                    </p>

                                    <p class="font-semibold text-slate-800 mt-1">
                                        {{ $volunteer->name }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs uppercase tracking-wide text-slate-400">
                                        Tanggal Daftar
                                    </p>

                                    <p class="font-semibold text-slate-800 mt-1">
                                        {{ $volunteer->created_at->format('d M Y') }}
                                    </p>
                                </div>

                                <div class="md:col-span-2">
                                    <p class="text-xs uppercase tracking-wide text-slate-400">
                                        CV
                                    </p>

                                    <a href="{{ asset('storage/' . $volunteer->cv_path) }}"
                                        target="_blank"
                                        class="text-[#006c49] font-semibold hover:underline">

                                        📄 Lihat CV
                                    </a>
                                </div>

                            </div>

                            <!-- NOTES -->
                            @if($volunteer->notes)

                                <div class="mt-5 bg-gray-100 rounded-xl p-4 border border-gray-200">

                                    <p class="font-bold text-gray-800 mb-2">
                                        Catatan Organisasi
                                    </p>

                                    <p class="text-sm text-gray-600 leading-relaxed">
                                        {{ $volunteer->notes }}
                                    </p>

                                </div>

                            @endif

                            @if($volunteer->review)

                                <div class="mt-5 bg-amber-50 border border-amber-200 rounded-xl p-4">

                                    <p class="text-sm font-semibold text-amber-700 mb-2">
                                        Rating Anda
                                    </p>

                                    <div class="flex items-center gap-1">

                                        @for($i = 1; $i <= 5; $i++)

                                            <span class="{{ $i <= $volunteer->review->rating ? 'text-amber-500' : 'text-gray-300' }}">
                                                ★
                                            </span>

                                        @endfor

                                        <span class="ml-2 text-sm text-gray-600">
                                            {{ $volunteer->review->rating }}/5
                                        </span>

                                    </div>

                                    @if($volunteer->review->review)

                                        <p class="mt-2 text-sm text-gray-700 italic">
                                            "{{ $volunteer->review->review }}"
                                        </p>

                                    @endif

                                </div>

                            @endif

                            <!-- BUTTON RATING -->
                            <div class="mt-5 flex gap-3">

                                @if($volunteer->status === 'done')

                                    <a href="{{ route('user.volunteer.review', $volunteer->id) }}"
                                    class="flex-1 text-center bg-[#006c49] hover:bg-[#004d35]
                                        text-white font-bold py-3 rounded-xl transition">

                                        {{ $volunteer->review ? 'Edit Rating & Ulasan' : 'Beri Rating & Ulasan' }}

                                    </a>

                                @endif

                                @if(in_array($volunteer->status, ['in_review', 'accepted']))

                                    <form action="{{ route('volunteer.cancel', $volunteer->volunteer_id) }}"
                                        method="POST"
                                        class="flex-1">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                onclick="return confirm('Yakin ingin membatalkan pendaftaran volunteer ini?')"
                                                class="w-full bg-red-600 hover:bg-red-700
                                                    text-white font-bold py-3 rounded-xl transition">

                                            Batalkan Pendaftaran

                                        </button>
                                    </form>

                                @endif

                            </div>
                        </div>

                    @endforeach

                </div>

            @endif

        </section>

        <!-- DONATION HISTORY -->
        <section>

            <div class="flex items-center gap-3 mb-6">

                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                    D
                </div>

                <h2 class="text-2xl font-bold text-blue-700">
                    Riwayat Donasi
                </h2>

            </div>

            @if($donations->isEmpty())

                <div class="bg-white rounded-2xl p-6 shadow text-gray-500">
                    Belum ada riwayat donasi.
                </div>

            @else

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    @foreach($donations as $donation)

                        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">

                            <div class="flex justify-between items-start mb-4">

                                <div>

                                    <h3 class="text-xl font-bold text-gray-800">
                                        {{ $donation->item_name }}
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        {{ $donation->quantity }} {{ $donation->unit }}
                                    </p>

                                </div>

                                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">
                                    Donasi
                                </span>

                            </div>

                            <div class="space-y-2 text-sm text-gray-600">

                                <p>

                                    <span class="font-semibold text-gray-800">
                                        Pickup Address:
                                    </span>

                                    {{ $donation->pickup_address }}

                                </p>

                                    <div>

                                        <p class="font-semibold text-gray-800 mb-2">
                                            Status:
                                        </p>

                                        @if($donation->status == 'pending')

                                            <div class="inline-flex items-center gap-2 bg-yellow-50 text-yellow-700 border border-yellow-200 px-4 py-2 rounded-2xl shadow-sm">
                                                <div class="w-2.5 h-2.5 rounded-full bg-yellow-400 animate-pulse"></div>
                                                <span class="text-xs font-bold tracking-wide uppercase">
                                                    Pending
                                                </span>
                                            </div>

                                        @elseif($donation->status == 'approved')

                                            <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 border border-blue-200 px-4 py-2 rounded-2xl shadow-sm">
                                                <div class="w-2.5 h-2.5 rounded-full bg-blue-400"></div>
                                                <span class="text-xs font-bold tracking-wide uppercase">
                                                    Approved
                                                </span>
                                            </div>

                                        @elseif($donation->status == 'pickup_on_the_way')

                                            <div class="inline-flex items-center gap-2 bg-purple-50 text-purple-700 border border-purple-200 px-4 py-2 rounded-2xl shadow-sm">
                                                <div class="w-2.5 h-2.5 rounded-full bg-purple-400"></div>
                                                <span class="text-xs font-bold tracking-wide uppercase">
                                                    Pickup On The Way
                                                </span>
                                            </div>

                                        @elseif($donation->status == 'picked_up')

                                            <div class="inline-flex items-center gap-2 bg-orange-50 text-orange-700 border border-orange-200 px-4 py-2 rounded-2xl shadow-sm">
                                                <div class="w-2.5 h-2.5 rounded-full bg-orange-400"></div>
                                                <span class="text-xs font-bold tracking-wide uppercase">
                                                    Picked Up
                                                </span>
                                            </div>

                                        @elseif($donation->status == 'completed')

                                            <div class="inline-flex items-center gap-2 bg-green-50 text-green-700 border border-green-200 px-4 py-2 rounded-2xl shadow-sm">
                                                <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                                                <span class="text-xs font-bold tracking-wide uppercase">
                                                    Completed
                                                </span>
                                            </div>

                                        @elseif($donation->status == 'cancelled')

                                            <div class="inline-flex items-center gap-2 bg-red-50 text-red-700 border border-red-200 px-4 py-2 rounded-2xl shadow-sm">
                                                <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                                                <span class="text-xs font-bold tracking-wide uppercase">
                                                    Rejected
                                                </span>
                                            </div>

                                        @endif

                                    </div>
                                <p>

                                    <span class="font-semibold text-gray-800">
                                        Tanggal:
                                    </span>

                                    {{ $donation->created_at->format('d M Y') }}

                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </section>

    </div>

</body>
</html>
