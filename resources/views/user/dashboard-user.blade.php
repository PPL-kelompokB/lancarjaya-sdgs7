<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - User Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#003527",
                        secondary: "#006c49",
                        surface: "#fff8f5",
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-surface min-h-screen flex">

<!-- SIDEBAR -->
<aside class="w-64 bg-[#f6ece6] p-6 hidden md:block">
    <h1 class="text-xl font-bold text-primary mb-10">EcoDon User</h1>

    <nav class="space-y-3">
        <a href="#" class="block bg-primary text-white px-4 py-2 rounded-full">Dashboard</a>
    </nav>

    <form action="{{ route('logout') }}" method="POST" class="mt-10">
        @csrf
        <button class="text-red-500">Logout</button>
    </form>
</aside>

<!-- MAIN -->
<main class="flex-1 p-6">

    <!-- HEADER -->
    <div class="bg-white rounded-2xl p-6 shadow mb-6">
        <div class="flex items-center gap-4">

            <!-- FOTO -->
            <div onclick="openModal('uploadPhoto')" class="cursor-pointer w-20 h-20 rounded-full overflow-hidden bg-gray-200">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/'.$user->profile_photo) }}" class="w-full h-full object-cover">
                @else
                    <img src="https://via.placeholder.com/80" class="w-full h-full object-cover">
                @endif
            </div>

            <!-- INFO -->
            <div>
                <h2 class="text-2xl font-bold text-primary">{{ $user->name }}</h2>
                <p class="text-gray-500">{{ $user->email }}</p>
            </div>

            <!-- BUTTON EDIT -->
            <button onclick="openModal('editProfile')"
                class="ml-auto bg-primary text-white px-4 py-2 rounded-full">
                Edit Profil
            </button>
        </div>
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-white p-4 rounded-xl shadow">
            <h3 class="text-xl font-bold text-primary">
                {{ $user->donations->count() ?? 0 }}
            </h3>
            <p class="text-sm text-gray-500">Total Donasi</p>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <h3 class="text-xl font-bold text-primary">
                {{ $user->points ?? 0 }}
            </h3>
            <p class="text-sm text-gray-500">Poin Reward</p>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <h3 class="text-xl font-bold text-primary">
                {{ $user->created_at->format('Y') }}
            </h3>
            <p class="text-sm text-gray-500">Tahun Bergabung</p>
        </div>

    </div>

    <!-- DONASI -->
    <div class="bg-white rounded-2xl p-6 shadow">
        <h3 class="text-lg font-bold text-primary mb-4">Riwayat Donasi</h3>

        @forelse($user->donations as $donation)
            <div class="border-b py-3">
                <h4 class="font-semibold">{{ $donation->title }}</h4>
                <p class="text-sm text-gray-500">{{ $donation->description }}</p>

                <div class="text-xs mt-2 text-gray-400">
                    {{ $donation->created_at->format('d M Y') }}
                </div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada donasi</p>
        @endforelse
    </div>

</main>

<!-- ================= MODAL EDIT PROFILE ================= -->
<div id="editProfile" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">

    <div class="bg-white p-6 rounded-xl w-96">
        <h3 class="font-bold mb-4">Edit Profile</h3>

        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $user->name }}" class="w-full border p-2 mb-2">
            <input type="email" name="email" value="{{ $user->email }}" class="w-full border p-2 mb-2">
            <input type="text" name="phone" value="{{ $user->phone }}" class="w-full border p-2 mb-2">
            <textarea name="address" class="w-full border p-2 mb-2">{{ $user->address }}</textarea>

            <button class="bg-primary text-white px-4 py-2 rounded w-full">
                Simpan
            </button>
        </form>

        <button onclick="closeModal('editProfile')" class="mt-3 text-red-500">Tutup</button>
    </div>
</div>

<!-- ================= MODAL UPLOAD FOTO ================= -->
<div id="uploadPhoto" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">

    <div class="bg-white p-6 rounded-xl w-96">
        <h3 class="font-bold mb-4">Upload Foto</h3>

        <form action="{{ route('user.profile-photo.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="file" name="profile_photo" class="mb-3">

            <button class="bg-primary text-white px-4 py-2 rounded w-full">
                Upload
            </button>
        </form>

        <button onclick="closeModal('uploadPhoto')" class="mt-3 text-red-500">Tutup</button>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
function openModal(id){
    document.getElementById(id).classList.remove('hidden');
}

function closeModal(id){
    document.getElementById(id).classList.add('hidden');
}
</script>

</body>
</html>