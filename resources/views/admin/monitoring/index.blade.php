<!DOCTYPE html>
<html>
<head>
    <title>Monitoring Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

<div class="p-8">

    <h1 class="text-3xl font-bold mb-8">
        Monitoring Dashboard
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach($organizations as $organization)

        <div class="bg-white rounded-2xl p-6 shadow mb-6">

            <h2 class="text-2xl font-bold text-[#006c49]">
                {{ $organization->organization_name }}
            </h2>

            <p class="text-gray-500 mt-1">
                {{ $organization->email }}
            </p>

            {{-- PROGRAM VOLUNTEER --}}
            <div class="mt-6">

                <h3 class="font-bold text-blue-700 mb-3">
                    Program Volunteer
                </h3>

               @foreach($organization->volunteerRequests as $program)

                <div class="bg-blue-50 rounded-xl p-4 mb-3 flex items-center justify-between">

                    <div>
                        <p class="font-semibold">
                            {{ $program->title }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $organization->organization_name }}
                        </p>
                    </div>

                    <a href="{{ route('user.volunteer.detail', $program->id) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">

                        Lihat Detail
                    </a>

                </div>

                @endforeach

            </div>

            {{-- PROGRAM DONASI --}}
            <div class="mt-6">

                <h3 class="font-bold text-purple-700 mb-3">
                    Program Donasi
                </h3>

                @foreach($organization->donations as $donation)

                <div class="bg-purple-50 rounded-xl p-4 mb-3 flex items-center justify-between">

                    <div>
                        <p class="font-semibold">
                            {{ $donation->item_name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $organization->organization_name }}
                        </p>
                    </div>

                    <a href="{{ route('user.donation.detail', $donation->id) }}"
                    class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">

                        Lihat Detail
                    </a>

                </div>

                @endforeach
            </div>

        </div>

        @endforeach
    </div>

</div>

</body>
</html>