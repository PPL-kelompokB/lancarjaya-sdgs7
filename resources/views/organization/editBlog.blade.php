<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog - EcoDon</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#003527",
                        secondary: "#006c49",
                        surface: "#fff8f5",
                        cream: "#f6ece6",
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-surface min-h-screen text-gray-800">

    <div class="min-h-screen px-4 py-10">
        <div class="max-w-5xl mx-auto">

            <div class="mb-6">
                <a href="{{ route('organization.dashboard') }}"
                   class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
                    ← Kembali ke Dashboard
                </a>
            </div>

            <div class="bg-white rounded-[2rem] shadow-xl overflow-hidden border border-gray-100">

                <div class="bg-gradient-to-r from-primary to-secondary px-8 py-8 text-white">
                    <p class="text-sm uppercase tracking-widest text-white/70 font-semibold">
                        EcoDon Organization
                    </p>
                    <h1 class="mt-2 text-3xl md:text-4xl font-extrabold">
                        Edit Blog
                    </h1>
                    <p class="mt-2 text-white/80 max-w-2xl">
                        Perbarui judul, gambar, dan isi blog organisasi kamu.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-5 gap-0">

                    <div class="lg:col-span-2 bg-cream/70 p-8 border-r border-gray-100">
                        <h2 class="text-lg font-bold text-primary mb-4">
                            Preview Gambar
                        </h2>

                        <div class="rounded-3xl overflow-hidden bg-white border border-gray-200 shadow-sm">
                            @if($blog->image)
                                <img
                                    id="imagePreview"
                                    src="{{ asset('storage/' . $blog->image) }}"
                                    class="w-full h-72 object-cover"
                                    alt="{{ $blog->title }}"
                                >
                            @else
                                <div id="emptyPreview" class="h-72 flex flex-col items-center justify-center text-gray-400">
                                    <div class="text-5xl mb-3">🖼️</div>
                                    <p class="font-semibold">Belum ada gambar</p>
                                </div>

                                <img
                                    id="imagePreview"
                                    class="hidden w-full h-72 object-cover"
                                    alt="Preview gambar"
                                >
                            @endif
                        </div>

                        <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                            Gunakan gambar horizontal agar card blog terlihat lebih rapi di dashboard.
                        </p>
                    </div>

                    <div class="lg:col-span-3 p-8">

                        @if ($errors->any())
                            <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 text-red-700 px-5 py-4">
                                <p class="font-bold mb-2">Ada error:</p>
                                <ul class="list-disc pl-5 space-y-1 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('organization.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block mb-2 font-bold text-primary">
                                    Judul Blog
                                </label>
                                <input
                                    type="text"
                                    name="title"
                                    value="{{ old('title', $blog->title) }}"
                                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                    placeholder="Masukkan judul blog..."
                                    required
                                >
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-primary">
                                    Ganti Gambar
                                </label>

                                <div class="rounded-2xl border-2 border-dashed border-gray-300 bg-cream/50 p-5">
                                    <input
                                        type="file"
                                        name="image"
                                        id="imageInput"
                                        accept="image/*"
                                        class="block w-full text-sm text-gray-700"
                                    >

                                    <p id="fileName" class="mt-2 text-xs text-gray-500">
                                        Kosongkan kalau tidak ingin mengganti gambar.
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-primary">
                                    Konten Blog
                                </label>
                                <textarea
                                    name="content"
                                    rows="12"
                                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                    placeholder="Tulis isi blog..."
                                    required
                                >{{ old('content', $blog->content) }}</textarea>
                            </div>

                            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                                <a href="{{ route('organization.dashboard') }}"
                                   class="px-6 py-3 bg-gray-200 text-gray-700 rounded-full font-bold text-center hover:bg-gray-300 transition">
                                    Batal
                                </a>

                                <button
                                    type="submit"
                                    class="px-8 py-3 bg-primary text-white rounded-full font-bold hover:bg-secondary transition shadow-lg">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const emptyPreview = document.getElementById('emptyPreview');
        const fileName = document.getElementById('fileName');

        imageInput.addEventListener('change', function () {
            const file = this.files[0];

            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.classList.remove('hidden');

                if (emptyPreview) {
                    emptyPreview.classList.add('hidden');
                }

                fileName.textContent = file.name;
            } else {
                fileName.textContent = 'Kosongkan kalau tidak ingin mengganti gambar.';
            }
        });
    </script>

</body>
</html>