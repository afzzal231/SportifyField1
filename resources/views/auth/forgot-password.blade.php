@extends('layouts.app')

@section('title', 'Lupa Password - SportifyField')

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
            margin-bottom: 24px;
        }

        .auth-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .auth-header p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.5;
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
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: color 0.2s;
        }

        .auth-footer a:hover {
            color: #DC2626;
        }

        .error-message {
            color: #DC2626;
            font-size: 12px;
            margin-top: 4px;
        }

        .status-message {
            background-color: #DEF7EC;
            color: #03543F;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            border: 1px solid #BCF0DA;
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
                    <h1>Lupa Password</h1>
                    <p>Masukkan email Anda dan kami akan mengirimkan link untuk mereset password Anda.</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="status-message">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group-auth">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="input-auth" placeholder="contoh@email.com">
                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-auth-primary">
                        Kirim Link Reset Password
                    </button>
                </form>

                <div class="auth-footer">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-arrow-left"></i> Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection