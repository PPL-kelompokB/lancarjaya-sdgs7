<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Organizations | EcoDon Admin</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: "#fff8f5",
                        surface: "#fff8f5",
                        primary: "#003527",
                        secondary: "#006c49",
                        surfaceContainer: "#f6ece6",
                        surfaceContainerLow: "#fcf2eb",
                        surfaceContainerHigh: "#f0e6e0",
                        outlineVariant: "#bfc9c3",
                        textMain: "#1f1b17",
                        textMuted: "#404944",
                        danger: "#ba1a1a",
                    },
                    fontFamily: {
                        headline: ["Manrope", "sans-serif"],
                        body: ["Inter", "sans-serif"],
                    },
                },
            },
        };
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Manrope', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background text-textMain antialiased">
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
            <div class="lg:hidden mb-6">
                <h1 class="text-2xl font-extrabold text-[#003527]">EcoDon Admin</h1>
                <p class="text-sm text-[#666]">Dashboard Administrator</p>
            </div>

            <header class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center gap-8">
                    <h1 class="text-lg font-black tracking-tighter text-primary">Organization Manager</h1>

                    <form method="GET" action="{{ route('admin.organizations.index') }}" class="relative">
                        <span class="material-symbols-outlined absolute inset-y-0 left-0 flex items-center pl-3 text-textMuted">search</span>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari organisasi..."
                            class="w-64 rounded-full bg-surfaceContainerLow py-2 pl-10 pr-4 text-sm font-medium outline-none ring-0 focus:ring-2 focus:ring-secondary"
                        />
                    </form>
                </div>
            </header>

            <div class="space-y-10">
                <div class="flex flex-col items-end justify-between gap-6 md:flex-row">
                    <div class="max-w-2xl">
                        <h2 class="text-5xl font-extrabold leading-tight tracking-tight text-primary">
                            Organization <span class="italic text-secondary">Verification</span>
                        </h2>
                        <p class="mt-4 text-lg font-medium leading-relaxed text-textMuted">
                            Kelola seluruh organisasi yang mendaftar, cek status verifikasi, dan buka detail untuk approve atau reject.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-3 md:grid-cols-4">
                        <div class="rounded-2xl bg-surfaceContainerHigh px-5 py-4 text-center">
                            <div class="text-2xl font-black text-primary">{{ $totalOrganizations }}</div>
                            <div class="text-[10px] font-bold uppercase tracking-widest text-textMuted">Total</div>
                        </div>
                        <div class="rounded-2xl bg-yellow-50 px-5 py-4 text-center">
                            <div class="text-2xl font-black text-yellow-700">{{ $pendingCount }}</div>
                            <div class="text-[10px] font-bold uppercase tracking-widest text-textMuted">Pending</div>
                        </div>
                        <div class="rounded-2xl bg-green-50 px-5 py-4 text-center">
                            <div class="text-2xl font-black text-green-700">{{ $verifiedCount }}</div>
                            <div class="text-[10px] font-bold uppercase tracking-widest text-textMuted">Verified</div>
                        </div>
                        <div class="rounded-2xl bg-red-50 px-5 py-4 text-center">
                            <div class="text-2xl font-black text-red-700">{{ $rejectedCount }}</div>
                            <div class="text-[10px] font-bold uppercase tracking-widest text-textMuted">Rejected</div>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-hidden rounded-[28px] border border-outlineVariant/20 bg-white shadow-[0px_20px_40px_rgba(31,27,23,0.06)]">
                    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-outlineVariant/10 bg-surfaceContainerLow/60 p-6">
                        <form method="GET" action="{{ route('admin.organizations.index') }}" class="flex flex-wrap items-center gap-4">
                            <input type="hidden" name="search" value="{{ request('search') }}">

                            <div class="relative">
                                <select name="type" class="appearance-none rounded-full border border-outlineVariant/30 bg-white py-2 pl-4 pr-10 text-sm font-semibold outline-none focus:border-transparent focus:ring-2 focus:ring-secondary">
                                    <option value="">Semua Tipe</option>
                                    @foreach ($organizationTypes as $organizationType)
                                        <option value="{{ $organizationType }}" {{ request('type') == $organizationType ? 'selected' : '' }}>
                                            {{ $organizationType }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined pointer-events-none absolute right-3 top-2.5 text-sm text-textMuted">expand_more</span>
                            </div>

                            <div class="relative">
                                <select name="status" class="appearance-none rounded-full border border-outlineVariant/30 bg-white py-2 pl-4 pr-10 text-sm font-semibold outline-none focus:border-transparent focus:ring-2 focus:ring-secondary">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                <span class="material-symbols-outlined pointer-events-none absolute right-3 top-2.5 text-sm text-textMuted">expand_more</span>
                            </div>

                            <button type="submit"
                                    class="rounded-full bg-primary px-4 py-2 text-sm font-bold text-white transition hover:opacity-90">
                                Filter
                            </button>

                            <a href="{{ route('admin.organizations.index') }}"
                               class="rounded-full bg-surfaceContainerHigh px-4 py-2 text-sm font-bold text-textMain transition hover:bg-[#eadfd8]">
                                Reset
                            </a>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse text-left">
                            <thead>
                                <tr class="bg-surfaceContainerLow/30 text-[11px] font-bold uppercase tracking-widest text-textMuted">
                                    <th class="px-8 py-5">Organization Name</th>
                                    <th class="px-8 py-5">Entity Type</th>
                                    <th class="px-8 py-5">PIC</th>
                                    <th class="px-8 py-5">Date Joined</th>
                                    <th class="px-8 py-5">Status</th>
                                    <th class="px-8 py-5 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-surfaceContainer">
                                @forelse ($organizations as $org)
                                    <tr class="group transition-colors hover:bg-surfaceContainerLow">
                                        <td class="px-8 py-6">
                                            <div class="flex items-center gap-4">
                                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                                    <span class="material-symbols-outlined">corporate_fare</span>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-primary">{{ $org->organization_name }}</p>
                                                    <p class="text-xs text-textMuted">{{ $org->pic_email ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-8 py-6">
                                            <span class="rounded-full bg-surfaceContainerHigh px-3 py-1 text-xs font-bold text-textMain">
                                                {{ $org->organization_type ?? '-' }}
                                            </span>
                                        </td>

                                        <td class="px-8 py-6 text-sm text-textMuted">
                                            {{ $org->pic_name ?? '-' }}
                                        </td>

                                        <td class="px-8 py-6 text-sm text-textMuted">
                                            {{ optional($org->created_at)->format('d M Y') ?? '-' }}
                                        </td>

                                        <td class="px-8 py-6">
                                            @if ($org->verification_status === 'verified')
                                                <div class="flex items-center gap-2 text-sm font-bold text-green-700">
                                                    <span class="material-symbols-outlined text-sm">verified</span>
                                                    Verified
                                                </div>
                                            @elseif ($org->verification_status === 'pending')
                                                <div class="flex items-center gap-2 text-sm font-bold text-yellow-700">
                                                    <span class="material-symbols-outlined text-sm">schedule</span>
                                                    Pending
                                                </div>
                                            @elseif ($org->verification_status === 'rejected')
                                                <div class="flex items-center gap-2 text-sm font-bold text-red-700">
                                                    <span class="material-symbols-outlined text-sm">cancel</span>
                                                    Rejected
                                                </div>
                                            @else
                                                <div class="flex items-center gap-2 text-sm font-bold text-gray-600">
                                                    <span class="material-symbols-outlined text-sm">help</span>
                                                    Unknown
                                                </div>
                                            @endif
                                        </td>

                                        <td class="px-8 py-6 text-right">
                                            <a href="{{ route('admin.organizations.show', $org->id) }}"
                                               class="inline-flex items-center gap-2 rounded-full bg-primary px-4 py-2 text-sm font-bold text-white transition hover:opacity-90">
                                                <span class="material-symbols-outlined text-sm">visibility</span>
                                                View Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-8 py-10 text-center text-sm text-textMuted">
                                            Belum ada data organisasi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-between border-t border-outlineVariant/10 bg-surfaceContainerLow/20 px-8 py-6">
                        <span class="text-xs font-medium text-textMuted">
                            Showing {{ $organizations->firstItem() ?? 0 }} - {{ $organizations->lastItem() ?? 0 }} of {{ $organizations->total() }} results
                        </span>

                        <div>
                            {{ $organizations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>