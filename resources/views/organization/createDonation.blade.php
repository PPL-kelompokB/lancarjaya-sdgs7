<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Donation Program</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-6">Buat Program Donasi</h1>

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

    <form action="{{ route('organization.donation.store') }}" method="POST">
        @csrf

        <input type="hidden" name="organization_id" value="{{ $organization->id }}">

        {{-- Judul --}}
        <div class="mb-6">
            <label class="block mb-2 font-semibold">Judul Program</label>
            <input type="text" name="title" value="{{ old('title') }}"
                class="w-full border rounded-xl p-3"
                placeholder="Contoh: Donasi Buku untuk Anak Desa">
        </div>

        {{-- Deskripsi --}}
        <div class="mb-6">
            <label class="block mb-2 font-semibold">Deskripsi</label>
            <textarea name="description" rows="4"
                class="w-full border rounded-xl p-3"
                placeholder="Jelaskan program donasi...">{{ old('description') }}</textarea>
        </div>

        {{-- Barang & Kategori --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block mb-2 font-semibold">Nama Barang</label>
                <input type="text" name="item_name" value="{{ old('item_name') }}"
                    class="w-full border rounded-xl p-3"
                    placeholder="Contoh: Buku tulis">
            </div>

            <div>
                <label class="block mb-2 font-semibold">Kategori</label>
                <input type="text" name="category" value="{{ old('category') }}"
                    class="w-full border rounded-xl p-3"
                    placeholder="Contoh: Pendidikan">
            </div>
        </div>

        {{-- Jumlah --}}
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block mb-2 font-semibold">Jumlah</label>
                <input type="number" name="quantity" value="{{ old('quantity') }}"
                    class="w-full border rounded-xl p-3"
                    placeholder="Contoh: 100">
            </div>

            <div>
                <label class="block mb-2 font-semibold">Satuan</label>
                <input type="text" name="unit" value="{{ old('unit') }}"
                    class="w-full border rounded-xl p-3"
                    placeholder="Contoh: pcs / box">
            </div>
        </div>

        {{-- Lokasi --}}
        <div class="mb-6">
            <label class="block mb-2 font-semibold">Alamat</label>
            <input type="text" name="address" value="{{ old('address') }}"
                class="w-full border rounded-xl p-3"
                placeholder="Alamat lengkap">
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block mb-2 font-semibold">Kota</label>
                <input type="text" name="city" value="{{ old('city') }}"
                    class="w-full border rounded-xl p-3">
            </div>

            <div>
                <label class="block mb-2 font-semibold">Provinsi</label>
                <input type="text" name="province" value="{{ old('province') }}"
                    class="w-full border rounded-xl p-3">
            </div>
        </div>

        {{-- Kontak --}}
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block mb-2 font-semibold">Contact Person</label>
                <input type="text" name="contact_person" value="{{ old('contact_person') }}"
                    class="w-full border rounded-xl p-3">
            </div>

            <div>
                <label class="block mb-2 font-semibold">No HP</label>
                <input type="text" name="contact_phone" value="{{ old('contact_phone') }}"
                    class="w-full border rounded-xl p-3">
            </div>
        </div>

        {{-- Tanggal --}}
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block mb-2 font-semibold">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}"
                    class="w-full border rounded-xl p-3">
            </div>

            <div>
                <label class="block mb-2 font-semibold">Tanggal Selesai</label>
                <input type="date" name="end_date" value="{{ old('end_date') }}"
                    class="w-full border rounded-xl p-3">
            </div>
        </div>

        {{-- Action --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('organization.dashboard') }}"
               class="px-5 py-2 bg-gray-200 rounded-full font-semibold">
                Batal
            </a>

            <button type="submit"
                class="px-6 py-2 bg-primary text-white rounded-full hover:bg-green-800">
                Publish Program
            </button>
        </div>

    </form>
</div>

</body>
</html>