<!DOCTYPE html>
<html>
<head>
    <title>Explore EcoDon</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .masonry {
            column-count: 1;
            column-gap: 24px;
        }
        @media(min-width:768px){ .masonry{column-count:2;} }
        @media(min-width:1024px){ .masonry{column-count:3;} }

        .item {
            break-inside: avoid;
            margin-bottom: 24px;
            transition: all .3s ease;
        }

        .item:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="bg-[#fff8f5] text-[#1f1b17]">

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- HEADER -->
    <div class="mb-10 text-center">

        <h1 class="text-4xl font-bold text-[#003527]">
            Explore EcoDon
        </h1>

        <p class="text-[#404944] mt-2">
            Discover blog, donation, and volunteer activities
        </p>

        <!-- SEARCH -->
        <form method="GET" action="{{ url('/user/explore') }}" class="mt-6 flex justify-center">

            <div class="relative w-full max-w-xl">

                <span class="absolute left-4 top-3.5 text-[#707974]">
                    🔍
                </span>

                <input 
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search blog, donation, volunteer..."
                    class="w-full pl-12 pr-4 py-3 rounded-full shadow border border-[#eae1da] bg-[#fff8f5] focus:outline-none focus:ring-2 focus:ring-[#006c49]"
                >

            </div>

        </form>

    </div>

    <!-- GRID -->
    <div class="masonry">

        @foreach($explore as $item)

        <!-- BLOG -->
        @if($item->type == 'blog')
        <a href="{{ url('/user/explore/blog/'.$item->id) }}"
           class="item block bg-[#fcf2eb] rounded-2xl shadow border border-[#eae1da] overflow-hidden">

            @if($item->image)
                <img src="{{ asset('storage/'.$item->image) }}"
                     class="w-full h-52 object-cover">
            @endif

            <div class="p-5">

                <span class="text-xs font-bold text-[#006c49]">
                    BLOG
                </span>

                <h2 class="font-bold text-lg mt-1 text-[#003527]">
                    {{ $item->title }}
                </h2>

                <p class="text-sm text-[#404944] mt-2">
                    {{ Str::limit($item->content, 100) }}
                </p>

                <p class="text-xs text-[#707974] mt-3">
                    by {{ $item->user->name ?? 'User' }}
                </p>

            </div>
        </a>
        @endif

        <!-- DONATION -->
        @if($item->type == 'donation')
        <a href="{{ url('/user/explore/donation/'.$item->id) }}"
           class="item block bg-[#fcf2eb] rounded-2xl p-5 shadow border border-[#eae1da]">

            <span class="text-xs font-bold text-[#006c49]">
                DONATION
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

            </div>
        </a>
        @endif

        @endforeach

    </div>

</div>

</body>
</html>