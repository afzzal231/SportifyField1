@extends('layouts.app')

@section('title', 'Login - SportifyField')

@push('styles')
    <style>
        .auth-section {
            padding: 140px 0 60px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: calc(100vh - 200px);
        }

        .auth-container {
            max-width: 420px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 40px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .auth-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .auth-header p {
            font-size: 14px;
            color: #6b7280;
        }

        .form-group-auth {
            margin-bottom: 20px;
        }

        .form-group-auth label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }

        .input-auth {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            color: #374151;
            transition: all 0.2s;
        }

        .input-auth:focus {
            outline: none;
            border-color: #DC2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .input-auth {
            padding-right: 45px;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #9CA3AF;
            font-size: 16px;
            padding: 0;
            transition: color 0.2s;
        }

        .password-toggle:hover {
            color: #6B7280;
        }

        .btn-auth-primary {
            width: 100%;
            padding: 14px;
            background: #DC2626;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-auth-primary:hover {
            background: #B91C1C;
        }

        .auth-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #6b7280;
        }

        .auth-footer a {
            color: #DC2626;
            text-decoration: none;
            font-weight: 500;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .remember-forgot label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #6b7280;
        }

        .remember-forgot a {
            font-size: 13px;
            color: #DC2626;
            text-decoration: none;
        }

        .error-message {
            color: #DC2626;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>
@endpush

@section('content')
    <section class="auth-section">
        <div class="container">
            <div class="auth-container">
                <div class="auth-header">
                    <img src="{{ asset('images/Navbar.png') }}" alt="SportifyField Logo"
                        style="width: 60px; height: 60px; margin: 0 auto 16px; display: block;">
                    <h1>Selamat Datang</h1>
                    <p>Login untuk melakukan booking lapangan</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group-auth">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            autocomplete="username" class="input-auth" placeholder="Masukkan email Anda">
                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group-auth">
                        <label for="password">Password</label>
                        <div class="password-wrapper">
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="input-auth" placeholder="Masukkan password">
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="remember-forgot">
                        <label>
                            <input type="checkbox" name="remember">
                            Ingat saya
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Lupa password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-auth-primary">Login</button>
                </form>

                <div class="auth-footer">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
@endsection