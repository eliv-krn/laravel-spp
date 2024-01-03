<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\PetugasModel;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $petugas = PetugasModel::paginate(5);
        return view('petugas.data', compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'username'     => ['required', 'unique:petugas,username'],
            'password'     => 'required',
            'nama_petugas' => 'required',
            'level'        => 'required',
        ]);

        $petugas = PetugasModel::create([
            'username'     => $request->username,
            'password'     => Hash::make($request->password),
            'nama_petugas' => $request->nama_petugas,
            'level'        => $request->level,
        ]);

        return redirect()->route('petugas.index')->with(['success' => 'Data petugas berhasil disimpan']);
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
        $petugas = PetugasModel::findOrFail($id);
        return view('petugas.edit', compact('petugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'username'     => 'required',
            'password'     => 'required',
            'nama_petugas' => 'required',
            'level'        => 'required',
        ]);

        $petugas = PetugasModel::findOrFail($id);
        $petugas->update([
            'username'     => $request->username,
            'password'     => Hash::make($request->password),
            'nama_petugas' => $request->nama_petugas,
            'level'        => $request->level,
        ]);

        return redirect()->route('petugas.index')->with(['success' => 'Data petugas berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $petugas = PetugasModel::findOrFail($id);
        $petugas->delete();

        return redirect()->route('petugas.index')->with(['success' => 'Data petugas berhasil dihapus']);
    }
}
