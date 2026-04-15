<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Organisasi - EcoDon Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, .brand-font { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-[#fff8f5] text-[#1f1b17] min-h-screen">
<div class="min-h-screen flex">
    <aside class="hidden lg:flex w-72 bg-[#f6ece6] border-r border-[#e5ddd7] flex-col p-6">
        <div class="mb-8">
            <h1 class="text-2xl font-extrabold text-[#003527] brand-font">EcoDon Admin</h1>
            <p class="text-sm text-[#666] mt-1">Dashboard Administrator</p>
        </div>

        <div class="mt-auto pt-8">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full px-4 py-3 rounded-xl border border-[#d8ccc5] text-[#003527] font-semibold hover:bg-[#eadfd8] transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-4 sm:p-6 lg:p-10">
        <div class="mb-6">
            <a href="{{ route('admin.organizations.index') }}"
               class="inline-flex items-center text-sm font-semibold text-[#003527] hover:underline">
                ← Kembali ke Organizations
            </a>
        </div>

        @if (session('success'))
            <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-8">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#003527]">
                Detail Verifikasi Organisasi
            </h2>
            <p class="mt-2 text-sm sm:text-base text-[#404944]">
                Tinjau data organisasi sebelum approve atau reject.
            </p>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <section class="xl:col-span-2 bg-white rounded-2xl border border-[#e5ddd7] p-6 shadow-sm">
                <h3 class="text-xl font-bold text-[#003527] mb-5">Informasi Organisasi</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <p class="text-sm text-[#666]">Nama Organisasi</p>
                        <p class="mt-1 font-semibold">{{ $organization->organization_name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-[#666]">Jenis Organisasi</p>
                        <p class="mt-1 font-semibold">{{ $organization->organization_type ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-[#666]">Nama PIC</p>
                        <p class="mt-1 font-semibold">{{ $organization->pic_name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-[#666]">Email PIC</p>
                        <p class="mt-1 font-semibold">{{ $organization->pic_email ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-[#666]">No. HP PIC</p>
                        <p class="mt-1 font-semibold">{{ $organization->pic_phone ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-[#666]">No. Telepon Organisasi</p>
                        <p class="mt-1 font-semibold">{{ $organization->org_phone ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-[#666]">Tahun Berdiri</p>
                        <p class="mt-1 font-semibold">{{ $organization->founded_year ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-[#666]">Status Verifikasi</p>
                        <p class="mt-1">
                            @if($organization->verification_status === 'pending')
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">
                                    Pending
                                </span>
                            @elseif($organization->verification_status === 'verified')
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                    Verified
                                </span>
                            @elseif($organization->verification_status === 'rejected')
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                    Rejected
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700">
                                    -
                                </span>
                            @endif
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-sm text-[#666]">Alamat</p>
                        <p class="mt-1 font-semibold">{{ $organization->address ?? '-' }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-sm text-[#666]">Deskripsi</p>
                        <p class="mt-1 font-semibold">{{ $organization->description ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-[#666]">Bank</p>
                        <p class="mt-1 font-semibold">{{ $organization->bank_name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-[#666]">Atas Nama</p>
                        <p class="mt-1 font-semibold">{{ $organization->account_holder_name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-[#666]">Nomor Rekening</p>
                        <p class="mt-1 font-semibold">{{ $organization->rekening_number ?? '-' }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-sm text-[#666]">Bukti Bank</p>

                        @if ($organization->bank_proof)
                            @php
                                $filePath = asset('storage/' . $organization->bank_proof);
                            @endphp

                            <div class="mt-3 rounded-2xl border border-[#e5ddd7] p-4 bg-[#fcf8f6]">
                                <img
                                    src="{{ $filePath }}"
                                    alt="Bukti Bank"
                                    class="w-full max-w-md rounded-xl border border-[#e5ddd7] shadow-sm object-cover"
                                >

                                <div class="mt-3 flex gap-3 flex-wrap">
                                    <a href="{{ $filePath }}" target="_blank"
                                    class="inline-flex items-center px-4 py-2 rounded-lg bg-[#003527] text-white text-sm font-semibold hover:opacity-90">
                                        Lihat Gambar
                                    </a>

                                    <a href="{{ $filePath }}" download
                                    class="inline-flex items-center px-4 py-2 rounded-lg border border-[#003527] text-[#003527] text-sm font-semibold hover:bg-[#f6ece6]">
                                        Download
                                    </a>
                                </div>
                            </div>
                        @else
                            <p class="mt-1 font-semibold">-</p>
                        @endif
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-sm text-[#666]">Catatan Verifikasi</p>
                        <p class="mt-1 font-semibold">{{ $organization->verification_note ?? '-' }}</p>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-2xl border border-[#e5ddd7] p-6 shadow-sm">
                <h3 class="text-xl font-bold text-[#003527] mb-5">Aksi Verifikasi</h3>

                @if ($organization->verification_status === 'pending')
                    <form action="{{ route('admin.organizations.approve', $organization->id) }}" method="POST" class="mb-4">
                        @csrf
                        <button type="submit"
                                class="w-full px-4 py-3 rounded-xl bg-[#003527] text-white font-semibold hover:opacity-90 transition">
                            Approve Organisasi
                        </button>
                    </form>

                    <form action="{{ route('admin.organizations.reject', $organization->id) }}" method="POST" class="space-y-3">
                        @csrf
                        <div>
                            <label for="note" class="block text-sm font-semibold text-[#1f1b17] mb-2">
                                Alasan Penolakan
                            </label>
                            <textarea
                                name="note"
                                id="note"
                                rows="5"
                                class="w-full rounded-xl border border-[#d8ccc5] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#003527]"
                                placeholder="Tulis alasan penolakan..."
                                required
                            >{{ old('note') }}</textarea>

                            @error('note')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="w-full px-4 py-3 rounded-xl border border-red-300 text-red-700 font-semibold hover:bg-red-50 transition">
                            Reject Organisasi
                        </button>
                    </form>
                @else
                    <div class="rounded-xl border border-[#e5ddd7] bg-[#f9f5f2] p-4 text-sm text-[#666]">
                        Organisasi ini sudah diproses.
                    </div>
                @endif
            </section>
        </div>
    </main>
</div>
</body>
</html>