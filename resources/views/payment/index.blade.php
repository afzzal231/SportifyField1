@extends('layouts.app')

@section('title', 'Pembayaran - SportifyField')

@section('content')
    <section class="payment-section-v2">
        <div class="container">
            <a href="javascript:history.back()" class="back-link-v2">
                <i class="fas fa-chevron-left"></i> Kembali
            </a>

            <!-- Midtrans Badge -->
            <div class="payment-badge">
                <div class="badge-content">
                    <i class="fas fa-shield-alt"></i>
                    <span>Pembayaran aman didukung oleh <strong>Midtrans</strong></span>
                </div>
            </div>
            <p class="payment-prototype-note">(Simulasi Prototipe - Tanpa Transaksi Nyata)</p>

            <div class="payment-wrapper-v2" style="display: flex; justify-content: center; align-items: flex-start;">
                <!-- Order Summary (Centered) -->
                <div class="payment-right-v2" style="max-width: 500px; width: 100%; margin: 0 auto;">
                    <div class="order-summary-card">
                        <h3 class="summary-title-v2">Ringkasan Pesanan</h3>

                        <div class="order-venue-info">
                            <h4 class="order-venue-name">{{ $booking->field->name }}</h4>
                            <p class="order-date">{{ $booking->booking_date->translatedFormat('l, d M Y') }}</p>
                            <p class="order-time-duration">
                                <span>{{ substr($booking->start_time, 0, 5) }}</span> • <span>{{ $booking->duration_hours }}
                                    jam</span>
                            </p>
                        </div>

                        <div class="summary-divider"></div>

                        <div class="order-pricing">
                            <div class="summary-row-v2">
                                <span class="summary-label-v2">Subtotal</span>
                                <span class="summary-value-v2">Rp
                                    {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-row-v2">
                                <span class="summary-label-v2">Biaya Admin</span>
                                <span class="summary-value-v2 text-green">Gratis</span>
                            </div>
                        </div>

                        <div class="summary-divider"></div>

                        <div class="order-total">
                            <span class="total-label">Total Pembayaran</span>
                            <span class="total-value">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>

                        <form action="{{ route('payment.process', $booking->id) }}" method="POST" id="paymentForm">
                            @csrf
                            <input type="hidden" name="payment_method" value="Midtrans">
                        </form>

                        <button type="button" id="pay-button" class="btn-pay-now">
                            Bayar Sekarang
                        </button>

                        <p class="payment-terms-v2">
                            Dengan melanjutkan, Anda menyetujui<br>
                            <a href="#">syarat dan ketentuan</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Security Footer -->
            <div class="payment-security-footer">
                <i class="fas fa-lock"></i>
                <span>Transaksi Anda dilindungi dengan enkripsi SSL 256-bit</span>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function () {
                // SnapToken acquired from previous step
                snap.pay('{{ $snapToken }}', {
                    // Optional
                    onSuccess: function (result) {
                        /* You may add your own implementation here */
                        // alert("payment success!"); 
                        document.getElementById('paymentForm').submit();
                    },
                    onPending: function (result) {
                        /* You may add your own implementation here */
                        alert("wating your payment!"); console.log(result);
                    },
                    onError: function (result) {
                        /* You may add your own implementation here */
                        alert("payment failed!"); console.log(result);
                    },
                    onClose: function () {
                        /* You may add your own implementation here */
                        alert('you closed the popup without finishing the payment');
                    }
                });
            };
        </script>
    @endpush
@endsection