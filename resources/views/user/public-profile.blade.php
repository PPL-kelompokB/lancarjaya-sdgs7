<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil {{ $user->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#fff8f5]">

<div class="max-w-4xl mx-auto py-12 px-6">

    <div class="bg-white rounded-3xl shadow-lg p-8 text-center">

        <div class="w-28 h-28 mx-auto rounded-full overflow-hidden bg-gray-200 flex items-center justify-center">
            @if($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}"
                     class="w-full h-full object-cover"
                     alt="{{ $user->name }}">
            @else
                <span class="text-3xl font-bold text-[#003527]">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </span>
            @endif
        </div>

        <h2 class="mt-4 text-2xl font-bold text-[#003527]">
            {{ $user->name }}
        </h2>

        <p class="text-gray-500 mt-1">
            {{ $user->email }}
        </p>

        @if(!empty($user->bio))
            <p class="mt-4 text-[#404944]">
                {{ $user->bio }}
            </p>
        @endif

        <div class="mt-6">
            <a href="{{ route('user.explore') }}"
               class="px-5 py-2 bg-[#006c49] text-white rounded-full text-sm font-bold">
                ← Kembali ke Explore
            </a>
        </div>
    </div>

    <div class="mt-10">
        <h3 class="text-2xl font-bold text-[#003527] mb-5">
            Blog oleh {{ $user->name }}
        </h3>

        @forelse($blogs as $blog)
            <div class="bg-white rounded-2xl shadow-md p-6 mb-5">
                <h4 class="text-xl font-bold text-[#003527]">
                    {{ $blog->title }}
                </h4>

                @if(!empty($blog->created_at))
                    <p class="text-sm text-gray-400 mt-1">
                        {{ $blog->created_at->format('d M Y') }}
                    </p>
                @endif

                <p class="text-[#404944] mt-3">
                    {{ Str::limit(strip_tags($blog->content), 150) }}
                </p>

                <a href="{{ route('blogs.show', $blog->id) }}"
                   class="inline-block mt-4 text-sm font-bold text-[#006c49]">
                    Baca Selengkapnya →
                </a>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-md p-6 text-center text-gray-500">
                User ini belum memiliki blog.
            </div>
        @endforelse
    </div>

</div>

</body>
</html>