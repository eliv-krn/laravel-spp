<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\SppModel;
use App\Models\PembayaranModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $siswa = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->join('spp', 'siswa.id_spp', '=', 'spp.id_spp')
            ->paginate(5);
        return view('siswa.data', compact('siswa'));
    }

    public function getSiswa(Request $request) {
        $nisn = $request->get('nisn');
        $siswa = $siswa = DB::table('siswa')
                            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
                            ->join('spp', 'siswa.id_spp', '=', 'spp.id_spp')
                            ->where('nisn', $nisn)->first();
        return response()->json($siswa);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $kelas = KelasModel::all();
        $spp = SppModel::all();
        return view('siswa.create', compact(['kelas', 'spp']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nisn'     => ['required', 'unique:siswa,nisn'],
            'nis'      => ['required', 'unique:siswa,nis'],
            'nama'     => 'required',
            'id_kelas' => 'required',
            'alamat'   => 'required',
            'no_telp'  => 'required',
            'id_spp'   => 'required',
            'password' => 'required',
        ]);

        $siswa = SiswaModel::create([
            'nisn'     => $request->nisn,
            'nis'      => $request->nis,
            'nama'     => $request->nama,
            'id_kelas' => $request->id_kelas,
            'alamat'   => $request->alamat,
            'no_telp'  => $request->no_telp,
            'id_spp'   => $request->id_spp,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('siswa.index')->with(['success' => 'Data siswa berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $siswa = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->join('spp', 'siswa.id_spp', '=', 'spp.id_spp')
            ->where('siswa.nisn', $id)
            ->first();
        return view('siswa.detail', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $kelas = KelasModel::all();
        $spp = SppModel::all();
        $siswa = SiswaModel::findOrFail($id);
        return view('siswa.edit', compact(['siswa', 'kelas', 'spp']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'nis'      => ['required'],
            'nama'     => 'required',
            'id_kelas' => 'required',
            'alamat'   => 'required',
            'no_telp'  => 'required',
            'id_spp'   => 'required',
            'password' => 'required',
        ]);

        $siswa = SiswaModel::findOrFail($id);
        $siswa->update([
            'nis'      => $request->nis,
            'nama'     => $request->nama,
            'id_kelas' => $request->id_kelas,
            'alamat'   => $request->alamat,
            'no_telp'  => $request->no_telp,
            'id_spp'   => $request->id_spp,
            'password' => Hash::make($request->password),
        ]);
        
        return redirect()->route('siswa.index')->with(['success' => 'Data siswa berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $siswa = SiswaModel::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with(['success' => 'Data siswa berhasil dihapus']);
    }

    public function getHistory() {
        $nisn = session('user')->nisn;

        $pembayaran = DB::table('pembayaran')
            ->join('siswa', 'siswa.nisn', '=', 'pembayaran.nisn')
            ->join('petugas', 'petugas.id_petugas', '=', 'pembayaran.id_petugas')
            ->join('spp', 'spp.id_spp', '=', 'pembayaran.id_spp')
            ->where('siswa.nisn', '=', $nisn)
            ->paginate(5);


        return view('siswa.history', compact('pembayaran'));
    }
}
