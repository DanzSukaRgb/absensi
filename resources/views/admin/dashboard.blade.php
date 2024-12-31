<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Users -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 text-center">
                        <h3 class="text-2xl font-bold">{{ $totalUsers }}</h3>
                        <p class="text-gray-600">Total Pengguna</p>
                    </div>
                </div>

                <!-- Total Absensi -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 text-center">
                        <h3 class="text-2xl font-bold">{{ $totalAbsensi }}</h3>
                        <p class="text-gray-600">Total Absensi</p>
                    </div>
                </div>

                <!-- Absen Hari Ini -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 text-center">
                        <h3 class="text-2xl font-bold">{{ $absenHariIni }}</h3>
                        <p class="text-gray-600">Absen Hari Ini</p>
                    </div>
                </div>

                <!-- Pending Izin -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 text-center">
                        <h3 class="text-2xl font-bold">{{ $pendingIzin }}</h3>
                        <p class="text-gray-600">Izin Menunggu Persetujuan</p>
                    </div>
                </div>
            </div>

            <!-- Rekap Absensi Terbaru -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-lg font-semibold mb-4">Rekap Absensi Terbaru</h2>
                    <x-data-table :headers="['Nama', 'User ID', 'Tanggal', 'Status']">
                        @foreach ($rekapTerbaru as $item)
                            <tr>
                                <td class="border border-gray-300 p-2">{{ $item->user->name }}</td>
                                <td class="border border-gray-300 p-2">{{ $item->user->user_id }}</td>
                                <td class="border border-gray-300 p-2">{{ $item->created_at->format('d-m-Y') }}</td>
                                <td class="border border-gray-300 p-2">{{ ucfirst($item->status) }}</td>
                            </tr>
                        @endforeach
                    </x-data-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
