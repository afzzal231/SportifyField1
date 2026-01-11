@extends('layouts.app')

@section('title', $field->name . ' - SportifyField')

@section('content')
    <!-- Detail Section -->
    <section class="detail-section-v2">
        <div class="container">
            <a href="{{ route('fields.index') }}" class="back-link-v2">
                <i class="fas fa-chevron-left"></i> Kembali ke Daftar Lapangan
            </a>

            <!-- Gallery Section -->
            <div class="gallery-container-v2">
                <div class="main-image-wrapper">
                    @php
                        $primaryImage = $field->images->where('is_primary', true)->first() ?? $field->images->first();
                        $imagePath = $primaryImage ? $primaryImage->image_path : null;

                        // Check if it's a storage path (starts with 'fields/') or old images path
                        if ($imagePath && str_starts_with($imagePath, 'fields/')) {
                            $imageUrl = asset('storage/' . $imagePath);
                        } elseif ($imagePath) {
                            $imageUrl = asset('images/' . $imagePath);
                        } else {
                            $imageUrl = asset('images/Lapangan Tennis.jpg');
                        }
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $field->name }}" id="mainImage">
                    <div class="image-badges">
                        <span
                            class="badge badge-sport badge-{{ strtolower($field->sport->slug ?? 'tennis') }}">{{ $field->sport->name ?? 'Olahraga' }}</span>
                        <span class="badge badge-photo">{{ $field->images->count() }} Foto</span>
                    </div>
                </div>
                <div class="gallery-bottom-row">
                    <div class="thumbnail-row">
                        @foreach($field->images as $index => $image)
                            @php
                                if (str_starts_with($image->image_path, 'fields/')) {
                                    $thumbUrl = asset('storage/' . $image->image_path);
                                } else {
                                    $thumbUrl = asset('images/' . $image->image_path);
                                }
                            @endphp
                            <div class="thumb {{ $index == 0 ? 'active' : '' }}" onclick="changeImage('{{ $thumbUrl }}', this)">
                                <img src="{{ $thumbUrl }}" alt="Thumb {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="price-container-v2">
                        <span class="price-label-v2">Mulai dari</span>
                        <div class="price-value-v2">Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}</div>
                        <span class="price-unit">per jam</span>
                    </div>
                </div>
            </div>

            <!-- Header Info -->
            <div class="venue-header-v2">
                <div class="header-left">
                    <div class="title-row">
                        <h1 class="venue-name-v2">{{ strtoupper($field->name) }}</h1>
                    </div>
                    <div class="rating-row">
                        <i class="fas fa-star text-warning"></i>
                        <span class="rating-score">{{ number_format($field->rating, 1) }}</span>
                        <span class="rating-count">({{ $field->reviews->count() }} ulasan)</span>
                    </div>
                    <div class="address-row">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $field->address }}</span>
                    </div>
                </div>
                <div class="header-right">
                    @auth
                        <a href="{{ route('booking.create', $field->id) }}" class="btn-book-v2">Pesan Sekarang</a>
                    @else
                        <a href="javascript:void(0)" onclick="showLoginPopup()" class="btn-book-v2">Pesan Sekarang</a>
                    @endauth
                </div>
            </div>

            <hr class="section-divider">

            <!-- About Section -->
            <div class="content-section">
                <h3 class="section-subtitle-v2">Tentang Lapangan</h3>
                <p class="description-text-v2">
                    {{ $field->description ?? 'Lapangan ' . $field->sport->name . ' yang nyaman dan terawat, cocok untuk latihan maupun permainan santai. Dengan lingkungan yang terbuka dan permukaan lapangan yang baik, lapangan ini mendukung aktivitas olahraga bagi berbagai kalangan.' }}
                </p>
            </div>

            <!-- Facilities Grid -->
            <div class="content-section">
                <h3 class="section-subtitle-v2">Fasilitas Lapangan</h3>
                <div class="facilities-boxes">
                    <div class="f-box">
                        <div class="f-icon red"><i class="fas fa-layer-group"></i></div>
                        <div class="f-info">
                            <div class="f-label">Lantai Lapangan</div>
                            <div class="f-value">{{ $field->floor_type ?? 'Hard Court' }}</div>
                        </div>
                    </div>
                    <div class="f-box">
                        <div class="f-icon red"><i class="fas fa-tshirt"></i></div>
                        <div class="f-info">
                            <div class="f-label">Pakaian Ganti</div>
                            <div class="f-value">{{ $field->changing_room ?? 'Tersedia' }}</div>
                        </div>
                    </div>
                    <div class="f-box">
                        <div class="f-icon red"><i class="fas fa-restroom"></i></div>
                        <div class="f-info">
                            <div class="f-label">Kamar Mandi</div>
                            <div class="f-value">{{ $field->bathroom ?? 'Indoor' }}</div>
                        </div>
                    </div>
                    <div class="f-box">
                        <div class="f-icon red"><i class="fas fa-parking"></i></div>
                        <div class="f-info">
                            <div class="f-label">Parkiran</div>
                            <div class="f-value">{{ $field->parking ?? 'Parkir Luas' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Facilities List -->
            <div class="content-section">
                <h3 class="section-subtitle-v2">Fasilitas</h3>
                <div class="facilities-pills">
                    @forelse($field->facilities as $facility)
                        <div class="f-pill"><i class="fas fa-check-circle"></i> {{ $facility->name }}</div>
                    @empty
                        <div class="f-pill"><i class="fas fa-check-circle"></i> Hard Court</div>
                        <div class="f-pill"><i class="fas fa-check-circle"></i> Jaring Profesional</div>
                        <div class="f-pill"><i class="fas fa-check-circle"></i> Ruang Ganti Nyaman</div>
                        <div class="f-pill"><i class="fas fa-check-circle"></i> Fasilitas Mandi</div>
                        <div class="f-pill"><i class="fas fa-check-circle"></i> Parkir</div>
                    @endforelse
                </div>
            </div>

            <!-- Rules Section -->
            <div class="content-section">
                <div class="rules-alert">
                    <div class="rules-header">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>SYARAT - KETENTUAN LAPANGAN</span>
                    </div>
                    <p class="rules-intro">Pesan sekarang dan ikuti aturan penyewa fasilitas untuk kenyamanan bersama:</p>
                    <ul class="rules-list-v2">
                        <li>Pastikan datang tepat waktu sesuai dengan jadwal booking.</li>
                        <li>Gunakan sepatu olahraga yang sesuai untuk lapangan {{ $field->sport->name ?? 'ini' }}.</li>
                        <li>Dilarang merokok di area lapangan.</li>
                        <li>Harap menjaga kebersihan dan ketertiban di area lapangan.</li>
                        <li>Segala bentuk kehilangan pakaian bukan tanggung jawab pengelola.</li>
                        <li>Kami tidak bertanggung jawab atas cedera yang terjadi saat bermain.</li>
                        <li>Lapangan ini bersifat publik diharapkan mengikuti aturan pengelola.</li>
                    </ul>
                </div>
            </div>

            <!-- Map Section -->
            @if($field->map_embed_url)
                <div class="content-section">
                    <h3 class="section-subtitle-v2">Lokasi Lapangan</h3>
                    <div class="map-container"
                        style="width: 100%; height: 400px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                        <iframe src="{{ $field->map_embed_url }}" width="100%" height="100%" style="border:0;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            @endif

            <!-- Reviews Section -->
            <div class="content-section">
                <div class="reviews-header-v2">
                    <h3 class="section-subtitle-v2">Ulasan Pengguna</h3>
                </div>

                @auth
                    <div class="review-form-card"
                        style="background: white; padding: 20px; border-radius: 12px; border: 1px solid #E5E7EB; margin-bottom: 24px;">
                        <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 16px;">Tulis Ulasan Anda</h4>

                        @if(session('success'))
                            <div class="alert alert-success"
                                style="margin-bottom: 16px; padding: 10px; background: #DEF7EC; color: #03543F; border-radius: 6px;">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-error"
                                style="margin-bottom: 16px; padding: 10px; background: #FDE8E8; color: #9B1C1C; border-radius: 6px;">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('reviews.store', $field->id) }}" method="POST">
                            @csrf
                            <div class="form-group" style="margin-bottom: 16px;">
                                <label
                                    style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Rating</label>
                                <div class="star-rating-input">
                                    <div class="stars"
                                        style="display: flex; gap: 8px; flex-direction: row-reverse; justify-content: flex-end;">
                                        <input type="radio" name="rating" id="star5" value="5" class="hidden"
                                            style="display: none;"><label for="star5"
                                            style="cursor: pointer; font-size: 24px; color: #D1D5DB; transition: color 0.2s;"><i
                                                class="fas fa-star"></i></label>
                                        <input type="radio" name="rating" id="star4" value="4" class="hidden"
                                            style="display: none;"><label for="star4"
                                            style="cursor: pointer; font-size: 24px; color: #D1D5DB; transition: color 0.2s;"><i
                                                class="fas fa-star"></i></label>
                                        <input type="radio" name="rating" id="star3" value="3" class="hidden"
                                            style="display: none;"><label for="star3"
                                            style="cursor: pointer; font-size: 24px; color: #D1D5DB; transition: color 0.2s;"><i
                                                class="fas fa-star"></i></label>
                                        <input type="radio" name="rating" id="star2" value="2" class="hidden"
                                            style="display: none;"><label for="star2"
                                            style="cursor: pointer; font-size: 24px; color: #D1D5DB; transition: color 0.2s;"><i
                                                class="fas fa-star"></i></label>
                                        <input type="radio" name="rating" id="star1" value="1" class="hidden"
                                            style="display: none;"><label for="star1"
                                            style="cursor: pointer; font-size: 24px; color: #D1D5DB; transition: color 0.2s;"><i
                                                class="fas fa-star"></i></label>
                                    </div>
                                    <style>
                                        .stars input:checked~label,
                                        .stars label:hover,
                                        .stars label:hover~label {
                                            color: #FBBF24 !important;
                                        }
                                    </style>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 16px;">
                                <label for="comment"
                                    style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Komentar</label>
                                <textarea name="comment" id="comment" rows="3" required
                                    style="width: 100%; padding: 10px; border: 1px solid #D1D5DB; border-radius: 6px; font-size: 14px;"
                                    placeholder="Ceritakan pengalaman Anda bermain di sini..."></textarea>
                            </div>

                            <button type="submit"
                                style="background: #DC2626; color: white; border: none; padding: 10px 20px; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 14px;">Kirim
                                Ulasan</button>
                        </form>
                    </div>
                @else
                    <div class="login-to-review"
                        style="background: #F9FAFB; padding: 20px; border-radius: 12px; text-align: center; margin-bottom: 24px;">
                        <p style="color: #6B7280; margin-bottom: 12px;">Silakan login untuk memberikan ulasan</p>
                        <a href="{{ route('login') }}" style="color: #DC2626; font-weight: 600; text-decoration: none;">Masuk ke
                            Akun Anda</a>
                    </div>
                @endauth

                <div class="rating-summary-card">
                    <div class="summary-left">
                        <div class="main-score">{{ number_format($field->rating, 1) }}</div>
                        <div class="stars-row">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($field->rating))
                                    <i class="fas fa-star"></i>
                                @elseif($i - 0.5 <= $field->rating)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <div class="total-reviews">{{ $field->reviews->count() }} ulasan</div>
                    </div>
                </div>

                <div class="reviews-list-v2">
                    @forelse($field->reviews as $review)
                        <div class="review-item-v2">
                            <div class="review-user-info">
                                <div class="user-avatar-v2 red">{{ strtoupper(substr($review->user->name, 0, 2)) }}</div>
                                <div class="user-meta">
                                    <div class="user-name-v2">{{ $review->user->name }}</div>
                                    <div class="stars-mini">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                                <div class="review-date">{{ $review->created_at->diffForHumans() }}</div>
                            </div>
                            <p class="review-text-v2">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 40px; color: #6B7280;">
                            <i class="fas fa-comment-slash" style="font-size: 32px; margin-bottom: 12px;"></i>
                            <p>Belum ada ulasan untuk lapangan ini</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <script>
        function changeImage(imageSrc, element) {
            document.getElementById('mainImage').src = imageSrc;
            document.querySelectorAll('.thumb').forEach(thumb => {
                thumb.classList.remove('active');
            });
            if (element) {
                element.classList.add('active');
            }
        }

        function showLoginPopup() {
            document.getElementById('loginPopup').style.display = 'flex';
        }

        function hideLoginPopup() {
            document.getElementById('loginPopup').style.display = 'none';
        }

        // Close popup when clicking outside
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('loginPopup')?.addEventListener('click', function (e) {
                if (e.target === this) {
                    hideLoginPopup();
                }
            });
        });
    </script>

    <!-- Login Required Popup -->
    <div id="loginPopup" class="login-popup-overlay" style="display: none;">
        <div class="login-popup-content">
            <button class="login-popup-close" onclick="hideLoginPopup()">&times;</button>
            <div class="login-popup-icon">
                <i class="fas fa-user-lock"></i>
            </div>
            <h3 class="login-popup-title">Login Diperlukan</h3>
            <p class="login-popup-message">Anda harus login terlebih dahulu untuk melakukan booking lapangan.</p>
            <div class="login-popup-buttons">
                <button type="button" class="btn-popup-cancel" onclick="hideLoginPopup()">Batal</button>
                <a href="{{ route('login') }}" class="btn-popup-login">Login Sekarang</a>
            </div>
        </div>
    </div>

    <style>
        .login-popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .login-popup-content {
            background: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.35);
            animation: loginPopupSlideIn 0.3s ease;
            position: relative;
        }

        @keyframes loginPopupSlideIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-30px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .login-popup-close {
            position: absolute;
            top: 16px;
            right: 20px;
            background: none;
            border: none;
            font-size: 28px;
            color: #9CA3AF;
            cursor: pointer;
            transition: color 0.2s;
            line-height: 1;
        }

        .login-popup-close:hover {
            color: #374151;
        }

        .login-popup-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }

        .login-popup-icon i {
            font-size: 36px;
            color: #DC2626;
        }

        .login-popup-title {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 12px;
        }

        .login-popup-message {
            font-size: 15px;
            color: #6B7280;
            margin-bottom: 28px;
            line-height: 1.6;
        }

        .login-popup-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .btn-popup-cancel {
            padding: 14px 28px;
            background: #F3F4F6;
            color: #374151;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-popup-cancel:hover {
            background: #E5E7EB;
        }

        .btn-popup-login {
            padding: 14px 28px;
            background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-popup-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.4);
        }
    </style>
@endsection