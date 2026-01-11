@extends('layouts.app')

@section('title', 'Dashboard - SportifyField')

@section('content')
    <!-- Dashboard Section -->
    <section class="dashboard-section">
        <div class="container">
            <h1 class="dashboard-title">Dashboard Saya</h1>

            <div class="dashboard-wrapper">
                <!-- Left Column -->
                <div class="dashboard-left">
                    <!-- Profile Section -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <i class="fas fa-user card-icon"></i>
                            <h3 class="card-title">Profile</h3>
                        </div>
                        <div class="profile-content">
                            <div class="profile-avatar">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Profile"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <i class="fas fa-user"></i>
                                @endif
                            </div>
                            <h3 class="profile-name">{{ $user->name }}</h3>
                            <p class="profile-email">{{ $user->email }}</p>
                            <div class="profile-detail">
                                <span class="detail-label">Telepon</span>
                                <span class="detail-value">{{ $user->phone ?? '-' }}</span>
                            </div>
                            <div class="profile-detail">
                                <span class="detail-label">Total Pemesanan</span>
                                <span class="detail-value">{{ $bookings->count() }}</span>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="btn-edit-profile">Edit Profil</a>
                        </div>
                    </div>

                    <!-- Statistik Section -->
                    <div class="dashboard-card">
                        <h3 class="card-title">Statistik Singkat</h3>
                        <div class="statistics-list">
                            <div class="stat-item">
                                <span class="stat-label">Pemesanan Aktif</span>
                                <span class="stat-value stat-active">{{ $stats['active'] }}</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Tertunda</span>
                                <span class="stat-value stat-pending">{{ $stats['pending'] }}</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Dibatalkan</span>
                                <span class="stat-value stat-cancelled">{{ $stats['cancelled'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="dashboard-right">
                    <!-- History Pemesanan Section -->
                    <div class="dashboard-card">
                        <div class="card-header-with-button">
                            <div class="card-header">
                                <i class="fas fa-calendar card-icon"></i>
                                <h3 class="card-title">History Pemesanan</h3>
                            </div>
                            <span class="btn-latest-booking">Pemesanan Terbaru</span>
                        </div>

                        @forelse($bookings as $booking)
                            <!-- Booking Card -->
                            <div class="booking-card">
                                <div class="booking-image-wrapper">
                                    @php
                                        $primaryImage = $booking->field->images->where('is_primary', true)->first() ?? $booking->field->images->first();
                                        $imagePath = $primaryImage ? $primaryImage->image_path : null;

                                        if ($imagePath && str_starts_with($imagePath, 'fields/')) {
                                            $imageUrl = asset('storage/' . $imagePath);
                                        } elseif ($imagePath) {
                                            $imageUrl = asset('images/' . $imagePath);
                                        } else {
                                            $imageUrl = asset('images/Tennis.jpeg');
                                        }
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="{{ $booking->field->name }}" class="booking-image">
                                </div>
                                <div class="booking-info">
                                    <h4 class="booking-name">{{ $booking->field->name }}</h4>
                                    <div class="booking-details">
                                        <div class="booking-detail-item">
                                            <i class="fas fa-calendar"></i>
                                            <span>{{ $booking->booking_date->format('D, M d, Y') }}</span>
                                        </div>
                                        <div class="booking-detail-item">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ substr($booking->start_time, 0, 5) }}</span>
                                        </div>
                                        <div class="booking-detail-item">
                                            <span>Durasi : {{ $booking->duration_hours }} Jam</span>
                                        </div>
                                    </div>
                                    <div class="booking-footer">
                                        @if($booking->status == 'confirmed')
                                            <span class="booking-status status-confirmed">Konfirmasi</span>
                                        @elseif($booking->status == 'pending')
                                            <span class="booking-status status-pending">Tertunda</span>
                                        @else
                                            <span class="booking-status status-cancelled">Dibatalkan</span>
                                        @endif
                                        <span class="booking-price">Rp
                                            {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="booking-actions">
                                        <a href="{{ route('fields.show', $booking->field->slug) }}" class="btn-view-field">Lihat
                                            Lapangan</a>
                                        @if($booking->status == 'pending')
                                            <form id="cancelForm{{ $booking->id }}"
                                                action="{{ route('booking.cancel', $booking->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button type="button" class="btn-cancel"
                                                    onclick="showCancelConfirm({{ $booking->id }})">Batal</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; padding: 40px; color: #6B7280;">
                                <i class="fas fa-calendar-times" style="font-size: 48px; margin-bottom: 16px;"></i>
                                <p>Belum ada pemesanan</p>
                                <a href="{{ route('fields.index') }}"
                                    style="display: inline-block; margin-top: 16px; padding: 12px 24px; background: #DC2626; color: white; border-radius: 8px; text-decoration: none;">
                                    Booking Sekarang
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cancel Confirmation Modal -->
    <div id="cancelModal" class="cancel-modal-overlay" style="display: none;">
        <div class="cancel-modal-content">
            <div class="cancel-modal-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="cancel-modal-title">Batalkan Pesanan?</h3>
            <p class="cancel-modal-message">Yakin ingin membatalkan pesanan ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="cancel-modal-buttons">
                <button type="button" class="btn-cancel-no" onclick="hideCancelConfirm()">Tidak</button>
                <button type="button" class="btn-cancel-yes" id="confirmCancelBtn">Ya, Batalkan</button>
            </div>
        </div>
    </div>

    <style>
        .cancel-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .cancel-modal-content {
            background: white;
            padding: 32px 40px;
            border-radius: 16px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .cancel-modal-icon {
            width: 60px;
            height: 60px;
            background: #FEF2F2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .cancel-modal-icon i {
            font-size: 28px;
            color: #DC2626;
        }

        .cancel-modal-title {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .cancel-modal-message {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .cancel-modal-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .btn-cancel-no {
            padding: 12px 28px;
            background: #F3F4F6;
            color: #374151;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-cancel-no:hover {
            background: #E5E7EB;
        }

        .btn-cancel-yes {
            padding: 12px 28px;
            background: #DC2626;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-cancel-yes:hover {
            background: #B91C1C;
        }
    </style>

    <script>
        let currentFormId = null;

        function showCancelConfirm(bookingId) {
            currentFormId = bookingId;
            document.getElementById('cancelModal').style.display = 'flex';
        }

        function hideCancelConfirm() {
            document.getElementById('cancelModal').style.display = 'none';
            currentFormId = null;
        }

        document.getElementById('confirmCancelBtn').addEventListener('click', function () {
            if (currentFormId) {
                document.getElementById('cancelForm' + currentFormId).submit();
            }
        });

        // Close modal when clicking outside
        document.getElementById('cancelModal').addEventListener('click', function (e) {
            if (e.target === this) {
                hideCancelConfirm();
            }
        });
    </script>
@endsection