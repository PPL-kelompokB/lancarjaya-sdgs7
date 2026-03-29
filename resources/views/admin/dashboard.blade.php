<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EcoDon</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background-color: #f4f7f4;
            color: #333;
        }

        .navbar {
            background-color: #2f6f4f;
            color: white;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
            font-size: 22px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            background: rgba(255,255,255,0.15);
            padding: 8px 14px;
            border-radius: 8px;
        }

        .container {
            max-width: 1100px;
            margin: 28px auto;
            padding: 0 16px;
        }

        .welcome-box {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.06);
            margin-bottom: 22px;
        }

        .welcome-box h3 {
            margin-top: 0;
            color: #2f6f4f;
        }

        .welcome-box p {
            margin-bottom: 0;
            color: #666;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 24px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        }

        .card h4 {
            margin: 0 0 8px;
            color: #666;
            font-size: 14px;
            font-weight: normal;
        }

        .card .number {
            font-size: 28px;
            font-weight: bold;
            color: #2f6f4f;
        }

        .section {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.06);
            margin-bottom: 24px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            gap: 12px;
        }

        .section-header h3 {
            margin: 0;
            color: #2f6f4f;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            background-color: #2f6f4f;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
        }

        .btn:hover {
            background-color: #25593f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        th {
            background-color: #f8faf8;
            color: #444;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-pending {
            background: #fff4d6;
            color: #9a6b00;
        }

        .badge-verified {
            background: #e7f6ec;
            color: #2f6f4f;
        }

        .badge-rejected {
            background: #fdeaea;
            color: #a12626;
        }

        .empty-note {
            color: #777;
            font-size: 14px;
            margin: 0;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>EcoDon Admin</h2>
        <a href="{{ url('/logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
    </div>

    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="container">
        <div class="welcome-box">
            <h3>Selamat Datang, Admin</h3>
            <p>Kelola verifikasi organisasi sosial dan pantau aktivitas utama platform EcoDon dari sini.</p>
        </div>

        <div class="stats-grid">
            <div class="card">
                <h4>Total User</h4>
                <div class="number">{{ $totalUsers ?? 0 }}</div>
            </div>

            <div class="card">
                <h4>Total Organisasi</h4>
                <div class="number">{{ $totalOrganizations ?? 0 }}</div>
            </div>

            <div class="card">
                <h4>Organisasi Pending</h4>
                <div class="number">{{ $pendingOrganizationsCount ?? 0 }}</div>
            </div>
        </div>

        <div class="section">
            <div class="section-header">
                <h3>Menu Admin</h3>
                <a href="{{ url('/admin/organizations') }}" class="btn">Verifikasi Organisasi</a>
            </div>

            <p class="empty-note">
                Gunakan dashboard ini untuk melihat ringkasan sistem dan memproses organisasi yang menunggu verifikasi.
            </p>
        </div>

        <div class="section">
            <div class="section-header">
                <h3>Daftar Organisasi Pending</h3>
                <a href="{{ url('/admin/organizations') }}" class="btn">Lihat Semua</a>
            </div>

            @if(isset($organizations) && count($organizations) > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Organisasi</th>
                            <th>Jenis</th>
                            <th>Email PIC</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($organizations as $index => $organization)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $organization->organization_name }}</td>
                                <td>{{ $organization->organization_type }}</td>
                                <td>{{ $organization->pic_email }}</td>
                                <td>
                                    <span class="badge badge-pending">
                                        {{ ucfirst($organization->verification_status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="empty-note">Belum ada organisasi yang menunggu verifikasi.</p>
            @endif
        </div>
    </div>
</body>
</html>