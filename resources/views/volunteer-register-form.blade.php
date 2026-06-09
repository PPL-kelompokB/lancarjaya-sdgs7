<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Volunteer</title>

    <!-- CDN Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 py-10">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg">

        <!-- Judul -->
        <h2 class="text-3xl font-bold text-[#006c49] mb-2">
            Formulir Pendaftaran Volunteer
        </h2>

        <p class="text-gray-600 mb-6">
            Mendaftar untuk:
            <span class="font-semibold">
                {{ $volunteer->title }}
            </span>
        </p>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Validation -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('volunteer.register.submit', $volunteer->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-5">

            @csrf

            <!-- Nama -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#006c49]"
                >
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#006c49]"
                >
            </div>

            <!-- Upload CV -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Upload CV (PDF)
                </label>

                <input
                    type="file"
                    name="cv"
                    accept=".pdf"
                    required
                    class="w-full border border-gray-300 rounded-lg p-3"
                >
            </div>

            <!-- Submit -->
            <div class="pt-4 flex justify-between items-center">

                <!-- Tombol Back -->
                <a href="{{ url()->previous() }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold px-6 py-3 rounded-lg transition duration-200">
                    ← Kembali
                </a>

                <!-- Tombol Submit -->
                <button
                    type="submit"
                    class="bg-[#006c49] hover:bg-[#004d35] text-white font-bold px-6 py-3 rounded-lg transition duration-200"
                >
                    Kirim Pendaftaran
                </button>

            </div>

        </form>

    </div>

</body>
</html>