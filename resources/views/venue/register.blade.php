@extends('layouts.app')

@section('title', 'Daftar Venue - SportifyField')

@push('styles')
    <style>
        .register-venue-hero {
            background: #FAFAFA;
            padding: 100px 0 40px;
            text-align: center;
        }

        .register-venue-hero h1 {
            font-size: 28px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .register-venue-hero p {
            font-size: 14px;
            color: #6B7280;
            max-width: 600px;
            margin: 0 auto;
        }

        .register-venue-content {
            padding: 20px 0 80px;
            background: #FAFAFA;
            min-height: 100vh;
        }

        .register-venue-grid {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 32px;
            max-width: 1000px;
            margin: 0 auto;
            align-items: start;
        }

        .venue-form-card {
            background: white;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            border: 1px solid #E5E7EB;
        }

        .venue-form-card h2 {
            font-size: 16px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 24px;
        }

        .form-section {
            margin-bottom: 32px;
        }

        .form-section-title {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 16px;
        }

        .form-group-venue {
            margin-bottom: 20px;
        }

        .form-group-venue label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #4B5563;
            margin-bottom: 8px;
        }

        .form-group-venue .required {
            color: #DC2626;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            font-size: 14px;
            pointer-events: none;
        }

        .input-wrapper input,
        .input-wrapper select,
        .input-wrapper textarea {
            width: 100%;
            padding: 12px 14px 12px 40px;
            background: #F3F4F6;
            border: 1px solid transparent;
            border-radius: 8px;
            font-size: 14px;
            color: #1F2937;
            transition: all 0.2s;
        }

        .input-wrapper.no-icon input {
            padding-left: 14px;
        }

        .input-wrapper input:focus,
        .input-wrapper select:focus,
        .input-wrapper textarea:focus {
            outline: none;
            background: white;
            border-color: #E5E7EB;
            box-shadow: 0 0 0 4px #F3F4F6;
        }

        .upload-area {
            border: 2px dashed #E5E7EB;
            border-radius: 12px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: white;
        }

        .upload-area:hover {
            border-color: #DC2626;
            background: #FEF2F2;
        }

        .upload-area i {
            font-size: 24px;
            color: #9CA3AF;
            margin-bottom: 12px;
            display: block;
        }

        .upload-area span {
            font-size: 13px;
            color: #6B7280;
            display: block;
            margin-bottom: 4px;
        }

        .upload-area small {
            font-size: 11px;
            color: #9CA3AF;
        }

        .terms-checkbox {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 32px 0;
            font-size: 13px;
            color: #6B7280;
        }

        .terms-checkbox input[type="checkbox"] {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            border: 1px solid #D1D5DB;
            cursor: pointer;
            accent-color: #DC2626;
        }

        .terms-checkbox a {
            color: #DC2626;
            text-decoration: none;
            font-weight: 500;
        }

        .btn-submit-venue {
            width: 100%;
            padding: 14px;
            background: #DC2626;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit-venue:hover {
            background: #B91C1C;
        }

        /* Sidebar Styles */
        .sidebar-card {
            background: white;
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .sidebar-card.promo-card {
            background: #FEF2F2;
            border: 1px solid #FECACA;
        }

        .sidebar-card h3 {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 20px;
        }

        .benefit-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .benefit-item i {
            color: #10B981;
            /* Green check */
            font-size: 18px;
            margin-top: 1px;
        }

        .benefit-item span {
            font-size: 14px;
            color: #4B5563;
            line-height: 1.5;
        }

        .promo-badge {
            display: inline-block;
            background: #DC2626;
            color: white;
            font-size: 13px;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 6px;
            margin-bottom: 12px;
        }

        .promo-desc {
            font-size: 14px;
            color: #374151;
            line-height: 1.5;
            display: block;
        }

        .help-box {
            font-size: 14px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 16px;
        }

        .help-label {
            font-weight: 500;
            color: #111827;
            margin-bottom: 4px;
            display: block;
            font-size: 15px;
        }

        .help-contact {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 12px;
            color: #4B5563;
        }

        .help-contact i {
            font-size: 18px;
            color: #DC2626;
            width: 20px;
            text-align: center;
            margin-bottom: 0;
        }

        .help-contact span {
            color: #1F2937;
            font-weight: 400;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .register-venue-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="register-venue-hero">
        <div class="container">
            <h1>Daftarkan Venue Olahraga Anda</h1>
            <p>Bergabunglah dengan SportifyField dan tingkatkan okupansi venue Anda hingga 300%</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="register-venue-content">
        <div class="container">
            <div class="register-venue-grid">
                <!-- Left Column - Form -->
                <div class="venue-form-card">
                    <div style="font-size: 13px; color: #6B7280; margin-bottom: 24px;">Form Pendaftaran</div>

                    <form action="{{ route('venue.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Informasi Venue -->
                        <div class="form-section">
                            <div class="form-section-title">Informasi Venue</div>

                            <div class="form-group-venue">
                                <label>Nama Venue <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="fas fa-building"></i>
                                    <input type="text" name="venue_name" value="{{ old('venue_name') }}"
                                        placeholder="Arena Futsal Premium" required>
                                </div>
                                @error('venue_name')
                                    <p style="color: #DC2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group-venue">
                                <label>Jenis Olahraga <span class="required">*</span></label>
                                <div class="input-wrapper no-icon">
                                    <select name="sport_type" required>
                                        <option value="" disabled selected>Pilih jenis olahraga</option>
                                        <option value="futsal">Futsal</option>
                                        <option value="badminton">Badminton</option>
                                        <option value="basket">Basket</option>
                                        <option value="tennis">Tennis</option>
                                        <option value="volly">Volly</option>
                                        <option value="renang">Renang</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group-venue">
                                <label>Deskripsi Venue</label>
                                <div class="input-wrapper no-icon">
                                    <textarea name="description"
                                        placeholder="Jelaskan fasilitas dan keunggulan venue Anda..."
                                        style="min-height: 80px; resize: vertical; padding-top: 12px;">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group-venue">
                                <label>Harga per Jam (Rp)</label>
                                <div class="input-wrapper no-icon">
                                    <input type="number" name="price_per_hour" value="{{ old('price_per_hour') }}"
                                        placeholder="150000">
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Pemilik -->
                        <div class="form-section">
                            <div class="form-section-title">Informasi Pemilik</div>

                            <div class="form-group-venue">
                                <label>Nama Lengkap <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="fas fa-user"></i>
                                    <input type="text" name="owner_name" value="{{ old('owner_name', $user->name ?? '') }}"
                                        placeholder="Muthia Luthfi N" required>
                                </div>
                            </div>

                            <div class="form-group-venue">
                                <label>Email <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" name="owner_email"
                                        value="{{ old('owner_email', $user->email ?? '') }}" placeholder="your@email.com"
                                        required>
                                </div>
                            </div>

                            <div class="form-group-venue">
                                <label>Nomor Telepon <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="fas fa-phone"></i>
                                    <input type="tel" name="owner_phone"
                                        value="{{ old('owner_phone', $user->phone ?? '') }}" placeholder="+62 812-3456-7890"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- Lokasi Venue -->
                        <div class="form-section">
                            <div class="form-section-title">Lokasi Venue</div>

                            <div class="form-group-venue">
                                <label>Alamat Lengkap</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <input type="text" name="address" value="{{ old('address') }}"
                                        placeholder="Jl. Sudirman No. 123">
                                </div>
                            </div>

                            <div class="form-group-venue">
                                <label>Kota</label>
                                <div class="input-wrapper no-icon">
                                    <input type="text" name="city" value="{{ old('city') }}" placeholder="Jakarta">
                                </div>
                            </div>
                        </div>

                        <!-- Dokumen Pendukung -->
                        <div class="form-section">
                            <div class="form-section-title">Dokumen Pendukung</div>

                            <div class="form-group-venue">
                                <label>Foto Venue</label>
                                <label class="upload-area">
                                    <input type="file" name="venue_image" accept="image/png, image/jpeg"
                                        style="display: none;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Klik untuk upload atau drag & drop</span>
                                    <small>PNG, JPG up to 10MB</small>
                                </label>
                            </div>
                        </div>

                        <!-- Terms -->
                        <div class="terms-checkbox">
                            <input type="checkbox" id="terms" required>
                            <label for="terms">
                                Saya menyetujui <a href="#">Syarat dan Ketentuan</a> serta <a href="#">Kebijakan Privasi</a>
                                SportifyField
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-submit-venue">Daftar Sekarang</button>
                    </form>
                </div>

                <!-- Right Column - Sidebar -->
                <div class="venue-sidebar">
                    <!-- Benefits Card -->
                    <div class="sidebar-card">
                        <h3>Keuntungan Bergabung</h3>
                        <div class="benefit-list">
                            <div class="benefit-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Gratis listing untuk 3 bulan pertama</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Dashboard manajemen booking yang mudah</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Notifikasi real-time setiap booking masuk</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Sistem pembayaran otomatis dan aman</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Marketing digital gratis di platform Laparaga</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Laporan analitik lengkap</span>
                            </div>
                        </div>
                    </div>

                    <!-- Promo Card -->
                    <div class="sidebar-card promo-card">
                        <span class="promo-badge">Promo Spesial!</span>
                        <span class="promo-desc">Gratis listing selama 3 bulan pertama untuk pendaftar baru</span>
                    </div>

                    <!-- Help Card -->
                    <div class="sidebar-card">
                        <span class="help-label">Butuh bantuan?</span>
                        <div class="help-box">
                            <div class="help-contact">
                                <i class="fas fa-envelope"></i>
                                <span>partner@laparaga.com</span>
                            </div>
                            <div class="help-contact">
                                <i class="fas fa-phone-alt"></i>
                                <span>+62 812-3456-7890</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection