<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SiswaModel extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $guard = 'petugas';
    protected $table = 'siswa';
    protected $primaryKey = 'nisn';
    protected $fillable = ['nisn', 'nis', 'nama', 'id_kelas', 'alamat', 'no_telp', 'id_spp', 'password'];

    public $timestamps = false;
}
