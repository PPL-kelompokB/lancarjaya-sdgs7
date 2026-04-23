<!DOCTYPE html>
<html>
<head>
    <title>Blog Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="max-w-3xl mx-auto p-6">

    <a href="{{ route('user.explore') }}" class="text-blue-500">← Back to Explore</a>

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

    </div>

</div>

</body>
</html>