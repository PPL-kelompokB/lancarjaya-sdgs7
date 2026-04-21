<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-6">Create Blog</h1>

    {{-- Error --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('organization.blog.store') }}" method="POST">
    @csrf

    <input type="hidden" name="organization_id" value="{{ $organization->id }}">

    <div class="mb-6">
        <label class="block mb-2 font-semibold text-primary">Judul Blog</label>
        <input 
            type="text" 
            name="title"
            value="{{ old('title') }}"
            class="w-full border border-outline-variant rounded-xl p-3 bg-white"
            placeholder="Masukkan judul blog..."
        >
    </div>

    <div class="mb-6">
        <label class="block mb-2 font-semibold text-primary">Konten</label>
        <textarea 
            name="content"
            rows="10"
            class="w-full border border-outline-variant rounded-xl p-3 bg-white"
            placeholder="Tulis isi blog..."
        >{{ old('content') }}</textarea>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('organization.dashboard') }}"
           class="px-5 py-2 bg-gray-200 rounded-full font-semibold">
            Batal
        </a>

        <button 
            type="submit"
            class="px-6 py-2 bg-primary text-white rounded-full hover:bg-[#064e3b]"
        >
            Publish Blog
        </button>
    </div>
</form>
</div>

</body>
</html>