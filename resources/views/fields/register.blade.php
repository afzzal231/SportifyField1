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
                <form action="{{ route('fields.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-section">
                        <div class="form-section-title">Informasi Field</div>

                        <!-- NAME -->
                        <div class="form-group-venue">
                            <label>Nama Field <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fas fa-building"></i>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Arena Futsal Premium"
                                    required>
                            </div>
                        </div>

                        <!-- SPORT TYPE → sport_id -->
                        <div class="form-group-venue">
                            <label>Jenis Olahraga <span class="required">*</span></label>
                            <div class="input-wrapper no-icon">
                                <select name="sport_id" required>
                                    <option value="" disabled selected>Pilih jenis olahraga</option>
                                    @foreach(\App\Models\Sport::all() as $sport)
                                        <option value="{{ $sport->id }}" {{ old('sport_id') == $sport->id ? 'selected' : '' }}>
                                            {{ $sport->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="form-group-venue">
                            <label>Deskripsi</label>
                            <div class="input-wrapper no-icon">
                                <textarea name="description" placeholder="Jelaskan fasilitas dan keunggulan field..."
                                    style="min-height: 80px; resize: vertical; padding-top: 12px;">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <!-- PRICE -->
                        <div class="form-group-venue">
                            <label>Harga per Jam (Rp)</label>
                            <div class="input-wrapper no-icon">
                                <input type="number" name="price_per_hour" value="{{ old('price_per_hour') }}"
                                    placeholder="150000">
                            </div>
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="form-section">
                        <div class="form-section-title">Lokasi</div>

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

                        <div class="form-group-venue">
                            <label>Provinsi</label>
                            <div class="input-wrapper no-icon">
                                <input type="text" name="province" value="{{ old('province') }}" placeholder="Jawa Barat">
                            </div>
                        </div>

                        <div class="form-group-venue">
                            <label>Google Maps Embed URL</label>
                            <div class="input-wrapper no-icon">
                                <input type="text" name="map_embed_url" value="{{ old('map_embed_url') }}"
                                    placeholder="https://maps.google.com/...">
                            </div>
                        </div>
                    </div>

                    <!-- Fasilitas Field -->
                    <div class="form-section">
                        <div class="form-section-title">Fasilitas Field</div>

                        <div class="form-group-venue">
                            <label>Jenis Lantai</label>
                            <div class="input-wrapper no-icon">
                                <select name="floor_type">
                                    <option value="" selected>Pilih jenis</option>
                                    <option value="vinyl">Vinyl</option>
                                    <option value="rumput sintetis">Rumput Sintetis</option>
                                    <option value="kayu">Kayu</option>
                                    <option value="acrylic">Acrylic</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 bg-gray-100 p-4 rounded-md shadow-sm">

                            <label class="flex items-center gap-2 cursor-pointer hover:text-blue-600">
                                <input type="checkbox" name="changing_room" value="1" class="w-4 h-4 rounded">
                                <span>Ruang Ganti</span>
                            </label>

                            <label class="flex items-center gap-2 cursor-pointer hover:text-blue-600">
                                <input type="checkbox" name="bathroom" value="1" class="w-4 h-4 rounded">
                                <span>Kamar Mandi</span>
                            </label>

                            <label class="flex items-center gap-2 cursor-pointer hover:text-blue-600">
                                <input type="checkbox" name="parking" value="1" class="w-4 h-4 rounded">
                                <span>Parkiran</span>
                            </label>

                        </div>

                    </div>

                    <!-- Foto Field -->
                    <div class="form-section">
                        <div class="form-section-title mb-2">Foto Field</div>

                        <label id="uploadArea"
                            class="flex flex-col items-center justify-center border-2 border-dashed border-gray-400 rounded-md p-6 cursor-pointer hover:border-blue-500 transition overflow-hidden">

                            <input type="file" name="image" id="imageInput" accept="image/png, image/jpeg" class="hidden">

                            <div id="uploadPlaceholder" class="flex flex-col items-center">
                                <i class="fas fa-cloud-upload-alt text-3xl mb-2"></i>
                                <span class="text-sm font-medium">Klik untuk upload atau drag & drop</span>
                                <small class="text-xs text-gray-500">PNG, JPG hingga 10MB</small>
                            </div>

                            <img id="imagePreview" class="hidden w-full h-40 object-cover rounded">
                        </label>

                    </div>

                    <button type="submit" class="btn-submit-venue">Daftar Sekarang</button>

                </form>


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

        <script>
            document.getElementById('imageInput').addEventListener('change', function (event) {
                const file = event.target.files[0];
                const preview = document.getElementById('imagePreview');
                const placeholder = document.getElementById('uploadPlaceholder');

                if (file) {
                    const url = URL.createObjectURL(file);
                    preview.src = url;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
            });
        </script>

    </section>
@endsection