<!DOCTYPE html>
<html lang="id">
<head>
<<<<<<< HEAD
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
=======
    <meta charset="UTF-8">
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315
    <title>Explore EcoDon</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .masonry { column-count: 1; column-gap: 24px; }
        @media(min-width:768px){ .masonry{ column-count:2; } }
        @media(min-width:1024px){ .masonry{ column-count:3; } }

        .item {
            break-inside: avoid;
            margin-bottom: 24px;
            transition: all .25s ease;
        }

        .item:hover { transform: translateY(-5px); }
    </style>
</head>

<body class="bg-[#fff8f5] text-[#1f1b17]">

<div class="max-w-7xl mx-auto px-6 py-10">

    <div class="mb-10 text-center">
        <h1 class="text-4xl font-bold text-[#003527]">Explore EcoDon</h1>
        <p class="text-[#404944] mt-2">Discover blog, donation, and volunteer activities</p>

        <form method="GET" action="{{ route('user.explore') }}" class="mt-6 flex justify-center">
            <div class="relative w-full max-w-xl">
                <span class="absolute left-4 top-3.5 text-[#707974]">🔍</span>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search title, author, organization..."
                    class="w-full pl-12 pr-24 py-3 rounded-full shadow border border-[#eae1da] bg-white focus:outline-none focus:ring-2 focus:ring-[#006c49]"
                >

                @if(request('search'))
                    <a href="{{ route('user.explore') }}"
                       class="absolute right-4 top-3 text-sm font-bold text-[#006c49]">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    @if($explore->isEmpty())
        <div class="max-w-xl mx-auto bg-white rounded-3xl p-8 text-center text-[#404944] border border-[#eae1da]">
            @if(request('search'))
                Tidak ada hasil untuk
                <span class="font-bold text-[#003527]">"{{ request('search') }}"</span>.

                <div class="mt-4">
                    <a href="{{ route('user.explore') }}"
                       class="inline-block px-5 py-2 rounded-full bg-[#006c49] text-white text-sm font-bold">
                        Kembali ke Explore
                    </a>
                </div>
            @else
                Belum ada konten yang ditemukan.
            @endif
        </div>
    @else
        <div class="masonry">
            @foreach($explore as $item)
                <div class="item bg-white rounded-3xl shadow border border-[#eae1da] overflow-hidden">

                    @if(!empty($item->image))
                        <a href="{{ url('/user/explore/' . $item->type . '/' . $item->id) }}">
                            <img src="{{ asset('storage/' . $item->image) }}"
                                 class="w-full h-56 object-cover"
                                 alt="{{ $item->title }}">
                        </a>
                    @endif

                    <div class="p-5">
                        <a href="{{ url('/user/explore/' . $item->type . '/' . $item->id) }}" class="block">
                            <span class="inline-flex px-3 py-1 rounded-full bg-[#e6f5ef] text-[#006c49] text-[11px] font-bold uppercase tracking-wider">
                                {{ $item->type }}
                            </span>

                            <h2 class="font-bold text-xl mt-3 text-[#003527] leading-snug">
                                {{ $item->title }}
                            </h2>

                            <p class="text-sm text-[#404944] mt-2 leading-relaxed">
                                {{ Str::limit($item->description ?? $item->content, 120) }}
                            </p>
                        </a>

<<<<<<< HEAD
                <p class="text-xs text-[#707974] mt-3">
                    by {{ $item->user->name ?? 'User' }}
                </p>
                <!-- LIKE COMMENT -->
                <div class="flex items-center gap-6 mt-4 text-sm text-[#707974]">

                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-heart text-red-700 text-lg"></i>
                        {{ $item->likes ?? 0 }}
                    </span>

                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-comment text-gray-500 text-lg"></i>
                        {{ $item->comments ?? 0 }}
                    </span>

                </div>
            </div>
        </a>
        @endif
=======
                        <div class="mt-5 flex items-center justify-between gap-3">
                            @if($item->author_type === 'organization')
                                <a href="{{ route('organization.public.profile', $item->organization_id) }}"
                                   class="flex items-center gap-3 min-w-0">

                                    <div class="w-11 h-11 rounded-full overflow-hidden bg-[#f6ece6] flex items-center justify-center shrink-0">
                                        @if(!empty($item->organization_profile_image))
                                            <img src="{{ asset('storage/' . $item->organization_profile_image) }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <span class="font-bold text-[#003527]">
                                                {{ strtoupper(substr($item->organization_name ?? 'O', 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315

                                    <p class="text-sm font-bold text-[#003527] truncate">
                                        {{ $item->organization_name ?? 'Organization' }}
                                    </p>
                                </a>

                                @auth
                                    @if(auth()->user()->organization?->id !== $item->organization_id)
                                        @if(auth()->user()->followedOrganizations->contains($item->organization_id))
                                            <form action="{{ route('organizations.unfollow', $item->organization_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="px-3 py-1 rounded-full bg-[#003527] text-white text-xs font-bold">
                                                    Following
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('organizations.follow', $item->organization_id) }}" method="POST">
                                                @csrf
                                                <button class="px-3 py-1 rounded-full bg-[#006c49] text-white text-xs font-bold">
                                                    Follow
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                @endauth

                            @elseif($item->author_type === 'user')
                                <a href="{{ route('user.public.profile', $item->user_id) }}"
                                   class="flex items-center gap-3 min-w-0">

                                    <div class="w-11 h-11 rounded-full overflow-hidden bg-[#f6ece6] flex items-center justify-center shrink-0">
                                        @if(!empty($item->user_profile_image))
                                            <img src="{{ asset('storage/' . $item->user_profile_image) }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <span class="font-bold text-[#003527]">
                                                {{ strtoupper(substr($item->user_name ?? 'U', 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>

                                    <p class="text-sm font-bold text-[#003527] truncate">
                                        {{ $item->user_name ?? 'User' }}
                                    </p>
                                </a>
                            @endif
                        </div>

<<<<<<< HEAD
                <div class="flex items-center gap-6 mt-4 text-sm text-[#707974]">

                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-heart text-red-700 text-lg"></i>
                        {{ $item->likes ?? 0 }}
                    </span>

                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-comment text-gray-500 text-lg"></i>
                        {{ $item->comments ?? 0 }}
                    </span>

                </div>

        </a>
        @endif

        <!-- VOLUNTEER -->
        @if($item->type == 'volunteer')
        <a href="{{ url('/user/explore/volunteer/'.$item->id) }}"
           class="item block bg-[#fcf2eb] rounded-2xl overflow-hidden shadow border border-[#eae1da]">

            @if(!empty($item->image))
                <img src="{{ asset('storage/'.$item->image) }}"
                     class="w-full h-52 object-cover">
            @endif

            <div class="p-5">

                <span class="text-xs font-bold text-[#006c49]">
                    VOLUNTEER
                </span>

                <h2 class="font-bold text-lg mt-2 text-[#003527]">
                    {{ $item->title }}
                </h2>

                <p class="text-sm text-[#404944] mt-2">
                    {{ Str::limit($item->description, 100) }}
                </p>

                <p class="text-xs text-[#707974] mt-3">
                    by {{ $item->organization->name ?? 'Organization' }}
                </p>

                <!-- LIKE COMMENT -->
                <div class="flex items-center gap-6 mt-4 text-sm text-[#707974]">

                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-heart text-red-700 text-lg"></i>
                        {{ $item->likes ?? 0 }}
                    </span>

                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-comment text-gray-500 text-lg"></i>
                        {{ $item->comments ?? 0 }}
                    </span>

                </div>

            </div>
        </a>
        @endif

        @endforeach

    </div>
=======
                        <div class="flex items-center gap-4 mt-4 text-sm text-[#707974] border-t border-[#eae1da] pt-4">
                            <form action="{{ route('like', [$item->type, $item->id]) }}" method="POST">
                                @csrf
                                <button type="submit">
                                    ❤️ {{ $item->likes_count ?? 0 }}
                                </button>
                            </form>

                            <span>💬 {{ $item->comments_count ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315

</div>

</body>
</html>