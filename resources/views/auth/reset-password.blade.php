@extends('layouts.app')

@section('title', 'Reset Password - SportifyField')

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
                    <h1>Buat Password Baru</h1>
                    <p>Silakan masukkan password baru untuk akun Anda.</p>
                </div>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="form-group-auth">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required
                            autofocus class="input-auth" placeholder="Email Anda">
                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group-auth">
                        <label for="password">Password Baru</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="input-auth" placeholder="Minimal 8 karakter">
                        @error('password')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group-auth">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            autocomplete="new-password" class="input-auth" placeholder="Ulangi password baru">
                        @error('password_confirmation')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-auth-primary">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection