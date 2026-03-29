<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EcoDon</title>
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
            max-width: 400px;
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

        .subtitle {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 24px;
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

        .alert-success {
            background: #e7f6ec;
            color: #2f6f4f;
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
            margin-top: 10px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <p class="subtitle">Masuk ke akun EcoDon kamu</p>

        {{-- Success message --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error message --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Login gagal:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <div class="footer-text">
            Belum punya akun?
            <a href="{{ url('/register') }}">Register</a>
        </div>
    </div>
</body>
</html>