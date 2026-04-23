<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#fff8f5] font-sans text-[#1f1b17]">

<div class="max-w-6xl mx-auto px-6 py-10">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10">

        <div>
            <h1 class="text-4xl font-extrabold text-[#003527] tracking-tight">
                Blog Saya
            </h1>
            <p class="text-[#404944] mt-1">
                Kelola dan bagikan artikel kamu di EcoDon
            </p>
        </div>

        <a href="{{ route('user.blog.create') }}"
           class="bg-gradient-to-r from-[#006c49] to-[#003527] hover:opacity-90 text-white px-6 py-3 rounded-full shadow-md font-semibold transition">
            + Buat Blog
        </a>

    </div>

    <!-- GRID BLOG -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        @foreach ($blogs as $blog)

        <div class="bg-[#fcf2eb] border border-[#eae1da] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 group">

            <!-- IMAGE -->
            @if($blog->image)
            <div class="overflow-hidden">
                <img src="{{ asset('storage/' . $blog->image) }}"
                     class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
            </div>
            @endif

            <!-- CONTENT -->
            <div class="p-6">

                <!-- TITLE -->
                <h2 class="text-xl font-bold text-[#003527] group-hover:text-[#006c49] transition">
                    {{ $blog->title }}
                </h2>

                <!-- TEXT -->
                <p class="text-[#404944] mt-3 leading-relaxed text-sm">
                    {{ Str::limit($blog->content, 120) }}
                </p>

                <!-- ACTION -->
                <div class="flex items-center justify-between mt-6">

                    <div class="flex gap-4 text-sm">

                        <a href="{{ route('user.blog.edit', $blog->id) }}"
                           class="text-[#006c49] font-semibold hover:underline">
                            Edit
                        </a>

                        <form action="{{ route('user.blog.delete', $blog->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-500 font-semibold hover:underline">
                                Delete
                            </button>
                        </form>

                    </div>

                    <span class="text-xs text-[#707974]">
                        EcoDon Blog
                    </span>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

</body>
</html>