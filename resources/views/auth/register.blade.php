<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EcoDon</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background-color: #f4f7f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 430px;
            background: #ffffff;
            padding: 28px;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        h2 {
            margin-top: 0;
            text-align: center;
            color: #2f6f4f;
        }

        p.subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .alert-danger {
            background: #fdeaea;
            color: #a12626;
        }

        .form-group {
            margin-bottom: 14px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #2f6f4f;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #2f6f4f;
            color: white;
            font-size: 15px;
            cursor: pointer;
            margin-top: 8px;
        }

        .btn:hover {
            background-color: #25593f;
        }

        .alt-box {
            margin-top: 18px;
            padding: 14px;
            background: #f7faf8;
            border: 1px solid #dfe9e2;
            border-radius: 10px;
            text-align: center;
        }

        .alt-box p {
            margin: 0 0 10px;
            font-size: 14px;
            color: #555;
        }

        .alt-link {
            display: inline-block;
            text-decoration: none;
            color: #2f6f4f;
            font-weight: bold;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Register User</h2>
        <p class="subtitle">Buat akun sebagai user biasa</p>

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

        <form action="{{ url('/register') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}">
            </div>

            <div class="form-group">
                <label for="phone">No HP</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn">Daftar sebagai User</button>
        </form>

        <div class="alt-box">
            <p>Mau daftar sebagai organisasi sosial?</p>
            <a href="{{ url('/register/organization') }}" class="alt-link">Lanjut ke Register Organisasi</a>
        </div>

        <div class="footer-text">
            Sudah punya akun?
            <a href="{{ url('/login') }}">Login</a>
        </div>
    </div>
</body>
</html>