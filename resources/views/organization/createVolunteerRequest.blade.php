<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Volunteer Request</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-6">Create Volunteer Request</h1>

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

    <form action="{{ route('organization.volunteer-request.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="organization_id" value="{{ $organization->id }}">

        {{-- Judul Kegiatan --}}
        <div class="mb-6">
            <label class="block mb-2 font-semibold text-primary">Judul Kegiatan</label>
            <input 
                type="text" 
                name="title"
                value="{{ old('title') }}"
                class="w-full border border-outline-variant rounded-xl p-3 bg-white"
                placeholder="Contoh: Bakti Sosial Pendidikan Desa"
            >
        </div>

        {{-- Deskripsi Kegiatan --}}
        <div class="mb-6">
            <label class="block mb-2 font-semibold text-primary">Deskripsi Kegiatan</label>
            <textarea 
                name="description"
                rows="5"
                class="w-full border border-outline-variant rounded-xl p-3 bg-white"
                placeholder="Jelaskan gambaran umum kegiatan volunteer..."
            >{{ old('description') }}</textarea>
        </div>

        {{-- Upload Gambar --}}
        <div class="mb-6">
            <label class="block mb-2 font-semibold text-primary">Gambar Kegiatan</label>

            <input 
                type="file" 
                name="image"
                accept="image/*"
                class="w-full border border-outline-variant rounded-xl p-3 bg-white"
            >

            <p class="text-sm text-gray-500 mt-1">
                Format: JPG, PNG, maksimal 2MB
            </p>
        </div>

        {{-- Deskripsi Tugas --}}
        <div class="mb-6">
            <label class="block mb-2 font-semibold text-primary">Deskripsi Tugas Volunteer</label>
            <textarea 
                name="task_description"
                rows="5"
                class="w-full border border-outline-variant rounded-xl p-3 bg-white"
                placeholder="Contoh: membantu registrasi peserta, dokumentasi, distribusi logistik, dll."
            >{{ old('task_description') }}</textarea>
        </div>

        {{-- Keahlian yang Dibutuhkan --}}
        <div class="mb-6">
            <label class="block mb-2 font-semibold text-primary">Keahlian yang Dibutuhkan</label>
            <input 
                type="text" 
                name="required_skills"
                value="{{ old('required_skills') }}"
                class="w-full border border-outline-variant rounded-xl p-3 bg-white"
                placeholder="Contoh: komunikasi, desain, public speaking, dokumentasi"
            >
            <p class="text-sm text-gray-500 mt-1">
                Pisahkan dengan koma jika lebih dari satu.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            {{-- Jumlah Volunteer --}}
            <div>
                <label class="block mb-2 font-semibold text-primary">Jumlah Volunteer Dibutuhkan</label>
                <input 
                    type="number" 
                    name="volunteer_quota"
                    value="{{ old('volunteer_quota') }}"
                    min="1"
                    class="w-full border border-outline-variant rounded-xl p-3 bg-white"
                    placeholder="Contoh: 10"
                >
            </div>

            {{-- Batas Waktu Pendaftaran --}}
            <div>
                <label class="block mb-2 font-semibold text-primary">Batas Waktu Pendaftaran</label>
                <input 
                    type="date" 
                    name="deadline"
                    value="{{ old('deadline') }}"
                    class="w-full border border-outline-variant rounded-xl p-3 bg-white"
                >
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            {{-- Tanggal Kegiatan --}}
            <div>
                <label class="block mb-2 font-semibold text-primary">Tanggal Kegiatan</label>
                <input 
                    type="date" 
                    name="event_date"
                    value="{{ old('event_date') }}"
                    class="w-full border border-outline-variant rounded-xl p-3 bg-white"
                >
            </div>

            {{-- Tipe Kegiatan --}}
            <div>
                <label class="block mb-2 font-semibold text-primary">Tipe Kegiatan</label>
                <select 
                    name="event_type"
                    class="w-full border border-outline-variant rounded-xl p-3 bg-white"
                >
                    <option value="">Pilih tipe kegiatan</option>
                    <option value="online" {{ old('event_type') == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="offline" {{ old('event_type') == 'offline' ? 'selected' : '' }}>Offline</option>
                    <option value="hybrid" {{ old('event_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                </select>
            </div>
        </div>

        {{-- Lokasi --}}
        <div class="mb-6">
            <label class="block mb-2 font-semibold text-primary">Lokasi Kegiatan</label>
            <input 
                type="text" 
                name="location"
                value="{{ old('location') }}"
                class="w-full border border-outline-variant rounded-xl p-3 bg-white"
                placeholder="Contoh: Jl. Sudirman No. 10, Jakarta"
            >
        </div>

        {{-- Radius Lokasi --}}
        <div class="mb-6">
            <label class="block mb-2 font-semibold text-primary">Radius Lokasi (km)</label>
            <input 
                type="number" 
                name="location_radius"
                value="{{ old('location_radius') }}"
                min="0"
                step="0.1"
                class="w-full border border-outline-variant rounded-xl p-3 bg-white"
                placeholder="Contoh: 5"
            >
            <p class="text-sm text-gray-500 mt-1">
                Bisa dipakai untuk membatasi volunteer berdasarkan jarak lokasi.
            </p>
        </div>

        {{-- Catatan Tambahan --}}
        <div class="mb-6">
            <label class="block mb-2 font-semibold text-primary">Catatan Tambahan</label>
            <textarea 
                name="notes"
                rows="4"
                class="w-full border border-outline-variant rounded-xl p-3 bg-white"
                placeholder="Tambahkan informasi penting lainnya jika ada..."
            >{{ old('notes') }}</textarea>
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
                Publish Request
            </button>
        </div>
    </form>
</div>

</body>
</html>