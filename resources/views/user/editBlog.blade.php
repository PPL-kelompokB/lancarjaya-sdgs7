<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#fff8f5] font-sans text-[#1f1b17]">

<div class="max-w-3xl mx-auto px-6 py-12">

    <!-- CARD -->
    <div class="bg-[#fcf2eb] border border-[#eae1da] rounded-2xl shadow-sm p-8">

        <!-- HEADER -->
        <h1 class="text-3xl font-extrabold text-[#003527]">
            Edit Blog
        </h1>

        <p class="text-[#006c49] font-semibold mt-1 mb-6">
            Perbarui konten blog kamu
        </p>

        <!-- FORM -->
        <form action="{{ route('user.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- TITLE -->
            <div>
                <label class="text-sm font-semibold text-[#404944]">Judul</label>
                <input type="text" name="title"
                    value="{{ $blog->title }}"
                    class="w-full mt-2 p-3 rounded-xl border border-[#eae1da] bg-white focus:ring-2 focus:ring-[#006c49] outline-none">
            </div>

            <!-- CONTENT -->
            <div>
                <label class="text-sm font-semibold text-[#404944]">Isi Blog</label>
                <textarea name="content" rows="6"
                    class="w-full mt-2 p-3 rounded-xl border border-[#eae1da] bg-white focus:ring-2 focus:ring-[#006c49] outline-none">{{ $blog->content }}</textarea>
            </div>

            <!-- CURRENT IMAGE -->
            @if($blog->image)
            <div>
                <label class="text-sm font-semibold text-[#404944]">Gambar Saat Ini</label>
                <img src="{{ asset('storage/' . $blog->image) }}"
                     class="w-40 h-32 object-cover mt-2 rounded-xl border border-[#eae1da]">
            </div>
            @endif

            <!-- NEW IMAGE -->
            <div>
                <label class="text-sm font-semibold text-[#404944]">Ganti Gambar</label>
                <input type="file" name="image"
                    class="w-full mt-2 p-2 bg-white border border-[#eae1da] rounded-xl">
            </div>

            <!-- BUTTON -->
            <button class="w-full bg-gradient-to-r from-[#006c49] to-[#003527] text-white py-3 rounded-full font-semibold hover:opacity-90 transition">
                Update Blog
            </button>

        </form>

    </div>

</div>

</body>
</html>