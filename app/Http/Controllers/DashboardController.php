<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\SppModel;
use App\Models\PetugasModel;
use App\Models\PembayaranModel;

class DashboardController extends Controller
{
    //
    public function index() {
        if(Auth::guard('siswa')->check() || Auth::guard('petugas')->check()) {
            $kelas      = KelasModel::count();
            $siswa      = SiswaModel::count();
            $spp        = SppModel::count();
            $petugas    = PetugasModel::count();
            $pembayaran = PembayaranModel::count();

            return view('dashboard', compact(['kelas', 'siswa', 'spp', 'petugas', 'pembayaran']));
        }
        return redirect()->route('logout');
    }
}
