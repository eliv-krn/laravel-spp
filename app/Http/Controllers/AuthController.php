<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\PetugasModel;
use App\Models\SiswaModel;

class AuthController extends Controller
{
    //
    public function login() {
        return view('login');
    }

    public function proses(Request $request) {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'level'    => ['required', 'string'],
        ]);

        if($request->level == 'siswa') {
            $data = [
                'nisn'     => $request->username,
                'password' => $request->password
            ];

            if (Auth::guard('siswa')->attempt($data)) {
                $request->session()->regenerate();
                
                $siswa = SiswaModel::where(['nisn' => $request->username])->first();
                $siswa['level'] = 'siswa';

                session(['user' => $siswa]);

                return redirect()->route('dashboard');
            };
        }
        else {
            $data = [
                'username' => $request->username,
                'password' => $request->password,
                'level'    => $request->level,
            ];

            if (Auth::guard('petugas')->attempt($data)) {
                $request->session()->regenerate();
                
                $petugas = PetugasModel::where(['username' => $request->username, 'level' => $request->level])->first();
                
                session(['user' => $petugas]);

                return redirect()->route('dashboard');
            };
        }
        
        return back()->withErrors([
            'username' => 'Username/ NISN tidak ditemukan.',
            'password' => 'Password tidak ditemukan.',
        ])->onlyInput('username');
        
    }
}
