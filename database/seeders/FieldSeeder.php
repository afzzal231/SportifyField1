<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\FieldImage;
use App\Models\Facility;
use App\Models\Sport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FieldSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [
            [
                'sport' => 'Tennis',
                'name' => 'Lapangan Tennis Bank Jabar',
                'description' => 'Lapangan Tennis Outdoor yang nyaman dan terawat, cocok untuk latihan maupun permainan santai. Dengan lingkungan yang terbuka dan permukaan lapangan yang baik, lapangan ini mendukung aktivitas olahraga tenis bagi berbagai kalangan.',
                'address' => 'Jl. Sukakarya II No.44, Sukagalih, Kec. Sukajadi, Kota Bandung, Jawa Barat 40163',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.982537243916!2d107.5786453749964!3d-6.892691993107071!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e67a0026f7c5%3A0xe534604938d67283!2sLapangan%20Tenis%20Bank%20Bjb!5e0!3m2!1sid!2sid!4v1716383626354!5m2!1sid!2sid',
                'city' => 'Kota Bandung',
                'price_per_hour' => 150000,
                'rating' => 0,
                'floor_type' => 'Hard Court',
                'images' => ['Lapangan Tennis.jpg', 'Tennis.jpeg'],
                'facilities' => ['Hard Court', 'Jaring Profesional', 'Ruang Ganti Nyaman', 'Fasilitas Mandi', 'Food Court', 'Parkir', 'Kantin', 'Dispenser Air'],
            ],
            [
                'sport' => 'Padel',
                'name' => 'Padelwood Bandung',
                'description' => 'Lapangan Padel modern dengan standar internasional. Dilengkapi dengan fasilitas lengkap dan lingkungan yang nyaman untuk bermain Padel.',
                'address' => 'Jl. Setiabudi, Kota Bandung, Jawa Barat',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15844.757041549556!2d107.59013065!3d-6.86790925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7276728e9d3%3A0x6283b48228399e52!2sSetiabudi%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sid!2sid!4v1716383700000!5m2!1sid!2sid',
                'city' => 'Kota Bandung',
                'price_per_hour' => 350000,
                'rating' => 0,
                'floor_type' => 'Padel Court',
                'images' => ['Lapangan Padel.jpg', 'Padel.jpeg'],
                'facilities' => ['Padel Court', 'Kaca Profesional', 'Ruang Ganti', 'Parkir Luas'],
            ],
            [
                'sport' => 'Badminton',
                'name' => 'Gor United',
                'description' => 'Gedung olahraga dengan lapangan badminton berkualitas. Lantai karet anti slip dan pencahayaan yang baik untuk pengalaman bermain maksimal.',
                'address' => 'Jl. Cibaduyut, Kota Bandung, Jawa Barat',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15842.123456789!2d107.590000!3d-6.950000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTcnMDAuMCJTIDEwN8KwMzUnMjQuMCJF!5e0!3m2!1sid!2sid!4v1600000000000!5m2!1sid!2sid',
                'city' => 'Kota Bandung',
                'price_per_hour' => 75000,
                'rating' => 0,
                'floor_type' => 'Vinyl',
                'images' => ['Gor Badminton.jpeg', 'Badminton.jpeg'],
                'facilities' => ['Lantai Vinyl', 'Raket Tersedia', 'Shuttlecock', 'Ruang Ganti', 'Kantin'],
            ],
            [
                'sport' => 'Futsal',
                'name' => 'Futsal Rajawali 12',
                'description' => 'Lapangan futsal dengan rumput sintetis berkualitas tinggi. Cocok untuk latihan tim atau pertandingan persahabatan.',
                'address' => 'Jl. Rajawali No.12, Kabupaten Bandung, Jawa Barat',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.771569424756!2d107.575510!3d-6.917890!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTUnMDQuNCJTIDEwN8KwMzQnMzEuOCJF!5e0!3m2!1sid!2sid!4v1600000000000!5m2!1sid!2sid',
                'city' => 'Kabupaten Bandung',
                'price_per_hour' => 120000,
                'rating' => 0,
                'floor_type' => 'Rumput Sintetis',
                'images' => ['Lapangan Futsal.jpeg', 'Futsal.jpeg'],
                'facilities' => ['Rumput Sintetis', 'Gawang Standar', 'Bola Tersedia', 'Ruang Ganti', 'Parkir'],
            ],
            [
                'sport' => 'Renang',
                'name' => 'Batununggal Sport Centre',
                'description' => 'Kolam renang olympic dengan standar nasional. Air bersih dan terawat dengan sistem filtrasi modern.',
                'address' => 'Jl. Batununggal, Kota Bandung, Jawa Barat',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15841.678901234!2d107.630000!3d-6.960000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTcnMzYuMCJTIDEwN8KwMzcnNDguMCJF!5e0!3m2!1sid!2sid!4v1600000000000!5m2!1sid!2sid',
                'city' => 'Kota Bandung',
                'price_per_hour' => 50000,
                'rating' => 0,
                'floor_type' => 'Olympic Pool',
                'images' => ['Kolam renang.jpeg', 'Renang.jpeg'],
                'facilities' => ['Kolam Olympic', 'Loker', 'Shower', 'Handuk Tersedia', 'Parkir'],
            ],
            [
                'sport' => 'Basket',
                'name' => 'Boxone Basketball',
                'description' => 'Lapangan basket indoor dengan ring standar NBA. Lantai parket premium untuk pengalaman bermain profesional.',
                'address' => 'Jl. Asia Afrika, Kota Bandung, Jawa Barat',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.806654321!2d107.610000!3d-6.920000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTUnMTIuMCJTIDEwN8KwMzYnMzYuMCJF!5e0!3m2!1sid!2sid!4v1600000000000!5m2!1sid!2sid',
                'city' => 'Kota Bandung',
                'price_per_hour' => 175000,
                'rating' => 0,
                'floor_type' => 'Parket',
                'images' => ['Lapangan Basket.jpeg', 'Basket.jpeg'],
                'facilities' => ['Lantai Parket', 'Ring NBA', 'Bola Tersedia', 'Scoreboard', 'Ruang Ganti'],
            ],
        ];

        // Clear all reviews
        if (\Illuminate\Support\Facades\Schema::hasTable('reviews')) {
            \Illuminate\Support\Facades\DB::table('reviews')->truncate();
        }

        foreach ($fields as $fieldData) {
            $sport = Sport::where('name', $fieldData['sport'])->first();

            if (!$sport)
                continue;

            $field = Field::updateOrCreate(
                ['slug' => Str::slug($fieldData['name'])],
                [
                    'sport_id' => $sport->id,
                    'name' => $fieldData['name'],
                    'description' => $fieldData['description'],
                    'address' => $fieldData['address'],
                    'map_embed_url' => $fieldData['map_embed_url'] ?? null,
                    'city' => $fieldData['city'],
                    'province' => 'Jawa Barat',
                    'price_per_hour' => $fieldData['price_per_hour'],
                    'rating' => $fieldData['rating'],
                    'is_available' => true,
                    'floor_type' => $fieldData['floor_type'],
                    'changing_room' => 'Tersedia',
                    'bathroom' => 'Indoor',
                    'parking' => 'Parkir Luas',
                ]
            );

            // Clear existing images to prevent duplicates
            FieldImage::where('field_id', $field->id)->delete();

            // Add images
            foreach ($fieldData['images'] as $index => $image) {
                FieldImage::create([
                    'field_id' => $field->id,
                    'image_path' => $image,
                    'is_primary' => $index === 0,
                ]);
            }

            // Clear existing facilities to prevent duplicates
            Facility::where('field_id', $field->id)->delete();

            // Add facilities
            foreach ($fieldData['facilities'] as $facility) {
                Facility::create([
                    'field_id' => $field->id,
                    'name' => $facility,
                    'icon' => 'fas fa-check-circle',
                ]);
            }
        }
    }
}
