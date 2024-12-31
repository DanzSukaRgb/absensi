<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Absen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-lg rounded-lg">
                <h1 class="text-2xl font-bold mb-4 text-gray-800">Dashboard Absensi</h1>

                <!-- Menampilkan Pesan Sukses atau Error -->
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <p class="mb-6 text-gray-700">Silakan lakukan absensi menggunakan lokasi Anda.</p>

                <!-- Form Absensi -->
                <form id="absen-form" method="POST" action="{{ route('user.absen') }}" class="mb-8">
                    @csrf
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">

                    <button type="button" onclick="getLocation()" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                        Absen Sekarang
                    </button>
                </form>

                <script>
                    function getLocation() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition((position) => {
                                document.getElementById('latitude').value = position.coords.latitude;
                                document.getElementById('longitude').value = position.coords.longitude;
                                document.getElementById('absen-form').submit();
                            }, () => {
                                alert('Gagal mendapatkan lokasi. Pastikan izin lokasi telah diaktifkan.');
                            });
                        } else {
                            alert('Geolocation tidak didukung pada browser ini.');
                        }
                    }
                </script>

                <!-- Menampilkan Riwayat Absensi -->
                <h2 class="mt-8 text-xl font-semibold text-gray-800">Riwayat Absensi</h2>
                <table class="mt-4 w-full text-gray-700">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">Waktu</th>
                            <th class="px-4 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayat as $item)
                            <tr class="hover:bg-gray-100">
                                <td class="border-t px-4 py-2">{{ $item->user->name }}</td>
                                <td class="border-t px-4 py-2">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                <td class="border-t px-4 py-2 {{ $item->status === 'hadir' ? 'bg-green-100' : ($item->status === 'izin' ? 'bg-yellow-100' : 'bg-red-100') }}">
                                    {{ ucfirst($item->status) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>
