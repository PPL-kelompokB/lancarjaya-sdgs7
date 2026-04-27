<!DOCTYPE html>
<html>
<head>
    <title>Volunteer Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-50">

<div class="max-w-4xl mx-auto p-6">

    <a href="{{ url('/user/explore') }}"
       class="text-[#006c49] font-medium hover:underline">
        ← Back To Explore
    </a>

    <div class="bg-white rounded-2xl shadow mt-4 p-6">

        <h1 class="text-3xl font-bold">{{ $volunteer->title }}</h1>

        <p class="text-sm text-gray-500 mt-2">
            by {{ $volunteer->organization->name ?? 'Organization' }}
        </p>

        @if($volunteer->image)
            <img src="{{ asset('storage/'.$volunteer->image) }}"
                 class="mt-4 rounded-lg">
        @endif

        <div class="mt-6 text-gray-700">
            {{ $volunteer->description }}
        </div>

        <!-- LIKE + COMMENT -->
        <div class="flex items-center gap-6 mt-6">

            <!-- LIKE -->
            <form action="{{ route('volunteer.like', $volunteer->id) }}"
                  method="POST">
                @csrf

                <button type="submit"
                    class="text-3xl hover:scale-110 transition">

                    @if($liked)
                        <i class="fas fa-heart text-red-600"></i>
                    @else
                        <i class="far fa-heart text-gray-700"></i>
                    @endif

                </button>
            </form>

            <!-- COMMENT -->
            <button onclick="toggleComment()"
                class="text-3xl hover:scale-110 transition text-gray-700">

                <i class="far fa-comment"></i>
            </button>

        </div>

        <!-- COMMENT BOX -->
        <div id="commentBox" class="hidden mt-8">

            <h3 class="font-bold text-lg mb-4">Comments</h3>

            @forelse($comments as $c)
                <div class="border-b py-3">
                    <p class="font-semibold text-sm text-gray-800">
                        {{ $c->user->name }}
                    </p>

                    <p class="text-gray-700 mt-1">
                        {{ $c->comment }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500">No comments yet</p>
            @endforelse

            <!-- FORM COMMENT -->
            <form action="{{ route('volunteer.comment', $volunteer->id) }}"
                  method="POST"
                  class="mt-6">
                @csrf

                <textarea
                    name="comment"
                    rows="3"
                    placeholder="Write comment..."
                    class="w-full border border-[#eae1da] rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-[#006c49]"
                    required></textarea>

                <button
                    class="mt-3 bg-[#006c49] text-white px-5 py-2 rounded-xl hover:bg-[#00553a] transition">
                    Post Comment
                </button>
            </form>

        </div>

    </div>

</div>

<script>
function toggleComment() {
    document.getElementById('commentBox').classList.toggle('hidden');
}
</script>

</body>
</html>