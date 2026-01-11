@extends('layouts.app')

@section('title', 'Edit Profil - SportifyField')

@section('content')
    <section class="dashboard-section">
        <div class="container">
            <h1 class="dashboard-title">Edit Profil</h1>

            <div class="dashboard-wrapper" style="display: block;">
                <!-- Update Profile Information -->
                <div class="dashboard-card" style="margin-bottom: 24px;">
                    <div class="card-header">
                        <i class="fas fa-user-edit card-icon"></i>
                        <h3 class="card-title">Informasi Profil</h3>
                    </div>
                    <div class="p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="dashboard-card" style="margin-bottom: 24px;">
                    <div class="card-header">
                        <i class="fas fa-lock card-icon"></i>
                        <h3 class="card-title">Update Password</h3>
                    </div>
                    <div class="p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <i class="fas fa-trash-alt card-icon" style="color: #DC2626;"></i>
                        <h3 class="card-title" style="color: #DC2626;">Hapus Akun</h3>
                    </div>
                    <div class="p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection