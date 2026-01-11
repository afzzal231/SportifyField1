@extends('layouts.app')

@section('title', 'Admin Dashboard - SportifyField')

@section('content')
    <div class="container mx-auto px-6 py-24 bg-slate-100" style="min-height: calc(100vh - 200px); padding-bottom: 80px;">
        <h1 class="text-3xl font-semibold mb-8">Admin Dashboard</h1>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="rounded-xl p-6 text-black bg-white shadow">
                <h2 class="font-medium text-lg mb-2">Total Lapangan</h2>
                <p class="text-3xl font-bold">{{ $fieldCount }}</p>
            </div>

            <div class="rounded-xl p-6 text-black bg-white shadow">
                <h2 class="font-medium text-lg mb-2">Total Booking</h2>
                <p class="text-3xl font-bold">{{ $bookingCount }}</p>
            </div>

            <div class="rounded-xl p-6 text-black bg-white shadow">
                <h2 class="font-medium text-lg mb-2">Total Pendapatan</h2>
                <p class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- Booking Terbaru --}}
        <div class="bg-white rounded-2xl shadow p-6 mt-10">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Semua Booking</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-2">
                    <thead>
                        <tr class="text-gray-500 text-sm">
                            <th class="py-2 px-3">User</th>
                            <th class="py-2 px-3">Lapangan</th>
                            <th class="py-2 px-3">Tanggal Booking</th>
                            <th class="py-2 px-3">Jam</th>
                            <th class="py-2 px-3">Status</th>
                            <th class="py-2 px-3">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($allBookings as $b)
                            <tr class="bg-gray-50 rounded-xl font-medium">
                                <td class="py-3 px-3">{{ $b->user->name ?? 'N/A' }}</td>

                                <td class="py-3 px-3">{{ $b->field->name ?? 'N/A' }}</td>

                                <td class="py-3 px-3">
                                    {{ $b->booking_date->format('d M Y') }}
                                </td>

                                <td class="py-3 px-3">{{ substr($b->start_time, 0, 5) }}</td>

                                <td class="py-3 px-3">
                                    @if ($b->status === 'confirmed')
                                        <span
                                            class="px-3 py-1 text-sm rounded-lg bg-green-100 text-green-700">Confirmed</span>
                                    @elseif ($b->status === 'pending')
                                        <span
                                            class="px-3 py-1 text-sm rounded-lg bg-yellow-100 text-yellow-600">Pending</span>
                                    @elseif ($b->status === 'cancelled')
                                        <span class="px-3 py-1 text-sm rounded-lg bg-red-100 text-red-600">Cancelled</span>
                                    @endif
                                </td>

                                <td class="py-3 px-3">
                                    Rp {{ number_format($b->total_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-gray-400">Belum ada booking</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
