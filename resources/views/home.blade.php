@extends('layouts.app')

@section('title', 'SportifyField - Booking Lapangan Olahraga')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container mobile-container">
            <div class="pill-badge">Platform Reservasi Lapangan Olahraga Terpercaya di Indonesia</div>
            <h1 class="hero-title white-text">Booking Lapangan<br>Olahraga Jadi Lebih Mudah</h1>
            <p class="hero-subtitle white-text">PILIH OLAHRAGA FAVORITMU & PESAN LAPANGANNYA</p>
            <div class="hero-buttons">
                <a href="{{ route('fields.index') }}" class="btn-hero-primary">Booking Sekarang <i
                        class="fas fa-arrow-right"></i></a>
                <a href="#sports" class="btn-hero-secondary">Lihat Olahraga</a>
            </div>
        </div>
    </section>

    <!-- Search Bar Section (Overlapping) -->
    <section class="search-section-floating">
        <div class="container">
            <form action="{{ route('fields.index') }}" method="GET" class="search-bar-floating">
                <div class="search-input-group">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" placeholder="Cari lapangan...">
                </div>
                <button type="submit" class="btn-search-red">Cari</button>
            </form>
        </div>
    </section>

    <!-- Sports Categories Section -->
    <section class="sports-section" id="sports">
        <div class="container">
            <h2 class="section-title text-center">BERBAGAI PILIHAN OLAHRAGA</h2>
            <div class="sports-grid">
                @forelse($sports as $sport)
                    <a href="{{ route('fields.index', ['sport' => $sport->slug]) }}" class="sport-card">
                        <img src="{{ asset('images/' . $sport->image) }}" alt="{{ $sport->name }}">
                        <div class="sport-overlay">
                            <span class="sport-name">{{ strtoupper($sport->name) }}</span>
                        </div>
                    </a>
                @empty
                    <div class="sport-card">
                        <img src="{{ asset('images/Tennis.jpeg') }}" alt="Tennis">
                        <div class="sport-overlay">
                            <span class="sport-name">TENNIS</span>
                        </div>
                    </div>
                    <div class="sport-card">
                        <img src="{{ asset('images/Padel.jpeg') }}" alt="Padel">
                        <div class="sport-overlay">
                            <span class="sport-name">PADEL</span>
                        </div>
                    </div>
                    <div class="sport-card">
                        <img src="{{ asset('images/Tennis Meja.jpeg') }}" alt="Tennis Meja">
                        <div class="sport-overlay">
                            <span class="sport-name">TENIS MEJA</span>
                        </div>
                    </div>
                    <div class="sport-card">
                        <img src="{{ asset('images/Badminton.jpeg') }}" alt="Badminton">
                        <div class="sport-overlay">
                            <span class="sport-name">BADMINTON</span>
                        </div>
                    </div>
                    <div class="sport-card">
                        <img src="{{ asset('images/Futsal.jpeg') }}" alt="Futsal">
                        <div class="sport-overlay">
                            <span class="sport-name">FUTSAL</span>
                        </div>
                    </div>
                    <div class="sport-card">
                        <img src="{{ asset('images/Volly.jpeg') }}" alt="Volly">
                        <div class="sport-overlay">
                            <span class="sport-name">VOLLY</span>
                        </div>
                    </div>
                    <div class="sport-card">
                        <img src="{{ asset('images/Renang.jpeg') }}" alt="Renang">
                        <div class="sport-overlay">
                            <span class="sport-name">RENANG</span>
                        </div>
                    </div>
                    <div class="sport-card">
                        <img src="{{ asset('images/Basket.jpeg') }}" alt="Basket">
                        <div class="sport-overlay">
                            <span class="sport-name">BASKET</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section (Red Banner) -->
    <section class="cta-red-section">
        <div class="container">
            <h2 class="cta-title">Punya Venue Olahraga?</h2>
            <p class="cta-subtitle">Bergabunglah dengan SportifyField dan tingkatkan booking venue<br>Anda hingga 300%.</p>
            <p class="cta-subtitle">Daftar sekarang dan raih lebih banyak customer!</p>
            <a href="{{ route('fields.register') }}" class="btn-cta-white">
                DAFTARKAN VENUE ANDA <i class="fas fa-arrow-right"></i>
            </a>
            <p class="cta-note">*Gratis untuk 3 bulan pertama!</p>
        </div>
    </section>

    <!-- Why Use SportifyField Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title text-center">Mengapa Memakai Sportify Field?</h2>
            <p class="section-subtitle text-center">Kemudahan booking lapangan olahraga dalam satu platform</p>
            <div class="features-grid-v2">
                <div class="feature-card-v2">
                    <div class="feature-icon-circle-v2">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Booking Cepat & Mudah</h3>
                    <p>Proses booking hanya dalam hitungan menit tanpa ribet</p>
                </div>
                <div class="feature-card-v2">
                    <div class="feature-icon-circle-v2">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Jadwal Real-Time</h3>
                    <p>Lihat ketersediaan lapangan secara real-time dan langsung booking</p>
                </div>
                <div class="feature-card-v2">
                    <div class="feature-icon-circle-v2">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Banyak Pilihan Venue</h3>
                    <p>Ratusan venue olahraga berkualitas di berbagai lokasi</p>
                </div>
                <div class="feature-card-v2">
                    <div class="feature-icon-circle-v2">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h3>Harga Transparan</h3>
                    <p>Tidak ada biaya tersembunyi, semua harga jelas dan transparan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Register Venue Section -->
    <section class="venue-benefits-section">
        <div class="container">
            <h2 class="section-title text-center">Mengapa Mendaftarkan Venue-mu ke Sportify Field?</h2>
            <p class="section-subtitle text-center">Solusi terbaik untuk meningkatkan okupansi venue olahraga Anda</p>
            <div class="venue-benefits-grid-v2">
                <div class="benefit-col-v2">
                    <div class="benefit-icon-box-v2">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Tingkatkan Visibilitas</h3>
                    <p>Jangkau ribuan pengguna aktif yang mencari lapangan olahraga setiap harinya</p>
                    <ul class="check-list-v2">
                        <li><i class="fas fa-check-circle"></i> Eksposur ke lebih banyak calon customer</li>
                        <li><i class="fas fa-check-circle"></i> Marketing digital gratis untuk venue Anda</li>
                    </ul>
                </div>
                <div class="benefit-col-v2">
                    <div class="benefit-icon-box-v2">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Manajemen Booking Otomatis</h3>
                    <p>Kelola semua booking dengan sistem yang mudah dan efisien</p>
                    <ul class="check-list-v2">
                        <li><i class="fas fa-check-circle"></i> Dashboard lengkap untuk monitor booking</li>
                        <li><i class="fas fa-check-circle"></i> Notifikasi otomatis untuk setiap transaksi</li>
                    </ul>
                </div>
                <div class="benefit-col-v2">
                    <div class="benefit-icon-box-v2">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h3>Tingkatkan Pendapatan</h3>
                    <p>Maksimalkan okupansi dan revenue venue Anda</p>
                    <ul class="check-list-v2">
                        <li><i class="fas fa-check-circle"></i> Kurangi waktu kosong lapangan</li>
                        <li><i class="fas fa-check-circle"></i> Sistem pembayaran yang aman dan terpercaya</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
