@extends('layouts.app')

@section('title', 'Owner Dashboard - SportifyField')

@section('content')

    <div class="container mx-auto mt-8 px-4" style="padding-bottom: 80px; min-height: calc(100vh - 200px);">

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Stats Cards - Grid 5 Kolom --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
            <div class="bg-white p-4 rounded shadow border border-gray-100">
                <h3 class="text-sm text-gray-500">Total Booking</h3>
                <p class="text-2xl font-bold">{{ $totalBooking }}</p>
            </div>

            <div class="bg-white p-4 rounded shadow border border-gray-100">
                <h3 class="text-sm text-gray-500">Confirmed</h3>
                <p class="text-2xl font-bold text-green-600">{{ $confirmedBooking }}</p>
            </div>

            <div class="bg-white p-4 rounded shadow border border-gray-100">
                <h3 class="text-sm text-gray-500">Pending</h3>
                <p class="text-2xl font-bold text-yellow-600">{{ $pendingBooking }}</p>
            </div>

            <div class="bg-white p-4 rounded shadow border border-gray-100">
                <h3 class="text-sm text-gray-500">Cancelled</h3>
                <p class="text-2xl font-bold text-red-600">{{ $cancelledBooking }}</p>
            </div>

            <div class="bg-white p-4 rounded shadow border border-gray-100">
                <h3 class="text-sm text-gray-500">Total Pendapatan</h3>
                <p class="text-2xl font-bold text-blue-600 truncate">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- Section Tabel --}}
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Booking Masuk</h2>
            <p class="text-gray-500 text-sm">Kelola booking yang masuk dari customer</p>
        </div>

        {{-- Tabel Booking --}}
        <div class="bg-white shadow rounded-lg border border-gray-200 overflow-hidden">
            <table class="w-full table-fixed divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="w-2/12 px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kode
                        </th>
                        <th class="w-2/12 px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">User
                        </th>
                        <th class="w-2/12 px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Lapangan</th>
                        <th class="w-2/12 px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Waktu</th>
                        <th class="w-1/12 px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="w-1/12 px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Total</th>
                        <th class="w-2/12 px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($bookings as $booking)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $booking->user->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 truncate">
                                {{ $booking->field->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $booking->booking_date->format('d/m/Y') }} - {{ substr($booking->start_time, 0, 5) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($booking->status === 'pending')
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @elseif($booking->status === 'confirmed')
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Confirmed</span>
                                @elseif($booking->status === 'cancelled')
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($booking->status === 'pending')
                                    <div class="flex justify-center space-x-2">
                                        <form action="{{ route('owner.booking.confirm', $booking) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="px-3 py-1 text-xs font-semibold text-white bg-green-500 rounded hover:bg-green-600">
                                                Konfirmasi
                                            </button>
                                        </form>
                                        <form action="{{ route('owner.booking.reject', $booking) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded hover:bg-red-600">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-12 whitespace-nowrap text-gray-400 text-center" colspan="7">
                                <div class="flex flex-col items-center justify-center">
                                    <span class="text-lg">Belum ada booking</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection