@extends('layouts.app')

@section('title', 'Booking ' . $field->name . ' - SportifyField')

@push('styles')
    <style>
        .booking-step {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #9CA3AF;
        }

        .booking-step.active {
            color: #DC2626;
        }

        .step-number {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #F3F4F6;
            color: #6B7280;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
        }

        .booking-step.active .step-number {
            background: #DC2626;
            color: white;
        }

        .step-divider {
            height: 2px;
            width: 60px;
            background: #E5E7EB;
            margin: 0 16px;
        }

        .form-select-custom {
            width: 100%;
            padding: 12px;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            background-color: #F9FAFB;
            color: #374151;
            font-size: 14px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }

        .form-control-custom {
            width: 100%;
            padding: 12px;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            background-color: #F9FAFB;
            color: #374151;
            font-size: 14px;
        }

        .form-control-custom:focus,
        .form-select-custom:focus {
            outline: none;
            border-color: #DC2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .input-group-text {
            display: flex;
            align-items: center;
            padding: 0 12px;
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            border-right: none;
            border-radius: 8px 0 0 8px;
            color: #6B7280;
        }

        .input-group {
            display: flex;
            align-items: stretch;
        }

        .input-group .form-control-custom,
        .input-group .form-select-custom {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
    </style>
@endpush

@section('content')
    <section style="padding-top: 100px; padding-bottom: 60px; background: #F9FAFB; min-height: 100vh;">
        <div class="container">
            <!-- Breadcrumb -->
            <a href="{{ route('fields.show', $field->slug) }}" 
               style="display: inline-flex; align-items: center; gap: 8px; color: #6B7280; text-decoration: none; margin-bottom: 16px; font-size: 14px;">
                <i class="fas fa-chevron-left" style="font-size: 12px;"></i> Kembali ke Detail Lapangan
            </a>

            <h1 style="font-size: 24px; font-weight: 700; color: #111827; margin-bottom: 32px;">Booking Lapangan</h1>

            <!-- Steps -->
            <div style="display: flex; align-items: center; margin-bottom: 32px;">
                <div class="booking-step active" id="step1">
                    <div class="step-number">1</div>
                    <div>
                        <div style="font-size: 12px; font-weight: 600;">Langkah 1</div>
                        <div style="font-size: 14px; font-weight: 500;">Pilih Tanggal</div>
                    </div>
                </div>
                <div class="step-divider"></div>
                <div class="booking-step" id="step2">
                    <div class="step-number">2</div>
                    <div>
                        <div style="font-size: 12px; font-weight: 600;">Langkah 2</div>
                        <div style="font-size: 14px; font-weight: 500;">Pilih Jam</div>
                    </div>
                </div>
                <div class="step-divider"></div>
                <div class="booking-step" id="step3">
                    <div class="step-number">3</div>
                    <div>
                        <div style="font-size: 12px; font-weight: 600;">Langkah 3</div>
                        <div style="font-size: 14px; font-weight: 500;">Konfirmasi</div>
                    </div>
                </div>
            </div>

            <!-- Info Alert -->
            <div style="background: #EBF5FF; border: 1px solid #BFDBFE; border-radius: 8px; padding: 16px; margin-bottom: 32px; display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-info-circle" style="color: #2563EB;"></i>
                <span style="font-size: 14px; color: #1E40AF;">
                    <strong>Panduan Booking:</strong> Pilih tanggal booking &rarr; Pilih jam yang tersedia &rarr; Pilih durasi &rarr; Konfirmasi booking Anda
                </span>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 380px; gap: 32px;">
                <!-- Left Column -->
                <div>
                    <!-- Field Info -->
                    <div style="background: white; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #E5E7EB;">
                        <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-map-marker-alt" style="color: #DC2626;"></i> Informasi Lapangan
                        </h3>
                        
                        <div style="display: flex; gap: 20px;">
                            @php
                                $primaryImage = $field->images->where('is_primary', true)->first() ?? $field->images->first();
                                $imagePath = $primaryImage ? $primaryImage->image_path : null;
                                
                                if ($imagePath && str_starts_with($imagePath, 'fields/')) {
                                    $imageUrl = asset('storage/' . $imagePath);
                                } elseif ($imagePath) {
                                    $imageUrl = asset('images/' . $imagePath);
                                } else {
                                    $imageUrl = asset('images/Lapangan Tennis.jpg');
                                }
                            @endphp
                            <img src="{{ $imageUrl }}"
                                alt="{{ $field->name }}"
                                style="width: 160px; height: 100px; object-fit: cover; border-radius: 8px;">
                            
                            <div>
                                <h4 style="font-size: 16px; font-weight: 600; color: #111827; margin-bottom: 8px;">
                                    {{ $field->name }}</h4>
                                <p style="font-size: 14px; color: #6B7280; margin-bottom: 8px; display: flex; align-items: center; gap: 6px;">
                                    <i class="fas fa-map-marker-alt" style="font-size: 12px; color: #EF4444;"></i> {{ $field->city }}, {{ $field->province }}
                                </p>
                                <p style="font-size: 16px; font-weight: 600; color: #DC2626;">Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}/jam</p>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #E5E7EB;">
                        <div style="display: flex; gap: 24px; margin-bottom: 24px; border-bottom: 1px solid #E5E7EB; padding-bottom: 16px;">
                            <div style="display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 500; color: #111827;">
                                <span style="background: #DC2626; color: white; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px;">1</span>
                                Pilih Tanggal
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 500; color: #111827;">
                                <span style="background: #DC2626; color: white; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px;">2</span>
                                Pilih Jam
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 500; color: #111827;">
                                <span style="background: #DC2626; color: white; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px;">3</span>
                                Pilih Durasi
                            </div>
                        </div>

                        <form action="{{ route('booking.store', $field->id) }}" method="POST" id="bookingForm" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
                            @csrf
                            
                            <!-- Date Selection -->
                            <div>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" name="booking_date" id="booking_date" required min="{{ date('Y-m-d') }}"
                                        class="form-control-custom">
                                </div>
                                @error('booking_date')
                                    <p style="color: #DC2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Time Selection -->
                            <div>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    <select name="start_time" id="start_time" required class="form-select-custom">
                                        <option value="" disabled selected>Pilih Jam</option>
                                        @foreach(['07:00' => '07.00', '08:00' => '08.00', '09:00' => '09.00', '10:00' => '10.00', '11:00' => '11.00', '12:00' => '12.00', '13:00' => '13.00', '14:00' => '14.00', '15:00' => '15.00', '16:00' => '16.00', '17:00' => '17.00', '18:00' => '18.00', '19:00' => '19.00', '20:00' => '20.00', '21:00' => '21.00'] as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('start_time')
                                    <p style="color: #DC2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Duration Selection -->
                            <div>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-hourglass-half"></i></span>
                                    <select name="duration_hours" id="duration_hours" required class="form-select-custom">
                                        @foreach([1, 2, 3, 4] as $duration)
                                            <option value="{{ $duration }}">{{ $duration }} Jam</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column - Summary -->
                <div>
                    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #E5E7EB; position: sticky; top: 100px;">
                        <h3 style="font-size: 16px; font-weight: 700; color: #111827; margin-bottom: 24px;">Ringkasan Booking</h3>

                        <div style="display: flex; flex-direction: column; gap: 16px;">
                            <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                <span style="color: #6B7280;">Lapangan</span>
                                <span style="color: #111827; font-weight: 500; text-align: right; max-width: 60%;">{{ $field->name }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                <span style="color: #6B7280;">Tanggal</span>
                                <span id="summaryDate" style="color: #111827; font-weight: 500;">{{ date('D, M d, Y') }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                <span style="color: #6B7280;">Jam</span>
                                <span id="summaryTime" style="color: #111827; font-weight: 500;">-</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                <span style="color: #6B7280;">Durasi</span>
                                <span id="summaryDuration" style="color: #111827; font-weight: 500;">1 Jam</span>
                            </div>

                            <hr style="border: none; border-top: 1px solid #E5E7EB; margin: 0;">

                            <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                <span style="color: #6B7280;">Harga per jam</span>
                                <span style="color: #111827;">Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                <span style="color: #6B7280;">Durasi</span>
                                <span id="summaryDuration2" style="color: #111827;">1 jam</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 18px; margin-top: 8px;">
                                <span style="color: #111827; font-weight: 600;">Total</span>
                                <span id="summaryTotal" style="color: #DC2626; font-weight: 700;">Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button type="submit" form="bookingForm" id="btn-confirm" disabled
                            style="width: 100%; padding: 14px; background: #9CA3AF; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: not-allowed; margin-top: 24px; transition: background 0.2s;">
                            Konfirmasi Pemesanan
                        </button>

                        <p style="font-size: 11px; color: #9CA3AF; text-align: center; margin-top: 12px; line-height: 1.4;">
                            Dengan mengkonfirmasi, Anda menyetujui syarat dan ketentuan kami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const pricePerHour = {{ $field->price_per_hour }};

        function formatCurrency(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        function updateSteps() {
            const dateValue = document.getElementById('booking_date').value;
            const timeValue = document.getElementById('start_time').value;

            const step1 = document.getElementById('step1');
            const step2 = document.getElementById('step2');
            const step3 = document.getElementById('step3');

            // Step 1 is active by default (date is pre-filled)
            // step1.classList.add('active'); // Already active in HTML

            if (dateValue) {
                step2.classList.add('active');
            } else {
                step2.classList.remove('active');
            }

            const btnConfirm = document.getElementById('btn-confirm');

            if (dateValue && timeValue && timeValue !== '') {
                step3.classList.add('active');
                
                // Enable button
                btnConfirm.disabled = false;
                btnConfirm.style.background = '#DC2626';
                btnConfirm.style.cursor = 'pointer';
            } else {
                step3.classList.remove('active');

                // Disable button
                btnConfirm.disabled = true;
                btnConfirm.style.background = '#9CA3AF';
                btnConfirm.style.cursor = 'not-allowed';
            }
        }

        // Time Selection
        document.getElementById('start_time').addEventListener('change', function() {
            const selectedText = this.options[this.selectedIndex].text;
            document.getElementById('summaryTime').textContent = selectedText;
            updateSteps();
        });

        // Duration Selection
        document.getElementById('duration_hours').addEventListener('change', function() {
            const duration = parseInt(this.value);
            document.getElementById('summaryDuration').textContent = duration + ' Jam';
            document.getElementById('summaryDuration2').textContent = duration + ' jam';
            
            const total = pricePerHour * duration;
            document.getElementById('summaryTotal').textContent = formatCurrency(total);
        });

        // Date Selection
        document.getElementById('booking_date').addEventListener('change', function() {
            const date = new Date(this.value);
            const options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
            // Note: In a real app you might want to handle localization properly
            document.getElementById('summaryDate').textContent = date.toLocaleDateString('id-ID', options);
            updateSteps();
        });
        
        // Trigger initial calculation (visual consistancy)
        document.getElementById('summaryDate').textContent = '-';

        // Run checking initial state
        updateSteps();
    </script>
@endsection
