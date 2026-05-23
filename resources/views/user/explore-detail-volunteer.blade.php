<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $volunteer->title }} - EcoDon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

@php
    $org = $volunteer->organization;
    $orgName = $org->organization_name ?? 'Organization';
    $orgImage = $org->profile_image ?? null;
    $orgInitial = strtoupper(substr($orgName, 0, 1));
@endphp

<body class="bg-[#fff8f5] text-[#1f1b17]">

<div class="max-w-4xl mx-auto px-6 py-10">

    <!-- BACK -->
    <a href="{{ route('user.explore') }}"
       class="inline-flex mb-6 text-[#006c49] font-bold hover:underline">
        ← Back to Explore
    </a>

    <div class="bg-white rounded-3xl shadow border border-[#eae1da] overflow-hidden">

        <!-- IMAGE -->
        @if($volunteer->image)
            <img src="{{ asset('storage/' . $volunteer->image) }}"
                 class="w-full max-h-[420px] object-cover">
        @endif

        <div class="p-6 md:p-8">

            <!-- BADGE -->
            <span class="inline-flex px-3 py-1 rounded-full bg-[#e6f5ef] text-[#006c49] text-xs font-bold uppercase">
                Volunteer
            </span>

            <!-- TITLE -->
            <h1 class="text-3xl md:text-4xl font-extrabold text-[#003527] mt-4">
                {{ $volunteer->title }}
            </h1>

            <!-- AUTHOR -->
            <a href="{{ route('organization.public.profile', $org->id) }}"
               class="flex items-center gap-3 mt-5">

                <div class="w-12 h-12 rounded-full bg-[#f6ece6] flex items-center justify-center overflow-hidden border border-[#eae1da]">
                    @if($orgImage)
                        <img src="{{ asset('storage/' . $orgImage) }}"
                             class="w-full h-full object-cover">
                    @else
                        <span class="font-bold text-[#003527]">
                            {{ $orgInitial }}
                        </span>
                    @endif
                </div>

                <div>
                    <div class="flex items-center gap-1">
                        <p class="font-bold text-[#003527]">
                            {{ $orgName }}
                        </p>

                        @if($org && $org->verification_status === 'verified')
                            <span class="text-[#006c49] text-sm">✔</span>
                        @endif
                    </div>

                    <p class="text-xs text-gray-500">
                        {{ $volunteer->created_at->format('d M Y') }}
                    </p>
                </div>
            </a>

            <!-- DESCRIPTION -->
            <p class="mt-6 text-[#404944] leading-relaxed whitespace-pre-line">
                {{ $volunteer->description }}
            </p>

            <!-- DETAIL INFORMASI -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-[#eae1da] pt-6">

                <!-- Event Type -->
                <div class="bg-[#f6ece6] rounded-2xl p-4">
                    <p class="text-xs font-bold text-[#003527] uppercase tracking-wide mb-1">
                        📅 Tipe Event
                    </p>
                    <p class="text-lg font-semibold text-[#003527]">
                        @if($volunteer->event_type === 'online')
                            🌐 Online
                        @elseif($volunteer->event_type === 'offline')
                            📍 Offline
                        @else
                            🔀 Hybrid
                        @endif
                    </p>
                </div>

                <!-- Event Date -->
                <div class="bg-[#f6ece6] rounded-2xl p-4">
                    <p class="text-xs font-bold text-[#003527] uppercase tracking-wide mb-1">
                        📆 Tanggal Event
                    </p>
                    <p class="text-lg font-semibold text-[#003527]">
                        {{ $volunteer->event_date ? \Carbon\Carbon::parse($volunteer->event_date)->format('d M Y') : '-' }}
                    </p>
                </div>

                <!-- Deadline -->
                <div class="bg-[#f6ece6] rounded-2xl p-4">
                    <p class="text-xs font-bold text-[#003527] uppercase tracking-wide mb-1">
                        ⏰ Deadline Pendaftaran
                    </p>
                    <p class="text-lg font-semibold text-[#003527]">
                        {{ $volunteer->deadline ? \Carbon\Carbon::parse($volunteer->deadline)->format('d M Y') : '-' }}
                    </p>
                </div>

                <!-- Volunteer Quota -->
                <div class="bg-[#f6ece6] rounded-2xl p-4">
                    <p class="text-xs font-bold text-[#003527] uppercase tracking-wide mb-1">
                        👥 Kuota Volunteer
                    </p>
                    <p class="text-lg font-semibold text-[#003527]">
                        {{ $volunteer->volunteer_quota ?? 0 }} orang
                    </p>
                </div>

                <!-- Location -->
                @if($volunteer->location)
                <div class="bg-[#f6ece6] rounded-2xl p-4 md:col-span-2">
                    <p class="text-xs font-bold text-[#003527] uppercase tracking-wide mb-1">
                        📍 Lokasi
                    </p>
                    <p class="text-lg font-semibold text-[#003527]">
                        {{ $volunteer->location }}
                    </p>
                </div>
                @endif

                <!-- Required Skills -->
                @if($volunteer->required_skills)
                <div class="bg-[#f6ece6] rounded-2xl p-4 md:col-span-2">
                    <p class="text-xs font-bold text-[#003527] uppercase tracking-wide mb-2">
                        🎯 Keahlian yang Dibutuhkan
                    </p>
                    <p class="text-sm text-[#404944]">
                        {{ $volunteer->required_skills }}
                    </p>
                </div>
                @endif

            </div>

            <!-- TASK DESCRIPTION -->
            @if($volunteer->task_description)
            <div class="mt-6">
                <h2 class="text-xl font-bold text-[#003527] mb-3">
                    📋 Deskripsi Tugas
                </h2>
                <div class="bg-[#f6ece6] rounded-2xl p-4">
                    <p class="text-sm text-[#404944] leading-relaxed whitespace-pre-line">
                        {{ $volunteer->task_description }}
                    </p>
                </div>
            </div>
            @endif

            <!-- CATATAN TAMBAHAN -->
            @if($volunteer->notes)
            <div class="mt-6">
                <h2 class="text-xl font-bold text-[#003527] mb-3">
                    📝 Catatan Tambahan
                </h2>
                <div class="bg-[#f6ece6] rounded-2xl p-4">
                    <p class="text-sm text-[#404944] leading-relaxed whitespace-pre-line">
                        {{ $volunteer->notes }}
                    </p>
                </div>
            </div>
            @endif

            @php
                $hasApplied = false;

                if(auth()->check()) {
                    $hasApplied = $volunteer->registrations()->exists();
                }
            @endphp

            <div class="mt-10 flex justify-center">

                @if(session('success'))
                    <div class="fixed top-5 right-5 z-50 bg-[#006c49] text-white px-6 py-4 rounded-2xl shadow-2xl font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                @if($hasApplied)

                    <form action="{{ route('volunteer.cancel', $volunteer->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button
                            class="px-10 py-4 bg-red-500 hover:bg-red-600 text-white text-lg font-bold rounded-2xl shadow-lg transition-all duration-300 hover:scale-105"
                        >
                            Batalkan Pendaftaran
                        </button>
                    </form>

                @else

                    <a href="{{ route('volunteer.register', $volunteer->id) }}"
                    class="px-10 py-4 bg-[#006c49] hover:bg-[#003527] text-white text-lg font-bold rounded-2xl shadow-lg transition-all duration-300 hover:scale-105 inline-flex items-center gap-2">

                        Daftar Sebagai Volunteer

                    </a>

                @endif

            </div>

            <!-- LIKE & COMMENT -->
            <div class="mt-8 border-t border-[#eae1da] pt-5">

                <div class="flex items-center gap-5 text-sm text-[#707974]">
                    @auth
                        <form action="{{ route('like', ['volunteer', $volunteer->id]) }}" method="POST">
                            @csrf
                            <button class="hover:text-red-500 font-semibold">
                                ❤️ {{ $volunteer->likes()->count() }}
                            </button>
                        </form>
                    @else
                        <span>❤️ {{ $volunteer->likes()->count() }}</span>
                    @endauth

                    <span>💬 {{ $volunteer->comments()->count() }}</span>
                </div>

                <!-- COMMENT LIST -->
                <div class="mt-6">
                    <h2 class="text-xl font-bold text-[#003527] mb-4">
                        Comments
                    </h2>

                    @forelse($volunteer->comments()->with('user')->latest()->get() as $comment)
                        <div class="bg-[#fff8f5] border border-[#eae1da] rounded-2xl px-4 py-3 mb-3">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-9 h-9 rounded-full bg-[#f6ece6] flex items-center justify-center overflow-hidden">
                                    @if($comment->user->profile_image)
                                        <img src="{{ asset('storage/' . $comment->user->profile_image) }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <span class="text-sm font-bold text-[#003527]">
                                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    <p class="font-bold text-sm text-[#003527]">
                                        {{ $comment->user->name }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <p class="text-sm text-[#404944]">
                                {{ $comment->body }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">
                            Belum ada komentar.
                        </p>
                    @endforelse
                </div>

                <!-- COMMENT FORM -->
                @auth
                    <form action="{{ route('comment', ['volunteer', $volunteer->id]) }}" method="POST" class="mt-6">
                        @csrf

                        <textarea
                            name="body"
                            rows="3"
                            placeholder="Tulis komentar..."
                            class="w-full rounded-2xl border border-[#eae1da] px-4 py-3 text-sm focus:ring-2 focus:ring-[#006c49]"
                            required
                        ></textarea>

                        <div class="flex justify-end mt-3">
                            <button class="px-6 py-2 bg-[#006c49] text-white rounded-full font-bold hover:bg-[#003527]">
                                Kirim
                            </button>
                        </div>
                    </form>
                @else
                    <p class="mt-6 text-sm text-gray-500">
                        Login untuk komentar.
                    </p>
                @endauth

            </div>

        </div>
    </div>

</div>

</body>
</html>
