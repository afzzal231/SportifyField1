@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran - SportifyField')

@section('content')
    <section style="padding-top: 120px; padding-bottom: 60px; background: #F9FAFB; min-height: calc(100vh - 200px);">
        <div class="container">
            <div style="max-width: 600px; margin: 0 auto; text-align: center;">
                <!-- Success Icon -->
                <div
                    style="width: 80px; height: 80px; background: #D1FAE5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                    <i class="fas fa-check" style="font-size: 36px; color: #10B981;"></i>
                </div>

                <h1 style="font-size: 28px; font-weight: 700; color: #1A1A1A; margin-bottom: 12px;">Pembayaran Berhasil!
                </h1>
                <p style="font-size: 16px; color: #6B7280; margin-bottom: 32px;">Terima kasih, booking Anda telah
                    dikonfirmasi</p>

                <!-- Booking Details Card -->
                <div
                    style="background: white; border-radius: 12px; padding: 32px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); text-align: left; margin-bottom: 24px;">
                    <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 20px; color: #1A1A1A;">Detail Pemesanan
                    </h3>

                    <div style="margin-bottom: 16px;">
                        <div
                            style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #E5E7EB;">
                            <span style="color: #6B7280;">Lapangan</span>
                            <span style="color: #1A1A1A; font-weight: 500;">{{ $booking->field->name }}</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #E5E7EB;">
                            <span style="color: #6B7280;">Tanggal</span>
                            <span
                                style="color: #1A1A1A; font-weight: 500;">{{ $booking->booking_date->translatedFormat('l, d M Y') }}</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #E5E7EB;">
                            <span style="color: #6B7280;">Waktu</span>
                            <span style="color: #1A1A1A; font-weight: 500;">{{ substr($booking->start_time, 0, 5) }}</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #E5E7EB;">
                            <span style="color: #6B7280;">Durasi</span>
                            <span style="color: #1A1A1A; font-weight: 500;">{{ $booking->duration_hours }} Jam</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #E5E7EB;">
                            <span style="color: #6B7280;">Metode Pembayaran</span>
                            <span style="color: #1A1A1A; font-weight: 500;">{{ $booking->payment_method }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0;">
                            <span style="color: #1A1A1A; font-weight: 600;">Total Pembayaran</span>
                            <span style="color: #DC2626; font-weight: 600; font-size: 18px;">Rp
                                {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div
                        style="background: #FEF2F2; border: 1px solid #FECACA; border-radius: 8px; padding: 16px; margin-top: 16px;">
                        <p style="font-size: 14px; color: #991B1B; margin: 0;">
                            <i class="fas fa-info-circle" style="margin-right: 8px;"></i>
                            Pastikan datang tepat waktu sesuai jadwal booking Anda.
                        </p>
                    </div>
                </div>

                <div style="display: flex; gap: 16px; justify-content: center;">
                    <a href="{{ route('dashboard') }}"
                        style="padding: 14px 28px; background: #DC2626; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                        Lihat Dashboard
                    </a>
                    <a href="{{ route('fields.index') }}"
                        style="padding: 14px 28px; background: white; color: #374151; border: 1px solid #E5E7EB; border-radius: 8px; text-decoration: none; font-weight: 600;">
                        Booking Lagi
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection