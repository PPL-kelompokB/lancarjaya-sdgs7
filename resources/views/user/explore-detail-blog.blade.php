<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $blog->title }} - EcoDon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONT AWESOME -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<<<<<<< HEAD

<body class="bg-gray-50">
=======
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315

@php
    $org = $blog->user?->organization;
    $authorName = $org ? $org->organization_name : ($blog->user->name ?? 'User');
    $authorImage = $org ? $org->profile_image : ($blog->user->profile_image ?? null);
    $authorInitial = strtoupper(substr($authorName, 0, 1));
    $authorProfileRoute = $org
        ? route('organization.public.profile', $org->id)
        : route('user.public.profile', $blog->user->id);
@endphp

<<<<<<< HEAD
    <a href="{{ route('user.explore') }}" 
        class="text-[#006c49] font-medium hover:underline">
        ← Back to Explore
    </a>
=======
<body class="bg-[#fff8f5] text-[#1f1b17]">
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315

<div class="max-w-4xl mx-auto px-6 py-10">

    <a href="{{ route('user.explore') }}"
       class="inline-flex mb-6 text-[#006c49] font-bold hover:underline">
        ← Back to Explore
    </a>

    <div class="bg-white rounded-3xl shadow border border-[#eae1da] overflow-hidden">

        @if($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}"
                 class="w-full max-h-[420px] object-cover"
                 alt="{{ $blog->title }}">
        @endif

        <div class="p-6 md:p-8">

<<<<<<< HEAD
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


=======
            <span class="inline-flex px-3 py-1 rounded-full bg-[#e6f5ef] text-[#006c49] text-xs font-bold uppercase">
                Blog
            </span>

            <h1 class="text-3xl md:text-4xl font-extrabold text-[#003527] mt-4">
                {{ $blog->title }}
            </h1>

            <a href="{{ $authorProfileRoute }}" class="flex items-center gap-3 mt-5">
                <div class="w-12 h-12 rounded-full bg-[#f6ece6] flex items-center justify-center overflow-hidden border border-[#eae1da]">
                    @if(!empty($authorImage))
                        <img src="{{ asset('storage/' . $authorImage) }}"
                             class="w-full h-full object-cover"
                             alt="{{ $authorName }}">
                    @else
                        <span class="font-bold text-[#003527]">
                            {{ $authorInitial }}
                        </span>
                    @endif
                </div>

                <div>
                    <div class="flex items-center gap-1">
                        <p class="font-bold text-[#003527]">
                            {{ $authorName }}
                        </p>

                        @if($org && $org->verification_status === 'verified')
                            <span class="text-[#006c49] text-sm">✔</span>
                        @endif
                    </div>

                    <p class="text-xs text-gray-500">
                        {{ $blog->created_at->format('d M Y') }}
                    </p>
                </div>
            </a>

            <p class="mt-6 text-[#404944] leading-relaxed whitespace-pre-line">
                {{ $blog->content }}
            </p>

            <div class="mt-8 border-t border-[#eae1da] pt-5">

                <div class="flex items-center gap-5 text-sm text-[#707974]">
                    @auth
                        <form action="{{ route('like', ['blog', $blog->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="hover:text-red-500 transition font-semibold">
                                ❤️ {{ $blog->likes()->count() }}
                            </button>
                        </form>
                    @else
                        <span>❤️ {{ $blog->likes()->count() }}</span>
                    @endauth

                    <span>💬 {{ $blog->comments()->count() }}</span>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-bold text-[#003527] mb-4">
                        Comments
                    </h2>

                    @forelse($blog->comments()->with('user')->latest()->get() as $comment)
                        <div class="bg-[#fff8f5] border border-[#eae1da] rounded-2xl px-4 py-3 mb-3">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-9 h-9 rounded-full bg-[#f6ece6] flex items-center justify-center overflow-hidden">
                                    @if(!empty($comment->user->profile_image))
                                        <img src="{{ asset('storage/' . $comment->user->profile_image) }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <span class="text-sm font-bold text-[#003527]">
                                            {{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    <p class="font-bold text-sm text-[#003527]">
                                        {{ $comment->user->name ?? 'User' }}
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

                @auth
                    <form action="{{ route('comment', ['blog', $blog->id]) }}" method="POST" class="mt-6">
                        @csrf

                        <label class="block mb-2 font-bold text-[#003527]">
                            Tulis komentar
                        </label>

                        <textarea
                            name="body"
                            rows="3"
                            placeholder="Tulis komentar kamu..."
                            class="w-full rounded-2xl border border-[#eae1da] px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#006c49]"
                            required
                        ></textarea>

                        <div class="flex justify-end mt-3">
                            <button type="submit"
                                    class="px-6 py-2 rounded-full bg-[#006c49] text-white font-bold hover:bg-[#003527] transition">
                                Kirim Komentar
                            </button>
                        </div>
                    </form>
                @else
                    <p class="mt-6 text-sm text-gray-500">
                        Login dulu untuk like dan komentar.
                    </p>
                @endauth

            </div>

        </div>
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315
    </div>

</div>

<script>
function toggleComment() {
    document.getElementById('commentBox').classList.toggle('hidden');
}
</script>
</body>
</html>