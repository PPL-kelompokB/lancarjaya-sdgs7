<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Monitor - EcoDon Admin</title>
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

            <a href="{{ route('admin.activity-monitor') }}"
               class="flex items-center gap-3 rounded-full px-4 py-3 transition-all duration-200 {{ request()->routeIs('admin.activity-monitor') ? 'bg-[#003527] text-white' : 'text-[#1f1b17] hover:bg-[#f6ece6]' }}">
                <span class="material-symbols-outlined">monitoring</span>
                <span class="text-sm font-semibold">Activity Monitor</span>
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
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#003527]">Activity Monitor</h2>
            <p class="mt-2 text-sm sm:text-base text-[#404944]">
                Pantau seluruh kegiatan volunteer dan donasi dari semua organisasi.
            </p>
        </div>

        <!-- Statistik -->
        <section class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <p class="text-xs text-[#666] uppercase tracking-wide">Total Volunteer</p>
                <h3 class="mt-2 text-3xl font-extrabold text-[#003527]">{{ $totalVolunteer }}</h3>
            </div>
            <div class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <p class="text-xs text-[#666] uppercase tracking-wide">Total Donasi</p>
                <h3 class="mt-2 text-3xl font-extrabold text-[#003527]">{{ $totalDonation }}</h3>
            </div>
            <div class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <p class="text-xs text-[#666] uppercase tracking-wide">Donasi Open</p>
                <h3 class="mt-2 text-3xl font-extrabold text-blue-600">{{ $openDonations }}</h3>
            </div>
            <div class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <p class="text-xs text-[#666] uppercase tracking-wide">Donasi Selesai</p>
                <h3 class="mt-2 text-3xl font-extrabold text-green-600">{{ $doneDonations }}</h3>
            </div>
        </section>

        <!-- Filter -->
        <section class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm mb-6">
            <form method="GET" action="{{ route('admin.activity-monitor') }}" class="flex flex-wrap gap-3 items-end">
                <!-- Search -->
                <div class="flex-1 min-w-[180px]">
                    <label class="text-xs font-semibold text-[#666] mb-1 block">Cari Kegiatan</label>
                    <input type="text" name="search" value="{{ $search }}"
                           placeholder="Nama kegiatan..."
                           class="w-full rounded-xl border border-[#e5ddd7] px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#003527]">
                </div>

                <!-- Filter Org -->
                <div class="min-w-[180px]">
                    <label class="text-xs font-semibold text-[#666] mb-1 block">Organisasi</label>
                    <select name="org_id" class="w-full rounded-xl border border-[#e5ddd7] px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#003527]">
                        <option value="">Semua Organisasi</option>
                        @foreach($organizations as $org)
                            <option value="{{ $org->id }}" {{ $orgId == $org->id ? 'selected' : '' }}>
                                {{ $org->organization_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Tipe -->
                <div class="min-w-[140px]">
                    <label class="text-xs font-semibold text-[#666] mb-1 block">Tipe</label>
                    <select name="type" class="w-full rounded-xl border border-[#e5ddd7] px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#003527]">
                        <option value="">Semua Tipe</option>
                        <option value="volunteer" {{ $type === 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                        <option value="donation"  {{ $type === 'donation'  ? 'selected' : '' }}>Donasi</option>
                    </select>
                </div>

                <!-- Filter Status Donasi -->
                <div class="min-w-[140px]">
                    <label class="text-xs font-semibold text-[#666] mb-1 block">Status Donasi</label>
                    <select name="status" class="w-full rounded-xl border border-[#e5ddd7] px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#003527]">
                        <option value="">Semua Status</option>
                        <option value="open"        {{ $status === 'open'        ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ $status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed"   {{ $status === 'completed'   ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled"   {{ $status === 'cancelled'   ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                            class="rounded-xl bg-[#003527] text-white px-5 py-2 text-sm font-semibold hover:opacity-90 transition">
                        Filter
                    </button>
                    <a href="{{ route('admin.activity-monitor') }}"
                       class="rounded-xl border border-[#e5ddd7] text-[#666] px-5 py-2 text-sm font-semibold hover:bg-[#f6ece6] transition">
                        Reset
                    </a>
                </div>
            </form>
        </section>

        <!-- Activity List -->
        <section>
            <p class="text-sm text-[#666] mb-4">
                Menampilkan <span class="font-bold text-[#003527]">{{ $activities->count() }}</span> kegiatan
            </p>

            @forelse($activities as $item)
                <div class="bg-white rounded-2xl border border-[#e5ddd7] shadow-sm mb-4 p-5 flex flex-col sm:flex-row sm:items-start gap-4">

                    <!-- Icon -->
                    <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center
                        {{ $item->type === 'volunteer' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700' }}">
                        <span class="material-symbols-outlined text-xl">
                            {{ $item->type === 'volunteer' ? 'volunteer_activism' : 'inventory_2' }}
                        </span>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <!-- Badge tipe -->
                            @if($item->type === 'volunteer')
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">Volunteer</span>
                            @else
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700">Donasi</span>
                            @endif

                            <!-- Badge status -->
                            @if($item->type === 'donation')
                                @if($item->status === 'open')
                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-bold bg-sky-100 text-sky-700">Open</span>
                                @elseif($item->status === 'in_progress')
                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">In Progress</span>
                                @elseif($item->status === 'completed')
                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700">Completed</span>
                                @else
                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700">Cancelled</span>
                                @endif
                            @else
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-600 capitalize">{{ $item->status }}</span>
                            @endif
                        </div>

                        <h4 class="font-bold text-[#1f1b17] text-base truncate">{{ $item->title }}</h4>

                        <p class="text-sm text-[#666] mt-0.5">
                            <span class="font-medium text-[#003527]">{{ $item->org_name }}</span>
                        </p>

                        @if($item->description)
                            <p class="text-sm text-[#666] mt-1 line-clamp-2">{{ $item->description }}</p>
                        @endif

                        <div class="flex flex-wrap gap-4 mt-3 text-xs text-[#888]">
                            @if($item->type === 'volunteer')
                                @if($item->event_date)
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">calendar_today</span>
                                        Event: {{ \Carbon\Carbon::parse($item->event_date)->format('d M Y') }}
                                    </span>
                                @endif
                                @if($item->deadline)
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">schedule</span>
                                        Deadline: {{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}
                                    </span>
                                @endif
                                @if($item->volunteer_quota)
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">group</span>
                                        Kuota: {{ $item->volunteer_quota }}
                                    </span>
                                @endif
                                @if($item->location)
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">location_on</span>
                                        {{ $item->location }}
                                    </span>
                                @endif
                            @endif

                            @if($item->type === 'donation' && $item->item_name)
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">inventory_2</span>
                                    Barang: {{ $item->item_name }}
                                </span>
                            @endif

                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">access_time</span>
                                {{ $item->created_at ? $item->created_at->diffForHumans() : '-' }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-[#e5ddd7] p-12 text-center shadow-sm">
                    <span class="material-symbols-outlined text-5xl text-[#ccc]">search_off</span>
                    <p class="mt-3 text-[#666] font-semibold">Tidak ada kegiatan yang ditemukan.</p>
                    <p class="text-sm text-[#999] mt-1">Coba ubah filter atau reset pencarian.</p>
                </div>
            @endforelse
        </section>

    </main>
</div>

</body>
</html>
