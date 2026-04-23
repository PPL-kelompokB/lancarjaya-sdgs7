<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Blog User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#fff8f5] font-sans text-[#1f1b17]">

<div class="max-w-3xl mx-auto px-6 py-12">

    <!-- CARD -->
    <div class="bg-[#fcf2eb] border border-[#eae1da] rounded-2xl shadow-sm p-8">

        <!-- HEADER -->
        <h1 class="text-3xl font-extrabold text-[#003527]">
            Buat Blog
        </h1>

        <p class="text-[#006c49] font-semibold mt-1 mb-6">
            Posting sebagai User
        </p>

        <!-- ERROR -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 p-4 mb-6 rounded-xl">
                @foreach ($errors->all() as $error)
                    <p class="text-sm">• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('user.blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- TITLE -->
            <div>
                <label class="text-sm font-semibold text-[#404944]">Judul</label>
                <input type="text" name="title"
                    placeholder="Masukkan judul blog..."
                    value="{{ old('title') }}"
                    class="w-full mt-2 p-3 rounded-xl border border-[#eae1da] bg-white focus:ring-2 focus:ring-[#006c49] outline-none">
            </div>

            <!-- CONTENT -->
            <div>
                <label class="text-sm font-semibold text-[#404944]">Isi Blog</label>
                <textarea name="content" rows="6"
                    placeholder="Tulis isi blog kamu..."
                    class="w-full mt-2 p-3 rounded-xl border border-[#eae1da] bg-white focus:ring-2 focus:ring-[#006c49] outline-none">{{ old('content') }}</textarea>
            </div>

            <!-- IMAGE -->
            <div>
                <label class="text-sm font-semibold text-[#404944]">Upload Gambar</label>
                <input type="file" name="image"
                    class="w-full mt-2 p-2 bg-white border border-[#eae1da] rounded-xl">
            </div>

            <!-- BUTTON -->
            <button class="w-full bg-gradient-to-r from-[#006c49] to-[#003527] text-white py-3 rounded-full font-semibold hover:opacity-90 transition">
                Publish Blog
            </button>

        </form>

    </div>

</div>

</body>
</html>