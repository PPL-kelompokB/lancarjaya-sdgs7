<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Program Donasi - EcoDon</title>

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
                        soft: "0 20px 50px rgba(0, 53, 39, 0.10)",
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

            <div class="bg-gradient-to-r from-primary to-secondary px-8 md:px-10 py-9 text-white">
                <p class="text-sm uppercase tracking-[0.2em] text-white/70 font-semibold">
                    EcoDon Organization
                </p>
                <h1 class="mt-3 text-3xl md:text-4xl font-extrabold">
                    Buat Program Donasi
                </h1>
                <p class="mt-3 text-white/80 max-w-2xl">
                    Buat program donasi baru agar donor bisa mengetahui kebutuhan, lokasi, dan detail bantuan yang dibutuhkan.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4">

                <aside class="lg:col-span-1 bg-cream/70 p-8 border-r border-[#eadfd8]">
                    <div class="sticky top-8 space-y-5">
                        <div class="w-14 h-14 rounded-2xl bg-primary text-white flex items-center justify-center text-2xl">
                            🎁
                        </div>

                        <div>
                            <h2 class="text-xl font-extrabold text-primary">
                                Detail Program
                            </h2>
                            <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                                Pastikan informasi jelas, lengkap, dan mudah dipahami oleh calon donatur.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-white p-5 border border-[#eadfd8]">
                            <p class="text-sm font-bold text-primary mb-2">Tips</p>
                            <ul class="text-sm text-gray-600 space-y-2">
                                <li>• Gunakan judul yang spesifik.</li>
                                <li>• Isi target jumlah barang.</li>
                                <li>• Tulis kontak yang aktif.</li>
                                <li>• Pastikan alamat lengkap.</li>
                            </ul>
                        </div>
                    </div>
                </aside>

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

                    <form action="{{ route('organization.donation.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <input type="hidden" name="organization_id" value="{{ $organization->id }}">

                        <section>
                            <h3 class="text-lg font-extrabold text-primary mb-4">
                                Informasi Utama
                            </h3>

                            <div class="space-y-5">
                                <div>
                                    <label class="block mb-2 font-bold text-primary">Judul Program</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="Contoh: Donasi Buku untuk Anak Desa">
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">Deskripsi</label>
                                    <textarea name="description" rows="5"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="Jelaskan tujuan program donasi, siapa penerimanya, dan kenapa bantuan ini dibutuhkan...">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </section>

                        <section>
                            <h3 class="text-lg font-extrabold text-primary mb-4">
                                Detail Barang
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block mb-2 font-bold text-primary">Nama Barang</label>
                                    <input type="text" name="item_name" value="{{ old('item_name') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="Contoh: Buku tulis">
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">Kategori</label>
                                    <input type="text" name="category" value="{{ old('category') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="Contoh: Pendidikan">
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">Jumlah</label>
                                    <input type="number" name="quantity" value="{{ old('quantity') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="Contoh: 100">
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">Satuan</label>
                                    <input type="text" name="unit" value="{{ old('unit') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="Contoh: pcs / box / kg">
                                </div>
                            </div>
                        </section>

                        <section>
                            <h3 class="text-lg font-extrabold text-primary mb-4">
                                Lokasi Pengumpulan
                            </h3>

                            <div class="space-y-5">
                                <div>
                                    <label class="block mb-2 font-bold text-primary">Alamat Lengkap</label>
                                    <input type="text" name="address" value="{{ old('address') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="Masukkan alamat lengkap">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block mb-2 font-bold text-primary">Kota</label>
                                        <input type="text" name="city" value="{{ old('city') }}"
                                            class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                            placeholder="Contoh: Surabaya">
                                    </div>

                                    <div>
                                        <label class="block mb-2 font-bold text-primary">Provinsi</label>
                                        <input type="text" name="province" value="{{ old('province') }}"
                                            class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                            placeholder="Contoh: Jawa Timur">
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section>
                            <h3 class="text-lg font-extrabold text-primary mb-4">
                                Kontak & Periode
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block mb-2 font-bold text-primary">Contact Person</label>
                                    <input type="text" name="contact_person" value="{{ old('contact_person') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="Nama penanggung jawab">
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">No HP</label>
                                    <input type="text" name="contact_phone" value="{{ old('contact_phone') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                        placeholder="08xxxxxxxxxx">
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">Tanggal Mulai</label>
                                    <input
                                        type="date"
                                        name="start_date"
                                        value="{{ old('start_date') }}"
                                        min="{{ now()->format('Y-m-d') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary">
                                </div>

                                <div>
                                    <label class="block mb-2 font-bold text-primary">Tanggal Selesai</label>
                                    <input
                                        type="date"
                                        name="end_date"
                                        value="{{ old('end_date') }}"
                                        min="{{ now()->format('Y-m-d') }}"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary">
                                </div>
                            </div>
                        </section>

                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-100">
                            <a href="{{ route('organization.dashboard') }}"
                               class="px-6 py-3 bg-gray-200 text-gray-700 rounded-full font-bold text-center hover:bg-gray-300 transition">
                                Batal
                            </a>

                            <button type="submit"
                                class="px-8 py-3 bg-primary text-white rounded-full font-bold hover:bg-secondary transition shadow-lg">
                                Publish Program
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
