<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Volunteer</title>

    <!-- CDN Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50 py-10">

    <div class="max-w-3xl mx-auto px-4">

        <!-- Card -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="bg-[#006c49] p-8 text-white">
                <h1 class="text-3xl font-bold mb-2">
                    🌱 Pendaftaran Volunteer {{ $volunteer->title }}
                </h1>

                <p class="text-green-100">
                    Bergabunglah dan berkontribusi untuk kegiatan sosial bersama EcoDon.
                </p>
            </div>

            <div class="p-8">

                <!-- Success -->
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border border-green-200 text-green-700 p-4 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Errors -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-200 text-red-700 p-4 rounded-xl">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ route('volunteer.register.submit', $volunteer->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-6">

                    @csrf

                    <!-- Nama -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="Masukkan nama lengkap"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#006c49] focus:border-[#006c49] outline-none transition">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="contoh@email.com"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#006c49] focus:border-[#006c49] outline-none transition">
                    </div>

                    <!-- CV -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">
                            Upload CV
                        </label>

                        <div class="border-2 border-dashed border-green-300 rounded-2xl p-8 text-center bg-green-50 hover:bg-green-100 transition">

                            <div class="text-4xl mb-3">
                                📄
                            </div>

                            <p class="font-medium text-gray-700 mb-2">
                                Unggah CV Anda (PDF)
                            </p>

                            <p class="text-sm text-gray-500 mb-4">
                                Format PDF, maksimal 5MB
                            </p>

                            <input
                                type="file"
                                name="cv"
                                accept=".pdf"
                                required
                                class="block mx-auto text-sm text-gray-600">
                        </div>
                    </div>

                    <!-- Action -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-between pt-4">

                        <a href="{{ url()->previous() }}"
                           class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-semibold text-center transition">
                            ← Kembali
                        </a>

                        <button
                            type="submit"
                            class="px-8 py-3 bg-[#006c49] hover:bg-[#00553a] text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition">
                            Kirim Pendaftaran
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>
