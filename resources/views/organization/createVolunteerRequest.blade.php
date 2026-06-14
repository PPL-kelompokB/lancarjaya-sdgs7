<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Volunteer Request - EcoDon</title>

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
                    },
                    boxShadow: {
                        soft: "0 20px 50px rgba(0,53,39,.10)",
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-surface min-h-screen text-gray-800">

<div class="min-h-screen px-4 py-10">
    <div class="max-w-6xl mx-auto">

        <a href="{{ route('organization.dashboard') }}"
           class="inline-flex items-center gap-2 mb-6 text-primary font-bold hover:underline">
            ← Kembali ke Dashboard
        </a>

        <div class="bg-white rounded-[2rem] shadow-soft overflow-hidden border border-[#eadfd8]">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-primary to-secondary px-8 md:px-10 py-9 text-white">
                <p class="text-sm uppercase tracking-[0.2em] text-white/70 font-semibold">
                    EcoDon Organization
                </p>

                <h1 class="mt-3 text-3xl md:text-4xl font-extrabold">
                    Buat Volunteer Request
                </h1>

                <p class="mt-3 text-white/80 max-w-2xl">
                    Cari relawan yang tepat untuk membantu kegiatan sosial organisasi Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4">

                {{-- Sidebar --}}
                <aside class="lg:col-span-1 bg-cream/70 p-8 border-r border-[#eadfd8]">
                    <div class="sticky top-8 space-y-5">

                        <div class="w-14 h-14 rounded-2xl bg-primary text-white flex items-center justify-center text-2xl">
                            🤝
                        </div>

                        <div>
                            <h2 class="text-xl font-extrabold text-primary">
                                Volunteer Request
                            </h2>

                            <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                                Lengkapi informasi kegiatan agar calon volunteer memahami tugas dan kebutuhan organisasi.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-white p-5 border border-[#eadfd8]">
                            <p class="text-sm font-bold text-primary mb-2">
                                Tips
                            </p>

                            <ul class="text-sm text-gray-600 space-y-2">
                                <li>• Jelaskan tujuan kegiatan.</li>
                                <li>• Tulis tugas volunteer secara rinci.</li>
                                <li>• Cantumkan lokasi yang jelas.</li>
                                <li>• Tentukan kuota yang realistis.</li>
                            </ul>
                        </div>

                    </div>
                </aside>

                {{-- Main Content --}}
                <main class="lg:col-span-3 p-6 md:p-10">

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

                    <form action="{{ route('organization.volunteer-request.store') }}"
                          method="POST"
                          enctype="multipart/form-data"
                          class="space-y-8">

                        @csrf

                        <input type="hidden"
                               name="organization_id"
                               value="{{ $organization->id }}">

                        {{-- Informasi Kegiatan --}}
                        <section>
                            <h3 class="text-lg font-extrabold text-primary mb-4">
                                Informasi Kegiatan
                            </h3>

                            <div class="space-y-5">

                                <div>
                                    <label class="block mb-2 font-bold text-primary">
                                        Judul Kegiatan
                                    </label>

                                    <input
                                        type="text"
                                        name="title"
                                        value="{{ old('title') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="Contoh: Bakti Sosial Pendidikan Desa">
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">
                                        Deskripsi Kegiatan
                                    </label>

                                    <textarea
                                        name="description"
                                        rows="5"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="Jelaskan kegiatan volunteer secara lengkap...">{{ old('description') }}</textarea>
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">
                                        Gambar Kegiatan
                                    </label>

                                    <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center">
                                        <input
                                            type="file"
                                            name="image"
                                            accept="image/*"
                                            class="w-full">

                                        <p class="mt-2 text-sm text-gray-500">
                                            Upload poster atau gambar kegiatan
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </section>

                        {{-- Detail Volunteer --}}
                        <section>
                            <h3 class="text-lg font-extrabold text-primary mb-4">
                                Detail Volunteer
                            </h3>

                            <div class="space-y-5">

                                <div>
                                    <label class="block mb-2 font-bold text-primary">
                                        Deskripsi Tugas
                                    </label>

                                    <textarea
                                        name="task_description"
                                        rows="5"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="Contoh: Registrasi peserta, dokumentasi, distribusi logistik...">{{ old('task_description') }}</textarea>
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">
                                        Keahlian yang Dibutuhkan
                                    </label>

                                    <input
                                        type="text"
                                        name="required_skills"
                                        value="{{ old('required_skills') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="Komunikasi, Desain, Public Speaking">
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">
                                        Jumlah Volunteer
                                    </label>

                                    <input
                                        type="number"
                                        min="1"
                                        name="volunteer_quota"
                                        value="{{ old('volunteer_quota') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="Contoh: 20">
                                </div>

                            </div>
                        </section>

                        {{-- Jadwal Kegiatan --}}
                        <section>
                            <h3 class="text-lg font-extrabold text-primary mb-4">
                                Jadwal Kegiatan
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                                <div>
                                    <label class="block mb-2 font-bold text-primary">
                                        Deadline Pendaftaran
                                    </label>

                                    <input
                                        type="date"
                                        name="deadline"
                                        value="{{ old('deadline') }}"
                                        min="{{ now()->format('Y-m-d') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3">
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">
                                        Tanggal Kegiatan
                                    </label>

                                    <input
                                        type="date"
                                        name="event_date"
                                        value="{{ old('event_date') }}"
                                        min="{{ now()->format('Y-m-d') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3">
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">
                                        Tipe Kegiatan
                                    </label>

                                    <select
                                        name="event_type"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3">

                                        <option value="">Pilih Tipe</option>

                                        <option value="online"
                                            {{ old('event_type') == 'online' ? 'selected' : '' }}>
                                            Online
                                        </option>

                                        <option value="offline"
                                            {{ old('event_type') == 'offline' ? 'selected' : '' }}>
                                            Offline
                                        </option>

                                        <option value="hybrid"
                                            {{ old('event_type') == 'hybrid' ? 'selected' : '' }}>
                                            Hybrid
                                        </option>

                                    </select>
                                </div>

                            </div>
                        </section>

                        {{-- Lokasi --}}
                        <section>
                            <h3 class="text-lg font-extrabold text-primary mb-4">
                                Lokasi Kegiatan
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label class="block mb-2 font-bold text-primary">
                                        Lokasi
                                    </label>

                                    <input
                                        type="text"
                                        name="location"
                                        value="{{ old('location') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                                        placeholder="Jl. Sudirman No.10, Jakarta">
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">
                                        Radius Lokasi (km)
                                    </label>

                                    <input
                                        type="number"
                                        step="0.1"
                                        min="0"
                                        name="location_radius"
                                        value="{{ old('location_radius') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                                        placeholder="5">
                                </div>

                            </div>
                        </section>

                        {{-- Catatan --}}
                        <section>
                            <h3 class="text-lg font-extrabold text-primary mb-4">
                                Informasi Tambahan
                            </h3>

                            <textarea
                                name="notes"
                                rows="4"
                                class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                                placeholder="Tambahkan informasi tambahan jika diperlukan...">{{ old('notes') }}</textarea>
                        </section>

                        {{-- Buttons --}}
                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-100">

                            <a href="{{ route('organization.dashboard') }}"
                               class="px-6 py-3 bg-gray-200 text-gray-700 rounded-full font-bold text-center hover:bg-gray-300 transition">
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="px-8 py-3 bg-primary text-white rounded-full font-bold hover:bg-secondary transition shadow-lg">
                                Publish Volunteer Request
                            </button>

                        </div>

                    </form>

                </main>
            </div>
        </div>
    </div>
</div>

</body>
</html>
