<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EcoDon</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, .brand-font { font-family: 'Manrope', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-[#fff8f5] text-[#1f1b17] min-h-screen">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="hidden lg:flex w-72 bg-[#fff8f5] border-r-0 flex-col p-6 shadow-[0px_20px_40px_rgba(31,27,23,0.06)]">
        <div class="mb-10">
            <span class="text-2xl font-bold text-[#003527]">EcoDon Admin</span>
            <p class="mt-1 text-xs uppercase tracking-widest opacity-60">Dashboard Administrator</p>
        </div>

        <nav class="flex-1 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 rounded-full px-4 py-3 transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-[#003527] text-white' : 'text-[#1f1b17] hover:bg-[#f6ece6]' }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm font-semibold">Overview</span>
            </a>

            <a href="{{ route('admin.organizations.index') }}"
               class="flex items-center gap-3 rounded-full px-4 py-3 transition-all duration-200 {{ request()->routeIs('admin.organizations.*') ? 'bg-[#003527] text-white' : 'text-[#1f1b17] hover:bg-[#f6ece6]' }}">
                <span class="material-symbols-outlined">corporate_fare</span>
                <span class="text-sm font-semibold">Organizations</span>
            </a>

            <a href="{{ route('admin.vouchers.index') }}"
               class="flex items-center gap-3 rounded-full px-4 py-3 transition-all duration-200 {{ request()->routeIs('admin.vouchers.*') ? 'bg-[#003527] text-white' : 'text-[#1f1b17] hover:bg-[#f6ece6]' }}">
                <span class="material-symbols-outlined">confirmation_number</span>
                <span class="text-sm font-semibold">Manajemen Voucher</span>
            </a>
        </nav>

        <div class="mt-auto pt-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-full border border-[#d8ccc5] px-4 py-3 font-semibold text-[#003527] transition hover:bg-[#f6ece6]">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main -->
    <main class="flex-1 p-4 sm:p-6 lg:p-10">

        <!-- Mobile top -->
        <div class="lg:hidden mb-6">
            <h1 class="text-2xl font-extrabold text-[#003527] brand-font">EcoDon Admin</h1>
            <p class="text-sm text-[#666]">Dashboard Administrator</p>
        </div>

        <div class="mb-8">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#003527]">
                Dashboard Admin
            </h2>
            <p class="mt-2 text-sm sm:text-base text-[#404944]">
                Pantau user, organisasi, verifikasi, dan progres donasi barang.
            </p>
        </div>

        @if (session('success'))
            <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- Statistik utama -->
        <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <p class="text-sm text-[#666]">Total User</p>
                <h3 class="mt-2 text-3xl font-extrabold text-[#003527]">{{ $totalUsers }}</h3>
            </div>

            <div class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <p class="text-sm text-[#666]">Total Organisasi</p>
                <h3 class="mt-2 text-3xl font-extrabold text-[#003527]">{{ $totalOrganizations }}</h3>
            </div>

            <div class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <p class="text-sm text-[#666]">Pending Verifikasi</p>
                <h3 class="mt-2 text-3xl font-extrabold text-yellow-600">{{ $pendingOrganizationsCount }}</h3>
            </div>

            <div class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <p class="text-sm text-[#666]">Total Donasi Barang</p>
                <h3 class="mt-2 text-3xl font-extrabold text-[#003527]">{{ $totalDonations }}</h3>
            </div>
        </section>

        <!-- Statistik donasi -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-[#f6ece6] rounded-2xl border border-[#e5ddd7] p-5">
                <p class="text-sm text-[#666]">Donasi Open</p>
                <h3 class="mt-2 text-2xl font-bold text-blue-700">{{ $openDonations }}</h3>
            </div>

            <div class="bg-[#f6ece6] rounded-2xl border border-[#e5ddd7] p-5">
                <p class="text-sm text-[#666]">Donasi In Progress</p>
                <h3 class="mt-2 text-2xl font-bold text-yellow-700">{{ $inProgressDonations }}</h3>
            </div>

            <div class="bg-[#f6ece6] rounded-2xl border border-[#e5ddd7] p-5">
                <p class="text-sm text-[#666]">Donasi Completed</p>
                <h3 class="mt-2 text-2xl font-bold text-green-700">{{ $completedDonations }}</h3>
            </div>
        </section>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            <!-- Organisasi Pending -->
            <section class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-[#003527]">Organisasi Pending</h3>
                    <span class="text-sm font-semibold text-[#666]">
                        {{ $organizations->count() }} organisasi
                    </span>
                </div>

                <div class="space-y-4">
                    @forelse ($organizations as $org)
                        <div class="border border-[#eee2db] rounded-xl p-4">
                            <h4 class="font-bold text-[#1f1b17]">{{ $org->organization_name }}</h4>
                            <p class="text-sm text-[#666] mt-1">Tipe: {{ $org->organization_type }}</p>
                            <p class="text-sm text-[#666]">PIC: {{ $org->pic_name }}</p>
                            <p class="text-sm text-[#666]">Email PIC: {{ $org->pic_email }}</p>

                            <div class="mt-3 flex gap-2 flex-wrap">
                                <a href="{{ route('admin.organizations.show', $org->id) }}"
                                   class="px-4 py-2 rounded-lg bg-[#003527] text-white text-sm font-semibold hover:opacity-90">
                                    Detail Verifikasi
                                </a>

                                <form action="{{ route('admin.organizations.approve', $org->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="px-4 py-2 rounded-lg border border-[#003527] text-[#003527] text-sm font-semibold hover:bg-[#f6ece6]">
                                        Approve Cepat
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-[#666]">Tidak ada organisasi pending.</p>
                    @endforelse
                </div>
            </section>

            <!-- Donasi Terbaru -->
            <section class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <h3 class="text-xl font-bold text-[#003527] mb-4">Donasi Barang Terbaru</h3>

                <div class="space-y-4">
                    @forelse ($latestDonations as $donation)
                        <div class="border border-[#eee2db] rounded-xl p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h4 class="font-bold text-[#1f1b17]">{{ $donation->title }}</h4>
                                    <p class="text-sm text-[#666] mt-1">
                                        Organisasi: {{ $donation->organization->organization_name ?? '-' }}
                                    </p>
                                    <p class="text-sm text-[#666]">
                                        Barang: {{ $donation->item_name }}
                                        @if($donation->quantity)
                                            - {{ $donation->quantity }} {{ $donation->unit }}
                                        @endif
                                    </p>
                                    <p class="text-sm text-[#666]">
                                        Lokasi: {{ $donation->city ?? '-' }}, {{ $donation->province ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-3 flex flex-wrap gap-2">
                                @if ($donation->status === 'open')
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                        Open
                                    </span>
                                @elseif ($donation->status === 'in_progress')
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">
                                        In Progress
                                    </span>
                                @elseif ($donation->status === 'completed')
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                        Completed
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                        Cancelled
                                    </span>
                                @endif

                                @if ($donation->logistic_status === 'waiting_pickup')
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700">
                                        Menunggu Pickup
                                    </span>
                                @elseif ($donation->logistic_status === 'picked_up')
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700">
                                        Sudah Diambil
                                    </span>
                                @elseif ($donation->logistic_status === 'in_transit')
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-700">
                                        Dalam Pengiriman
                                    </span>
                                @elseif ($donation->logistic_status === 'arrived')
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-cyan-100 text-cyan-700">
                                        Sudah Sampai
                                    </span>
                                @elseif ($donation->logistic_status === 'processed')
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-700">
                                        Sedang Diolah
                                    </span>
                                @elseif ($donation->logistic_status === 'distributed')
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                        Sudah Disalurkan
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-[#666]">Belum ada data donasi.</p>
                    @endforelse
                </div>
            </section>

        </div>
    </main>
</div>

</body>
</html>