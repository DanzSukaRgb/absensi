<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Absensi;
use Illuminate\Support\Facades\Log;
class ResetAbsensi extends Command
{
    protected $signature = 'app:reset-absensi';
    protected $description = 'Reset Absensi';
    // protected $signature = 'reset:absensi';
    // protected $description = 'Reset absensi harian secara otomatis pada tengah malam';

    public function handle()
    {
$deletedCount = Absensi::where('tanggal', '<', today())->delete();
        Log::info('Jumlah absensi yang dihapus: ' . $deletedCount);
        $this->info('Absensi harian telah direset.');
    }
}
