<!DOCTYPE html>
<html>
<head>
    <title>Detail Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded">

    <h1 class="text-3xl font-bold mb-4">
        {{ $blog->title }}
    </h1>

    <p class="text-gray-700">
        {{ $blog->content }}
    </p>

    <a href="{{ route('blog.index') }}" 
       class="mt-4 inline-block text-blue-500">
       ← Back
    </a>

</div>

</body>
</html>