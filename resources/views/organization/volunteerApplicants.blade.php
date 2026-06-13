<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Applicants</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-6xl mx-auto">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold text-[#006c49]">
                    Volunteer Applicants
                </h1>

                <p class="text-gray-600 mt-1">
                    {{ $volunteer->title }}
                </p>
            </div>

            <!-- BACK -->
           <a href="{{ route('organization.dashboard') }}"
                class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-xl font-semibold transition">

                ← Kembali ke Dashboard

            </a>

        </div>

        <!-- SUCCESS -->
        @if(session('success'))

            <div class="mb-6 bg-green-100 text-green-700 p-4 rounded-xl">
                {{ session('success') }}
            </div>

        @endif

        <!-- EMPTY -->
        @if($applicants->isEmpty())

            <div class="bg-white rounded-2xl p-8 shadow text-center text-gray-500">
                Belum ada pendaftar volunteer.
            </div>

        @else

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @foreach($applicants as $applicant)

                    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">

                        <!-- TOP -->
                        <div class="flex justify-between items-start mb-5">

                            <div>
                                <h2 class="text-xl font-bold text-gray-800">
                                    {{ $applicant->name }}
                                </h2>

                                <p class="text-gray-500 text-sm">
                                    {{ $applicant->email }}
                                </p>
                            </div>

                            <!-- STATUS -->
                            @if($applicant->status == 'in_review')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                                    In Review
                                </span>

                            @elseif($applicant->status == 'accepted')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Accepted
                                </span>

                            @elseif($applicant->status == 'rejected')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Rejected
                                </span>

                            @elseif($applicant->status == 'done')

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Done
                                </span>

                            @endif

                        </div>

                        <!-- CONTENT -->
                        <div class="space-y-3">

                            <!-- CV -->
                            <a href="{{ asset('storage/' . $applicant->cv_path) }}"
                               target="_blank"
                               class="inline-block text-[#006c49] font-semibold underline">

                                Lihat CV

                            </a>

                            <!-- DATE -->
                            <p class="text-sm text-gray-500">

                                Daftar:
                                {{ $applicant->created_at->format('d M Y') }}

                            </p>

                        </div>

                        <!-- NOTES -->
                        @if($applicant->notes)

                            <div class="mt-5 bg-gray-100 rounded-xl p-4 border border-gray-200">

                                <p class="font-bold text-gray-800 mb-2">
                                    Notes
                                </p>

                                <p class="text-sm text-gray-600 leading-relaxed">
                                    {{ $applicant->notes }}
                                </p>

                            </div>

                        @endif

                        <!-- UPDATE FORM -->
                        <form
                            action="{{ route('organization.volunteer.update.status', $applicant->id) }}"
                            method="POST"
                            class="mt-5 space-y-4"
                        >

                            @csrf
                            @method('PUT')

                            <!-- STATUS -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Update Status
                                </label>

                                <select
                                    name="status"
                                    class="w-full border border-gray-300 rounded-xl p-3"
                                >

                                    <option value="in_review"
                                        {{ $applicant->status == 'in_review' ? 'selected' : '' }}>
                                        In Review
                                    </option>

                                    <option value="accepted"
                                        {{ $applicant->status == 'accepted' ? 'selected' : '' }}>
                                        Accepted
                                    </option>

                                    <option value="rejected"
                                        {{ $applicant->status == 'rejected' ? 'selected' : '' }}>
                                        Rejected
                                    </option>

                                    <option value="done"
                                        {{ $applicant->status == 'done' ? 'selected' : '' }}>
                                        Done
                                    </option>

                                </select>

                            </div>

                            <!-- NOTES -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Notes / Langkah Selanjutnya
                                </label>

                                <textarea
                                    name="notes"
                                    rows="4"
                                    placeholder="Tulis catatan untuk volunteer..."
                                    class="w-full border border-gray-300 rounded-xl p-3"
                                >{{ $applicant->notes }}</textarea>

                            </div>

                            <!-- BUTTON -->
                            <button
                                type="submit"
                                class="w-full bg-[#006c49] hover:bg-[#003527] text-white py-3 rounded-xl font-bold transition"
                            >

                                Simpan Status

                            </button>

                        </form>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</body>
</html>