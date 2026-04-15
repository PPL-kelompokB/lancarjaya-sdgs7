<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Voucher - EcoDon</title>

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

        <!-- Header -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#003527]">
                    Manajemen Voucher
                </h2>
                <p class="mt-2 text-sm sm:text-base text-[#404944]">
                    Kelola voucher, pantau status, kuota, dan masa berlaku voucher.
                </p>
            </div>

            <a href="{{ route('admin.vouchers.create') }}"
               class="inline-flex items-center justify-center rounded-full bg-[#003527] px-5 py-3 text-sm font-semibold text-white transition hover:opacity-90">
                + Buat Voucher
            </a>
        </div>

        @if (session('success'))
            <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- Statistik -->
        <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <p class="text-sm text-[#666]">Total Voucher</p>
                <h3 class="mt-2 text-3xl font-extrabold text-[#003527]">{{ $totalVouchers }}</h3>
            </div>

            <div class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <p class="text-sm text-[#666]">Voucher Active</p>
                <h3 class="mt-2 text-3xl font-extrabold text-green-700">{{ $activeVouchers }}</h3>
            </div>

            <div class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <p class="text-sm text-[#666]">Voucher Inactive</p>
                <h3 class="mt-2 text-3xl font-extrabold text-yellow-600">{{ $inactiveVouchers }}</h3>
            </div>

            <div class="bg-white rounded-2xl border border-[#e5ddd7] p-5 shadow-sm">
                <p class="text-sm text-[#666]">Voucher Expired</p>
                <h3 class="mt-2 text-3xl font-extrabold text-red-600">{{ $expiredVouchers }}</h3>
            </div>
        </section>

        <!-- Table Card -->
        <section class="bg-white rounded-2xl border border-[#e5ddd7] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] text-left">
                    <thead class="bg-[#f6ece6] text-sm text-[#1f1b17]">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Voucher</th>
                            <th class="px-6 py-4 font-semibold">Points</th>
                            <th class="px-6 py-4 font-semibold">Quota</th>
                            <th class="px-6 py-4 font-semibold">End Date</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 text-right font-semibold">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($vouchers as $voucher)
                            <tr class="border-t border-[#eee2db]">
                                <!-- Voucher -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        @if($voucher->image)
                                            <img src="{{ asset('storage/' . $voucher->image) }}"
                                                 alt="{{ $voucher->title }}"
                                                 class="w-14 h-14 rounded-xl object-cover border border-[#e5ddd7]">
                                        @else
                                            <div class="w-14 h-14 rounded-xl bg-[#f6ece6] border border-[#e5ddd7] flex items-center justify-center">
                                                <span class="material-symbols-outlined text-[#666]">image</span>
                                            </div>
                                        @endif

                                        <div>
                                            <p class="font-bold text-[#1f1b17]">{{ $voucher->title }}</p>
                                            <p class="mt-1 text-sm text-[#666] line-clamp-2">{{ $voucher->description }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Points -->
                                <td class="px-6 py-4 text-sm font-medium text-[#1f1b17]">
                                    {{ $voucher->points_cost }}
                                </td>

                                <!-- Quota -->
                                <td class="px-6 py-4 text-sm font-medium text-[#1f1b17]">
                                    {{ $voucher->quota }}
                                </td>

                                <!-- End Date -->
                                <td class="px-6 py-4 text-sm text-[#666]">
                                    {{ $voucher->end_date }}
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @if($voucher->status == 'active')
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                            Active
                                        </span>
                                    @elseif($voucher->status == 'inactive')
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">
                                            Inactive
                                        </span>
                                    @else
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                            Expired
                                        </span>
                                    @endif
                                </td>

                                <!-- Action -->
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.vouchers.edit', $voucher->id) }}"
                                           class="inline-flex items-center rounded-lg border border-[#d8ccc5] px-4 py-2 text-sm font-semibold text-[#003527] transition hover:bg-[#f6ece6]">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Yakin ingin menghapus voucher ini?')"
                                                    class="inline-flex items-center rounded-lg border border-red-200 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-50">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-sm text-[#666]">
                                    Belum ada voucher
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $vouchers->links() }}
        </div>

    </main>
</div>

</body>
</html>