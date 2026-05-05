<!DOCTYPE html>
<html>
<head>
    <title>Blog Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fff8f5]">

<div class="max-w-6xl mx-auto p-6">

    <a href="{{ route('pendonasi.blog.create') }}" 
       class="bg-green-700 text-white px-4 py-2 rounded">
        + Buat Blog
    </a>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 mt-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Jika tidak ada blog --}}
    @if($blogs->isEmpty())
        <p class="mt-4 text-gray-500">Belum ada blog.</p>
    @endif

    @foreach($blogs as $blog)
    <div class="bg-white p-4 mt-4 rounded shadow">

        <h2 class="text-xl font-bold">{{ $blog->title }}</h2>

        {{-- Batasi isi konten --}}
        <p class="mt-2 text-gray-700">
            {{ \Illuminate\Support\Str::limit($blog->content, 100) }}
        </p>

        {{-- Status (hindari error kalau null) --}}
        <p class="mt-2 text-sm text-gray-500">
            Status: {{ $blog->status ?? 'Tidak ada' }}
        </p>

        {{-- Tombol --}}
        <div class="mt-3 flex gap-3">

            <a href="{{ route('pendonasi.blog.edit', $blog->id) }}" 
               class="text-blue-600 hover:underline">
                Edit
            </a>

            <form action="{{ route('pendonasi.blog.delete', $blog->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Yakin hapus blog ini?')" 
                        class="text-red-600 hover:underline">
                    Delete
                </button>
            </form>

        </div>

    </div>
    @endforeach

</div>
</body>
</html>