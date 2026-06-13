<!DOCTYPE html>
<html lang="id">

<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 4px;
    }

    .rating input {
        display: none;
    }

    .rating label {
        font-size: 2.5rem;
        color: #d1d5db;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    /* Hover */
    .rating label:hover,
    .rating label:hover ~ label {
        color: #fcd34d;
        transform: translateY(-2px);
    }

    /* Selected */
    .rating input:checked ~ label {
        color: #f59e0b;
        text-shadow: 0 0 8px rgba(245, 158, 11, 0.25);
    }

    /* Disabled */
    .rating.disabled label {
        cursor: not-allowed;
        opacity: 0.5;
    }
</style>

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rating Volunteer</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[#f1f3f4] min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-xl">

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">

            <!-- HEADER -->
            <div class="p-6 border-b border-gray-100">

                <div class="flex items-center gap-4">

                    <!-- ICON -->
                    <div class="w-14 h-14 rounded-full bg-[#006c49] flex items-center justify-center text-white text-2xl font-bold">

                        ⭐

                    </div>

                    <div>

                        <h1 class="text-2xl font-semibold text-gray-900">
                            Rating & Ulasan
                        </h1>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $volunteer->volunteerRequest->title ?? 'Volunteer' }}
                        </p>

                    </div>

                </div>

            </div>

            <!-- BODY -->
            <div class="p-6">

                @php
                    $canReview = $volunteer->status === 'done';
                @endphp

                <!-- WARNING -->
                @if(!$canReview)

                    <div class="mb-6 bg-yellow-50 border border-yellow-200 text-yellow-700 text-sm rounded-2xl p-4">

                        ⭐ Review hanya bisa diberikan setelah volunteer selesai
                        (status done)

                    </div>

                @endif

                <!-- SUCCESS -->
                @if(session('success'))

                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 text-sm rounded-2xl p-4">

                        {{ session('success') }}

                    </div>

                @endif

                <!-- ERROR -->
                @if ($errors->any())

                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl p-4">

                        <ul class="list-disc pl-5 space-y-1">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form
                    action="{{ route('user.volunteer.review.submit', $volunteer->id) }}"
                    method="POST"
                    class="space-y-8"
                >

                    @csrf

                    <!-- RATING -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-4">
                            Bagaimana pengalamanmu?
                        </label>

                        <div class="rating {{ !$canReview ? 'disabled' : '' }}">

                            @for($i = 5; $i >= 1; $i--)

                                <input
                                    type="radio"
                                    id="star{{ $i }}"
                                    name="rating"
                                    value="{{ $i }}"
                                    {{ old('rating', $existingReview->rating ?? '') == $i ? 'checked' : '' }}
                                    {{ !$canReview ? 'disabled' : '' }}
                                >

                                <label for="star{{ $i }}">
                                    ★
                                </label>

                            @endfor

                        </div>
                    </div>

                    <!-- REVIEW -->
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Bagikan pengalamanmu
                        </label>

                        <textarea
                            name="review"
                            rows="5"
                            placeholder="Ceritakan pengalaman volunteer kamu..."
                            class="w-full bg-[#f8f9fa] border border-gray-200 rounded-2xl p-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#006c49] focus:border-transparent resize-none disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed"
                            {{ !$canReview ? 'disabled' : '' }}
                        >{{ old('review', $existingReview->review ?? '') }}</textarea>

                    </div>

                    <!-- FOOTER -->
                    <div class="flex items-center justify-between pt-2">

                        <p class="text-sm text-gray-400">
                            Ulasanmu membantu volunteer lain ✨
                        </p>

                        <button
                            type="submit"
                            {{ !$canReview ? 'disabled' : '' }}
                            class="bg-[#006c49] hover:bg-[#00563a] text-white px-8 py-3 rounded-full font-medium transition duration-200 shadow-sm disabled:bg-gray-300 disabled:hover:bg-gray-300 disabled:cursor-not-allowed"
                        >

                            {{ $existingReview ? 'Update Ulasan' : 'Kirim Ulasan' }}

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>
