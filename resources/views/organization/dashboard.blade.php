<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Organisasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Eco-DON</a>

            <div class="ms-auto d-flex align-items-center gap-3">
                <span class="text-white">
                    Halo, {{ auth()->user()->name ?? 'Organisasi' }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="mb-4">
            <h2 class="fw-bold mb-1">Dashboard Organisasi</h2>
            <p class="text-muted mb-0">Pantau status verifikasi dan data organisasi kamu di sini.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Status Verifikasi -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Status Verifikasi</h5>

                        @if($organization->verification_status === 'pending')
                            <span class="badge bg-warning text-dark fs-6 px-3 py-2">Pending</span>
                            <p class="text-muted mt-3 mb-0">
                                Data organisasi kamu sedang menunggu proses verifikasi admin.
                            </p>
                        @elseif($organization->verification_status === 'approved')
                            <span class="badge bg-success fs-6 px-3 py-2">Approved</span>
                            <p class="text-muted mt-3 mb-0">
                                Selamat, organisasi kamu sudah terverifikasi.
                            </p>
                        @elseif($organization->verification_status === 'rejected')
                            <span class="badge bg-danger fs-6 px-3 py-2">Rejected</span>
                            <p class="text-muted mt-3 mb-0">
                                Verifikasi ditolak. Silakan cek catatan admin di bawah.
                            </p>
                        @else
                            <span class="badge bg-secondary fs-6 px-3 py-2">
                                {{ ucfirst($organization->verification_status ?? 'Unknown') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Catatan Admin -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Catatan Verifikasi Admin</h5>
                        <div class="p-3 rounded bg-light" style="min-height: 120px;">
                            {{ $organization->verification_note ?: 'Belum ada catatan dari admin.' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Organisasi -->
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold mb-0">Data Organisasi</h5>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Organisasi</label>
                                <div class="form-control bg-light">{{ $organization->organization_name }}</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tipe Organisasi</label>
                                <div class="form-control bg-light">{{ $organization->organization_type }}</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tahun Berdiri</label>
                                <div class="form-control bg-light">{{ $organization->founded_year }}</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. Telepon Organisasi</label>
                                <div class="form-control bg-light">{{ $organization->org_phone }}</div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Alamat</label>
                                <div class="form-control bg-light">{{ $organization->address }}</div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <div class="form-control bg-light" style="min-height: 90px;">
                                    {{ $organization->description ?: '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data PIC -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold mb-0">Data PIC</h5>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama PIC</label>
                            <div class="form-control bg-light">{{ $organization->pic_name }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email PIC</label>
                            <div class="form-control bg-light">{{ $organization->pic_email }}</div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-semibold">No. Telepon PIC</label>
                            <div class="form-control bg-light">{{ $organization->pic_phone }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Rekening -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold mb-0">Data Rekening</h5>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Bank</label>
                            <div class="form-control bg-light">{{ $organization->bank_name }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Atas Nama</label>
                            <div class="form-control bg-light">{{ $organization->account_holder_name }}</div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-semibold">Nomor Rekening</label>
                            <div class="form-control bg-light">{{ $organization->rekening_number }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aksi -->
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex flex-wrap gap-2">
                        <a href="#" class="btn btn-success">Edit Profil</a>
                        <a href="#" class="btn btn-outline-secondary">Lihat Donasi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>