<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SppModel;
use App\Models\PembayaranModel;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pembayaran = DB::table('pembayaran')
                        ->join('siswa', 'siswa.nisn', '=', 'pembayaran.nisn')
                        ->join('petugas', 'petugas.id_petugas', '=', 'pembayaran.id_petugas')
                        ->join('spp', 'spp.id_spp', '=', 'pembayaran.id_spp')
                        ->paginate(5);

        return view('pembayaran.data', compact('pembayaran'));
    }

    public function laporan()
    {
        //
        $pembayaran = DB::table('pembayaran')
                        ->join('siswa', 'siswa.nisn', '=', 'pembayaran.nisn')
                        ->join('petugas', 'petugas.id_petugas', '=', 'pembayaran.id_petugas')
                        ->join('spp', 'spp.id_spp', '=', 'pembayaran.id_spp')
                        ->get();

        return view('pembayaran.laporan', compact('pembayaran'));
    }   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $spp = SppModel::all();
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        $tahun = [];
        for($th = date('Y')-2; $th <= date('Y'); $th++) {
            $tahun[] = $th;
        }
        return view('pembayaran.create', compact(['spp', 'bulan', 'tahun']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'id_petugas'    => 'required',
            'nisn'          => 'required',
            'tanggal_bayar' => 'required',
            'bulan_dibayar' => 'required',
            'tahun_dibayar' => 'required',
            'id_spp'        => 'required',
            'jumlah_bayar'  => 'required'
        ]);

        PembayaranModel::create([
            'id_petugas'    => $request->id_petugas,
            'nisn'          => $request->nisn,
            'tanggal_bayar' => $request->tanggal_bayar,
            'bulan_dibayar' => $request->bulan_dibayar,
            'tahun_dibayar' => $request->tahun_dibayar,
            'id_spp'        => $request->id_spp,
            'jumlah_bayar'  => $request->jumlah_bayar
        ]);

        return redirect()->route('pembayaran.index')->with(['success' => 'Data pembayaran berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $spp = SppModel::all();
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        $tahun = [];
        for($th = date('Y')-2; $th <= date('Y'); $th++) {
            $tahun[] = $th;
        }
        $pembayaran = DB::table('pembayaran')
            ->join('siswa', 'siswa.nisn', '=', 'pembayaran.nisn')
            ->join('petugas', 'petugas.id_petugas', '=', 'pembayaran.id_petugas')
            ->join('spp', 'spp.id_spp', '=', 'pembayaran.id_spp')
            ->where('pembayaran.id_pembayaran', '=', $id)
            ->first();

        return view('pembayaran.edit', compact(['spp', 'bulan', 'tahun', 'pembayaran']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'id_petugas'    => 'required',
            'nisn'          => 'required',
            'tanggal_bayar' => 'required',
            'bulan_dibayar' => 'required',
            'tahun_dibayar' => 'required',
            'id_spp'        => 'required',
            'jumlah_bayar'  => 'required'
        ]);

        $pembayaran = PembayaranModel::findOrFail($id);
        $pembayaran->update([
            'id_petugas'    => $request->id_petugas,
            'nisn'          => $request->nisn,
            'tanggal_bayar' => $request->tanggal_bayar,
            'bulan_dibayar' => $request->bulan_dibayar,
            'tahun_dibayar' => $request->tahun_dibayar,
            'id_spp'        => $request->id_spp,
            'jumlah_bayar'  => $request->jumlah_bayar
        ]);

        return redirect()->route('pembayaran.index')->with(['success' => 'Data pembayaran berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pembayaran = PembayaranModel::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with(['success' => 'Data pembayaran berhasil dihapus']);
    }
}
