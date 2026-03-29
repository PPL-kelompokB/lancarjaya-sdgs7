<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Organisasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Verifikasi Organisasi</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Organisasi</th>
                                <th>Tipe</th>
                                <th>PIC</th>
                                <th>Status</th>
                                <th style="width: 140px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($organizations as $index => $org)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td>
                                        <div class="fw-semibold">{{ $org->organization_name }}</div>
                                        <small class="text-muted">{{ $org->address }}</small>
                                    </td>

                                    <td>{{ $org->organization_type }}</td>

                                    <td>
                                        <div>{{ $org->pic_name }}</div>
                                        <small class="text-muted d-block">{{ $org->pic_email }}</small>
                                        <small class="text-muted d-block">{{ $org->pic_phone }}</small>
                                    </td>

                                    <td>
                                        @if($org->verification_status === 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($org->verification_status === 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($org->verification_status === 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($org->verification_status) }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <button type="button"
                                                class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $org->id }}">
                                            Detail
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Detail -->
                                <div class="modal fade" id="detailModal{{ $org->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $org->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel{{ $org->id }}">
                                                    Detail Organisasi
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Nama Organisasi</label>
                                                        <div class="form-control bg-light">{{ $org->organization_name }}</div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Tipe Organisasi</label>
                                                        <div class="form-control bg-light">{{ $org->organization_type }}</div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Tahun Berdiri</label>
                                                        <div class="form-control bg-light">{{ $org->founded_year }}</div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">No. Telepon Organisasi</label>
                                                        <div class="form-control bg-light">{{ $org->org_phone }}</div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Alamat</label>
                                                        <div class="form-control bg-light">{{ $org->address }}</div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Deskripsi</label>
                                                        <div class="form-control bg-light" style="min-height: 90px;">{{ $org->description ?: '-' }}</div>
                                                    </div>

                                                    <div class="col-12">
                                                        <hr>
                                                        <h6 class="fw-bold">Data PIC</h6>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="form-label fw-bold">Nama PIC</label>
                                                        <div class="form-control bg-light">{{ $org->pic_name }}</div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="form-label fw-bold">Email PIC</label>
                                                        <div class="form-control bg-light">{{ $org->pic_email }}</div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="form-label fw-bold">No. Telepon PIC</label>
                                                        <div class="form-control bg-light">{{ $org->pic_phone }}</div>
                                                    </div>

                                                    <div class="col-12">
                                                        <hr>
                                                        <h6 class="fw-bold">Data Rekening</h6>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="form-label fw-bold">Nama Bank</label>
                                                        <div class="form-control bg-light">{{ $org->bank_name }}</div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="form-label fw-bold">Atas Nama</label>
                                                        <div class="form-control bg-light">{{ $org->account_holder_name }}</div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="form-label fw-bold">Nomor Rekening</label>
                                                        <div class="form-control bg-light">{{ $org->rekening_number }}</div>
                                                    </div>

                                                    <div class="col-12">
                                                        <hr>
                                                        <h6 class="fw-bold">Verifikasi</h6>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Status Saat Ini</label>
                                                        <div>
                                                            @if($org->verification_status === 'pending')
                                                                <span class="badge bg-warning text-dark">Pending</span>
                                                            @elseif($org->verification_status === 'approved')
                                                                <span class="badge bg-success">Approved</span>
                                                            @elseif($org->verification_status === 'rejected')
                                                                <span class="badge bg-danger">Rejected</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ ucfirst($org->verification_status) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Catatan Sebelumnya</label>
                                                        <div class="form-control bg-light">{{ $org->verification_note ?: '-' }}</div>
                                                    </div>
                                                </div>

                                                <hr class="my-4">

                                                <form method="POST">
                                                    @csrf

                                                    <div class="mb-3">
                                                        <label for="verification_note_{{ $org->id }}" class="form-label fw-bold">
                                                            Catatan Verifikasi
                                                        </label>
                                                        <textarea
                                                            name="verification_note"
                                                            id="verification_note_{{ $org->id }}"
                                                            class="form-control"
                                                            rows="4"
                                                            placeholder="Masukkan catatan verifikasi...">{{ old('verification_note', $org->verification_note) }}</textarea>
                                                    </div>

                                                    <div class="d-flex gap-2">
                                                        <button
                                                            type="submit"
                                                            formaction="{{ route('admin.organizations.approve', $org->id) }}"
                                                            class="btn btn-success">
                                                            Approve
                                                        </button>

                                                        <button
                                                            type="submit"
                                                            formaction="{{ route('admin.organizations.reject', $org->id) }}"
                                                            class="btn btn-danger">
                                                            Reject
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Belum ada data organisasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>