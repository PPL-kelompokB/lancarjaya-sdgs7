<!DOCTYPE html>
<html>
<head>
    <title>Edit Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded">

    <h1 class="text-2xl font-bold mb-6">Edit Blog</h1>

    <form action="{{ route('blog.update', $blog->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="title"
            value="{{ $blog->title }}"
            class="w-full border p-3 mb-4"
        >

        <textarea name="content"
            class="w-full border p-3 mb-4"
            rows="8"
        >{{ $blog->content }}</textarea>

        <button class="bg-green-600 text-white px-6 py-2 rounded">
            Update
        </button>

    </form>

</div>

</body>
</html>