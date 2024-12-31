<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Carbon\Carbon;
use App\Models\User;
class AbsensiController extends Controller
{
 
    // Menampilkan Dashboard User
    public function userDashboard()
    {
        // Mengambil riwayat absensi user
        $riwayat = Absensi::where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('user.dashboard', compact('riwayat'));
    }

    // Proses Absensi
    public function absen(Request $request)
    {
        // Koordinat lokasi kantor
        $officeLat = -6.200000; // Sesuaikan dengan lokasi Anda
        $officeLng = 106.816666;
        $radius = 1000000; // Radius dalam meter

        // Validasi jarak dari lokasi pengguna
        $distance = $this->calculateDistance(
            $request->latitude,
            $request->longitude,
            $officeLat,
            $officeLng
        );

        if ($distance > $radius) {
            return redirect()->route('user.dashboard')->with('error', 'Anda berada di luar lokasi yang diizinkan.');
        }

        // Cek apakah user sudah absen hari ini
        $existingAbsence = Absensi::where('user_id', auth()->id())
            ->whereDate('tanggal', today())
            ->exists();

        if ($existingAbsence) {
            return redirect()->route('user.dashboard')->with('error', 'Anda sudah melakukan absensi hari ini.');
        }

        // Simpan data absensi
        Absensi::create([
            'user_id' => auth()->id(),
            'status' => 'hadir',
            'tanggal' => today(),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Absensi berhasil.');
    }

    // Fungsi untuk menghitung jarak antara dua koordinat
    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371000; // Radius bumi dalam meter
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng / 2) * sin($dLng / 2);

        return $earthRadius * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }

    // Reset Absensi Otomatis
    public function resetAbsensi()
    {
        Absensi::whereDate('tanggal', '<', today())->delete();
        return response()->json(['message' => 'Data absensi berhasil direset.']);
    }
}
