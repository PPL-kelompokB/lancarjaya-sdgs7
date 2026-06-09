<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $donation->title }} - EcoDon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

@php
    $org = $donation->organization;
    $orgName = $org->organization_name ?? 'Organization';
    $orgImage = $org->profile_image ?? null;
    $orgInitial = strtoupper(substr($orgName, 0, 1));

    // Progress Calculation
    $target = $donation->quantity ?? 0;

    $current = $donation->submissions()
        ->whereIn('status', [
            'approved',
            'completed'
        ])
        ->sum('quantity');

    $percentage = $target > 0
        ? min(($current / $target) * 100, 100)
        : 0;

    $percentage = $target > 0
        ? min(($current / $target) * 100, 100)
        : 0;
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
        @if($donation->image)
            <img src="{{ asset('storage/' . $donation->image) }}"
                 class="w-full max-h-[420px] object-cover">
        @endif

        <div class="p-6 md:p-8">

            <!-- BADGE -->
            <span class="inline-flex px-3 py-1 rounded-full bg-[#e6f5ef] text-[#006c49] text-xs font-bold uppercase">
                Donation
            </span>

            <!-- TITLE -->
            <h1 class="text-3xl md:text-4xl font-extrabold text-[#003527] mt-4">
                {{ $donation->title }}
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
                        {{ $donation->created_at->format('d M Y') }}
                    </p>
                </div>
            </a>

            <!-- DESCRIPTION -->
            <p class="mt-6 text-[#404944] leading-relaxed whitespace-pre-line">
                {{ $donation->description }}
            </p>

            <!-- PROGRESS SECTION -->
            <div class="mt-8 bg-[#f6ece6] rounded-3xl p-6">

                <div class="flex justify-between items-center mb-3">
                    <div>
                        <p class="text-sm text-gray-500 font-semibold">
                            Donation Progress
                        </p>

                        <h2 class="text-3xl font-extrabold text-[#003527]">
                            {{ $current }} / {{ $target }}
                        </h2>
                    </div>

                    <div class="text-right">
                        <p class="text-sm text-gray-500">
                            Progress
                        </p>

                        <p class="text-2xl font-bold text-[#006c49]">
                            {{ round($percentage) }}%
                        </p>
                    </div>
                </div>

                <!-- PROGRESS BAR -->
                <div class="w-full bg-[#e5d8cf] rounded-full h-5 overflow-hidden">

                    <div
                        class="bg-[#006c49] h-full rounded-full transition-all duration-500"
                        style="width: {{ $percentage }}%">
                    </div>

                </div>

                <div class="mt-3 flex justify-between text-sm text-[#707974]">
                    <span>{{ $current }} donated</span>
                    <span>Target: {{ $target }}</span>
                </div>

            </div>

            <!-- EXTRA INFO -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-[#eae1da] pt-6">

                <!-- Donation Type -->
                <div class="bg-[#f6ece6] rounded-2xl p-4">
                    <p class="text-xs font-bold text-[#003527] uppercase tracking-wide mb-1">
                        🎁 Donation Type
                    </p>

                    <p class="text-lg font-semibold text-[#003527]">
                        {{ $donation->category ?? 'General Donation' }}
                    </p>
                </div>

                <!-- Deadline -->
                <div class="bg-[#f6ece6] rounded-2xl p-4">
                    <p class="text-xs font-bold text-[#003527] uppercase tracking-wide mb-1">
                        ⏰ Donation Deadline
                    </p>

                    <p class="text-lg font-semibold text-[#003527]">
                        {{ $donation->deadline
                            ? \Carbon\Carbon::parse($donation->deadline)->format('d M Y')
                            : '-' }}
                    </p>
                </div>

            </div>

            <!-- DONATE BUTTON -->
            <div class="mt-10 flex justify-center">

                <a href="{{ route('donation.form', $donation->id) }}"
                class="px-10 py-4 bg-[#006c49] hover:bg-[#003527]
                        text-white text-lg font-bold rounded-2xl
                        shadow-lg transition-all duration-300 hover:scale-105">

                    Donate Now

                </a>

            </div>

            <!-- LIKE & COMMENT -->
            <div class="mt-8 border-t border-[#eae1da] pt-5">

                <div class="flex items-center gap-5 text-sm text-[#707974]">

                    @auth
                        <form action="{{ route('like', ['donation', $donation->id]) }}" method="POST">
                            @csrf

                            <button class="hover:text-red-500 font-semibold">
                                ❤️ {{ $donation->likes()->count() }}
                            </button>
                        </form>
                    @else
                        <span>❤️ {{ $donation->likes()->count() }}</span>
                    @endauth

                    <span>💬 {{ $donation->comments()->count() }}</span>

                </div>

                <!-- COMMENTS -->
                <div class="mt-6">
                    <h2 class="text-xl font-bold text-[#003527] mb-4">
                        Comments
                    </h2>

                    @forelse($donation->comments()->with('user')->latest()->get() as $comment)

                        <div class="bg-[#fff8f5] border border-[#eae1da] rounded-2xl px-4 py-3 mb-3">

                            <div class="flex items-center gap-3 mb-2">

                                <div class="w-9 h-9 rounded-full bg-[#f6ece6]
                                            flex items-center justify-center overflow-hidden">

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
                    <form action="{{ route('comment', ['donation', $donation->id]) }}"
                          method="POST"
                          class="mt-6">

                        @csrf

                        <textarea
                            name="body"
                            rows="3"
                            placeholder="Tulis komentar..."
                            class="w-full rounded-2xl border border-[#eae1da]
                                   px-4 py-3 text-sm focus:ring-2 focus:ring-[#006c49]"
                            required
                        ></textarea>

                        <div class="flex justify-end mt-3">
                            <button class="px-6 py-2 bg-[#006c49]
                                           text-white rounded-full font-bold
                                           hover:bg-[#003527]">

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
