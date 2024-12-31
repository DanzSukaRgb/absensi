<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\User;
class AdminController extends Controller
{
    // public function index()
    // {
    //     $rekap = Absensi::with('user')->get();
    //     return view('admin.dashboard', compact('rekap'));
    // }
    
    public function index()
    {
        $totalUsers = User::count();
        $totalAbsensi = Absensi::count();
        $absenHariIni = Absensi::whereDate('created_at', today())->count();
        $pendingIzin = Absensi::where('status', 'pending')->count();
        $rekapTerbaru = Absensi::latest()->limit(5)->get();

        // Debug untuk memeriksa data
        // dd($totalUsers, $totalAbsensi, $absenHariIni, $pendingIzin, $rekapTerbaru);

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAbsensi',
            'absenHariIni',
            'pendingIzin',
            'rekapTerbaru'
        ));
    }
    public function rekap(Request $request)
    {
        $rekap = Absensi::query();

        // Filter berdasarkan tanggal, minggu, atau bulan
        if ($request->has('tanggal')) {
            $rekap->whereDate('tanggal', $request->tanggal);
        }

        if ($request->has('minggu')) {
            $rekap->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()]);
        }

        if ($request->has('bulan')) {
            $rekap->whereMonth('tanggal', now()->month);
        }

        $rekap = $rekap->get();

        // Menggunakan view admin.recap jika file tersebut ada
        return view('admin.recap', compact('rekap'));
    }

    public function users()
    {
        return view('admin.users', ['users' => User::all()]);
    }
}
