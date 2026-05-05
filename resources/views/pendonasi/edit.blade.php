<!DOCTYPE html>
<html>
<head>
    <title>Edit Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"></script>
</head>
<body class="bg-[#fff8f5]">

<div class="max-w-3xl mx-auto p-6 bg-white mt-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-4">Edit Blog</h1>

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

    <form action="{{ route('pendonasi.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- TITLE --}}
        <div class="mb-3">
            <input type="text" name="title"
                   class="w-full border p-2 rounded"
                   value="{{ old('title', $blog->title) }}">
        </div>

        {{-- CONTENT --}}
        <div class="mb-3">
            <textarea id="editor" name="content">{{ old('content', $blog->content) }}</textarea>
        </div>

        {{-- IMAGE --}}
        <div class="mb-3">
            <input type="file" name="image" class="w-full">
            
            {{-- Preview gambar lama --}}
            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" 
                     class="mt-2 w-32 rounded">
            @endif
        </div>

        {{-- CATEGORY --}}
        <div class="mb-3">
            <select name="category" class="w-full border p-2 rounded">
                <option value="">-- Pilih Kategori --</option>
                <option value="Sustainability" 
                    {{ old('category', $blog->category) == 'Sustainability' ? 'selected' : '' }}>
                    Sustainability
                </option>
                <option value="Community" 
                    {{ old('category', $blog->category) == 'Community' ? 'selected' : '' }}>
                    Community
                </option>
            </select>
        </div>

        {{-- TAGS --}}
        <div class="mb-3">
            <input type="text" name="tags"
                   class="w-full border p-2 rounded"
                   value="{{ old('tags', $blog->tags) }}">
        </div>

        {{-- STATUS --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Status:</label>

            <select name="status" class="w-full border p-2 rounded">
                <option value="draft" 
                    {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>
                    Draft
                </option>
                <option value="publish" 
                    {{ old('status', $blog->status) == 'publish' ? 'selected' : '' }}>
                    Publish
                </option>
            </select>
        </div>

        {{-- BUTTON --}}
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded">
            Update Blog
        </button>

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