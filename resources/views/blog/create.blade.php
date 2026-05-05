<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">

    <h1 class="text-2xl font-bold mb-6">Create Blog</h1>

    <form action="{{ route('blog.store') }}" method="POST">
        @csrf

        {{-- TITLE --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Title</label>
            <input 
                type="text" 
                name="title"
                class="w-full border p-3 rounded"
                placeholder="Enter title..."
                required
            >
        </div>

        {{-- CONTENT --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Content</label>

            <textarea 
                name="content"
                rows="10"
                class="w-full border p-3 rounded"
                placeholder="Write your blog..."
                required
            ></textarea>
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('blog.index') }}" 
               class="px-4 py-2 bg-gray-300 rounded">
                Cancel
            </a>

            <button 
                type="submit"
                class="px-6 py-2 bg-green-600 text-white rounded">
                Save
            </button>
        </div>

    </form>

</div>

</body>
</html>