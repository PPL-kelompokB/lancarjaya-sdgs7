<!DOCTYPE html>
<html>
<head>
    <title>Create Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"></script>
</head>
<body class="bg-[#fff8f5]">

<div class="max-w-3xl mx-auto p-6 bg-white mt-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-4">Buat Blog</h1>

    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pendonasi.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- TITLE --}}
        <div class="mb-3">
            <input type="text" name="title" placeholder="Judul"
                   class="w-full border p-2 rounded"
                   value="{{ old('title') }}">
        </div>

        {{-- CONTENT --}}
        <div class="mb-3">
            <textarea id="editor" name="content">{{ old('content') }}</textarea>
        </div>

        {{-- IMAGE --}}
        <div class="mb-3">
            <input type="file" name="image" class="w-full">
        </div>

        {{-- CATEGORY --}}
        <div class="mb-3">
            <select name="category" class="w-full border p-2 rounded">
                <option value="">-- Pilih Kategori --</option>
                <option value="Sustainability">Sustainability</option>
                <option value="Community">Community</option>
            </select>
        </div>

        {{-- TAGS --}}
        <div class="mb-3">
            <input type="text" name="tags" placeholder="Tags (pisahkan dengan koma)"
                   class="w-full border p-2 rounded"
                   value="{{ old('tags') }}">
        </div>

        {{-- BUTTON --}}
        <div class="flex gap-3">
            <button type="submit" name="status" value="draft"
                    class="bg-gray-500 text-white px-4 py-2 rounded">
                Simpan Draft
            </button>

            <button type="submit" name="status" value="publish"
                    class="bg-green-600 text-white px-4 py-2 rounded">
                Publish
            </button>
        </div>

    </form>

</div>

<script>
tinymce.init({
    selector:'#editor',
    height: 300
});
</script>

</body>
</html>