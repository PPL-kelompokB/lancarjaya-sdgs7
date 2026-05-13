<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program Donasi - EcoDon</title>

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
                    Edit Program Donasi
                </h1>
                <p class="mt-2 text-white/80 max-w-2xl">
                    Perbarui detail program donasi organisasi kamu.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-0">

                <div class="lg:col-span-2 bg-cream/70 p-8 border-r border-gray-100">
                    <h2 class="text-lg font-bold text-primary mb-4">
                        Ringkasan Donasi
                    </h2>

                    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 space-y-4">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-400 font-bold">Judul</p>
                            <p class="font-bold text-primary mt-1">{{ $donation->title }}</p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-400 font-bold">Barang</p>
                            <p class="font-semibold mt-1">{{ $donation->item_name }}</p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-400 font-bold">Jumlah</p>
                            <p class="font-semibold mt-1">
                                {{ $donation->quantity ?? '-' }} {{ $donation->unit ?? '' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-400 font-bold">Status</p>
                            <p class="font-semibold mt-1 capitalize">{{ $donation->status }}</p>
                        </div>
                    </div>

                    <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                        Pastikan data donasi jelas agar calon donatur mudah memahami kebutuhan organisasi kamu.
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

                    <form action="{{ route('donations.update', $donation->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block mb-2 font-bold text-primary">Judul Program</label>
                            <input type="text" name="title"
                                   value="{{ old('title', $donation->title) }}"
                                   class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                   required>
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-primary">Deskripsi</label>
                            <textarea name="description" rows="5"
                                      class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary">{{ old('description', $donation->description) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block mb-2 font-bold text-primary">Nama Barang</label>
                                <input type="text" name="item_name"
                                       value="{{ old('item_name', $donation->item_name) }}"
                                       class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                       required>
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-primary">Kategori</label>
                                <input type="text" name="category"
                                       value="{{ old('category', $donation->category) }}"
                                       class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block mb-2 font-bold text-primary">Jumlah</label>
                                <input type="number" name="quantity"
                                       value="{{ old('quantity', $donation->quantity) }}"
                                       class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary">
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-primary">Unit</label>
                                <input type="text" name="unit"
                                       value="{{ old('unit', $donation->unit) }}"
                                       class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary">
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 font-bold text-primary">Alamat</label>
                            <textarea name="address" rows="3"
                                      class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                      required>{{ old('address', $donation->address) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block mb-2 font-bold text-primary">Kota</label>
                                <input type="text" name="city"
                                       value="{{ old('city', $donation->city) }}"
                                       class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                       required>
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-primary">Provinsi</label>
                                <input type="text" name="province"
                                       value="{{ old('province', $donation->province) }}"
                                       class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                       required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block mb-2 font-bold text-primary">Contact Person</label>
                                <input type="text" name="contact_person"
                                       value="{{ old('contact_person', $donation->contact_person) }}"
                                       class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                       required>
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-primary">No. HP</label>
                                <input type="text" name="contact_phone"
                                       value="{{ old('contact_phone', $donation->contact_phone) }}"
                                       class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                       required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block mb-2 font-bold text-primary">Tanggal Mulai</label>
                                <input type="date" name="start_date"
                                       value="{{ old('start_date', \Carbon\Carbon::parse($donation->start_date)->format('Y-m-d')) }}"
                                       class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                       required>
                            </div>

                            <div>
                                <label class="block mb-2 font-bold text-primary">Tanggal Selesai</label>
                                <input type="date" name="end_date"
                                       value="{{ old('end_date', \Carbon\Carbon::parse($donation->end_date)->format('Y-m-d')) }}"
                                       class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                                       required>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                            <a href="{{ route('organization.dashboard') }}"
                               class="px-6 py-3 bg-gray-200 text-gray-700 rounded-full font-bold text-center hover:bg-gray-300 transition">
                                Batal
                            </a>

                            <button type="submit"
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

</body>
</html>