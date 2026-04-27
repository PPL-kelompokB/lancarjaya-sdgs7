<!DOCTYPE html>
<html>
<head>
    <title>Blog Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONT AWESOME -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-50">

<div class="max-w-3xl mx-auto p-6">

    <a href="{{ route('user.explore') }}" 
        class="text-[#006c49] font-medium hover:underline">
        ← Back to Explore
    </a>

    <div class="bg-white p-6 mt-4 rounded-xl shadow">

        <h1 class="text-2xl font-bold">{{ $blog->title }}</h1>

        <p class="text-sm text-gray-500 mt-2">
            by {{ $blog->user->name }}
        </p>

        @if($blog->image)
            <img src="{{ asset('storage/'.$blog->image) }}" class="mt-4 rounded-lg">
        @endif

        <p class="mt-4 text-gray-700">
            {{ $blog->content }}
        </p>

        <!-- BUTTON LIKE -->
        <div class="flex items-center gap-6 mt-5">

            <!-- LIKE -->
            <form action="{{ route('blog.like', $blog->id) }}"
                  method="POST">
                @csrf

                <button type="submit"
                    class="text-3xl hover:scale-110 transition">

                    @if($liked)
                        <i class="fas fa-heart text-red-500"></i>
                    @else
                        <i class="far fa-heart text-gray-700"></i>
                    @endif

                </button>
            </form>

            <!-- COMMENT ICON -->
            <button onclick="toggleComment()"
                class="text-3xl hover:scale-110 transition text-gray-700">
                <i class="far fa-comment"></i>
            </button>

        </div>

        <div id="commentBox" class="hidden mt-8">

            <!-- LIST KOMENTAR -->
            <div>
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
            </div>

    <!-- FORM COMMENT -->
    <form action="{{ route('blog.comment', $blog->id) }}"
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

        <!-- COMMENT -->
        <!-- <form action="{{ route('blog.comment', $blog->id) }}"
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
        </form> -->


    </div>

</div>

<script>
function toggleComment() {
    document.getElementById('commentBox').classList.toggle('hidden');
}
</script>
</body>
</html>