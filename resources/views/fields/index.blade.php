@extends('layouts.app')

@section('title', 'Daftar Lapangan - SportifyField')

@section('content')
    <!-- Fields Section -->
    <section class="fields-section-v2">
        <div class="container">
            <div class="fields-header-v2">
                <h1 class="fields-title-v2">Daftar Lapangan</h1>
                <p class="fields-subtitle-v2">Temukan lapangan yang sempurna untuk permainan Anda</p>
            </div>

            <!-- Search Bar -->
            <form action="{{ route('fields.index') }}" method="GET">
                <div class="search-bar-v2">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari lapangan atau lokasi...">
                </div>

                <!-- Filter Section -->
                <div class="filter-section-v2">
                    <div class="filter-toggle" onclick="toggleFilter()">
                        <i class="fas fa-sliders-h"></i>
                        <span>Filter Pencarian</span>
                        <i class="fas fa-chevron-down filter-arrow"></i>
                    </div>
                    <div class="filter-dropdowns" id="filterDropdowns">
                        <div class="filter-group">
                            <div class="filter-label-v2">
                                <i class="fas fa-running"></i> Jenis Olahraga
                            </div>
                            <select name="sport" class="filter-select-v2" onchange="this.form.submit()">
                                <option value="all">Semua Olahraga</option>
                                @foreach($sports as $sport)
                                    <option value="{{ $sport->slug }}" {{ request('sport') == $sport->slug ? 'selected' : '' }}>
                                        {{ $sport->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-group">
                            <div class="filter-label-v2">
                                <i class="fas fa-map-marker-alt"></i> Lokasi
                            </div>
                            <select name="city" class="filter-select-v2" onchange="this.form.submit()">
                                <option value="all">Semua Lokasi</option>
                                <option value="Bandung" {{ request('city') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                                <option value="Jakarta" {{ request('city') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                                <option value="Surabaya" {{ request('city') == 'Surabaya' ? 'selected' : '' }}>Surabaya
                                </option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <div class="filter-label-v2">
                                <i class="fas fa-dollar-sign"></i> Harga
                            </div>
                            <select name="price" class="filter-select-v2" onchange="this.form.submit()">
                                <option value="all">Semua Harga</option>
                                <option value="low" {{ request('price') == 'low' ? 'selected' : '' }}>Kurang dari Rp 100.000
                                </option>
                                <option value="medium" {{ request('price') == 'medium' ? 'selected' : '' }}>Rp 100.000 -
                                    200.000</option>
                                <option value="high" {{ request('price') == 'high' ? 'selected' : '' }}>Lebih dari Rp 200.000
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Fields Grid -->
            <div class="fields-grid-v2">
                @forelse($fields as $field)
                    <a href="{{ route('fields.show', $field->slug) }}" class="field-card-v2">
                        <div class="field-image-wrapper-v2">
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
                            <img src="{{ $imageUrl }}" alt="{{ $field->name }}">
                            <span
                                class="field-badge-v2 badge-{{ strtolower($field->sport->slug ?? 'tennis') }}">{{ $field->sport->name ?? 'Olahraga' }}</span>
                        </div>
                        <div class="field-info-v2">
                            <h3 class="field-name-v2">{{ $field->name }}</h3>
                            <p class="field-location-v2">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $field->city }}, {{ $field->province }}
                            </p>
                            <div class="field-bottom-v2">
                                <div class="field-rating-v2">
                                    <i class="fas fa-star"></i> {{ number_format($field->rating, 1) }}
                                </div>
                                <div class="field-price-v2">Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}/jam
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                        <i class="fas fa-search" style="font-size: 48px; color: #9CA3AF; margin-bottom: 16px;"></i>
                        <h3 style="color: #374151; margin-bottom: 8px;">Tidak ada lapangan ditemukan</h3>
                        <p style="color: #6B7280;">Coba ubah filter pencarian Anda</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <script>
        function toggleFilter() {
            const filterDropdowns = document.getElementById('filterDropdowns');
            const filterArrow = document.querySelector('.filter-arrow');
            filterDropdowns.classList.toggle('show');
            filterArrow.classList.toggle('rotate');
        }
    </script>
@endsection