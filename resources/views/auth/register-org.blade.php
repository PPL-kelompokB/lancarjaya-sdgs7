<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Organization - EcoDon</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background-color: #f4f7f4;
            padding: 30px 15px;
        }

        .container {
            width: 100%;
            max-width: 760px;
            margin: 0 auto;
            background: #fff;
            padding: 28px;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 6px;
            color: #2f6f4f;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 24px;
        }

        h3 {
            margin-top: 28px;
            margin-bottom: 14px;
            color: #2f6f4f;
            border-bottom: 1px solid #e5e5e5;
            padding-bottom: 8px;
            font-size: 18px;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .alert-danger {
            background: #fdeaea;
            color: #a12626;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2f6f4f;
        }

        .btn {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background-color: #2f6f4f;
            color: white;
            font-size: 15px;
            cursor: pointer;
            margin-top: 18px;
        }

        .btn:hover {
            background-color: #25593f;
        }

        .footer-text {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
        }

        .footer-text a {
            color: #2f6f4f;
            text-decoration: none;
            font-weight: bold;
        }

        ul {
            margin: 8px 0 0;
            padding-left: 18px;
        }

        .top-link {
            display: inline-block;
            margin-bottom: 18px;
            color: #2f6f4f;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        @media (max-width: 640px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url('/register') }}" class="top-link">← Kembali ke Register User</a>

        <h2>Register Organisasi Sosial</h2>
        <p class="subtitle">Lengkapi data akun, organisasi, dan PIC untuk proses verifikasi admin.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/register/organization') }}" method="POST">
            @csrf

            <h3>Data Akun</h3>
            <div class="grid">
                <div class="form-group">
                    <label for="name">Nama Akun</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Akun</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>

            <h3>Data Organisasi</h3>
            <div class="grid">
                <div class="form-group">
                    <label for="organization_name">Nama Organisasi</label>
                    <input type="text" id="organization_name" name="organization_name" value="{{ old('organization_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="organization_type">Jenis Organisasi</label>
                    <select id="organization_type" name="organization_type" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Yayasan" {{ old('organization_type') == 'Yayasan' ? 'selected' : '' }}>Yayasan</option>
                        <option value="Komunitas" {{ old('organization_type') == 'Komunitas' ? 'selected' : '' }}>Komunitas</option>
                        <option value="NGO" {{ old('organization_type') == 'NGO' ? 'selected' : '' }}>NGO</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="founded_year">Tahun Berdiri</label>
                    <input type="text" id="founded_year" name="founded_year" value="{{ old('founded_year') }}" placeholder="Contoh: 2020">
                </div>

                <div class="form-group">
                    <label for="org_phone">Nomor Telepon Organisasi</label>
                    <input type="text" id="org_phone" name="org_phone" value="{{ old('org_phone') }}" required>
                </div>

                <div class="form-group full">
                    <label for="address">Alamat Organisasi</label>
                    <textarea id="address" name="address" required>{{ old('address') }}</textarea>
                </div>

                <div class="form-group full">
                    <label for="description">Deskripsi Singkat</label>
                    <textarea id="description" name="description" placeholder="Jelaskan singkat tentang organisasi Anda">{{ old('description') }}</textarea>
                </div>
            </div>

            <h3>Data Pengurus / PIC</h3>
            <div class="grid">
                <div class="form-group">
                    <label for="pic_name">Nama PIC</label>
                    <input type="text" id="pic_name" name="pic_name" value="{{ old('pic_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="pic_email">Email PIC</label>
                    <input type="email" id="pic_email" name="pic_email" value="{{ old('pic_email') }}" required>
                </div>

                <div class="form-group">
                    <label for="pic_phone">No HP PIC</label>
                    <input type="text" id="pic_phone" name="pic_phone" value="{{ old('pic_phone') }}" required>
                </div>
            </div>

            <h3>Data Rekening (Opsional)</h3>
            <div class="grid">
                <div class="form-group">
                    <label for="bank_name">Nama Bank</label>
                    <input type="text" id="bank_name" name="bank_name" value="{{ old('bank_name') }}">
                </div>

                <div class="form-group">
                    <label for="account_holder_name">Nama Pemilik Rekening</label>
                    <input type="text" id="account_holder_name" name="account_holder_name" value="{{ old('account_holder_name') }}">
                </div>

                <div class="form-group full">
                    <label for="rekening_number">Nomor Rekening</label>
                    <input type="text" id="rekening_number" name="rekening_number" value="{{ old('rekening_number') }}">
                </div>
            </div>

            <button type="submit" class="btn">Daftar sebagai Organisasi</button>
        </form>

        <div class="footer-text">
            Sudah punya akun?
            <a href="{{ url('/login') }}">Login</a>
        </div>
    </div>
</body>
</html>