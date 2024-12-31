<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rekap Absensi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Filter Rentang Tanggal -->
                    <div class="mb-4">
                        <label for="filter-start-date" class="block text-sm font-medium text-gray-700">Filter Berdasarkan Tanggal</label>
                        <div class="flex space-x-4">
                            <input type="date" id="filter-start-date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <span class="text-sm text-gray-500 mt-2">sampai</span>
                            <input type="date" id="filter-end-date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>

                    <!-- Tabel Rekap Absensi -->
                    <table class="table-auto w-full text-left" id="rekap-table">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekap as $absensi)
                            <tr class="hover:bg-gray-100 absensi-data" data-tanggal="{{ $absensi->created_at->toDateString() }}">
                                <td class="border-t px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border-t px-4 py-2">{{ $absensi->user->name }}</td>
                                <td class="border-t px-4 py-2">
                                    <button type="button" class="text-white bg-green-500 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 py-2 px-4 rounded-md">{{ $absensi->status }}</button>
                                </td>
                                <td class="border-t px-4 py-2">{{ $absensi->created_at->format('d-m-Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Fungsi untuk menyaring data berdasarkan rentang tanggal
    function filterDataByDateRange() {
        const startDate = document.getElementById('filter-start-date').value;
        const endDate = document.getElementById('filter-end-date').value;
        const rows = document.querySelectorAll('#rekap-table .absensi-data');

        rows.forEach(row => {
            const date = row.getAttribute('data-tanggal');
            const isInRange = (!startDate || date >= startDate) && (!endDate || date <= endDate);
            // Menampilkan atau menyembunyikan baris berdasarkan rentang tanggal yang dipilih
            row.style.display = isInRange ? '' : 'none';
        });
    }

    // Event listener untuk menangani perubahan filter tanggal
    document.getElementById('filter-start-date').addEventListener('input', filterDataByDateRange);
    document.getElementById('filter-end-date').addEventListener('input', filterDataByDateRange);

    // Inisialisasi filter data ketika halaman pertama kali dimuat
    filterDataByDateRange();
</script>
