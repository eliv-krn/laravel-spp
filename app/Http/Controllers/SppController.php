<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SppModel;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $spp = SppModel::paginate(5);
        return view('spp.data', compact('spp'));
    }

    public function getSpp(Request $request) {
        $id_spp = $request->get('id_spp');
        $spp = SppModel::findOrFail($id_spp);
        return response()->json($spp);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('spp.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'tahun' => 'required',
            'nominal' => 'required'
        ]);

        $spp = SppModel::create([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal
        ]);

        return redirect()->route('spp.index')->with(['success' => 'Data spp berhasil disimpan']);
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
        $spp = SppModel::findOrFail($id);
        return view('spp.edit', compact('spp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'tahun' => 'required',
            'nominal' => 'required'
        ]);

        $spp = SppModel::findOrFail($id);

        $spp->update([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal
        ]);

        return redirect()->route('spp.index')->with(['success' => 'Data spp berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $spp = SppModel::findOrFail($id);
        $spp->delete();

        return redirect()->route('spp.index')->with(['success' => 'Data spp berhasil dihapus']);
    }
}
