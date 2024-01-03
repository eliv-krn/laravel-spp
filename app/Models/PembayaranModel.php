<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranModel extends Model
{
    use HasFactory;

    protected $table      = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable   = ['id_petugas', 'nisn', 'tanggal_bayar', 'bulan_dibayar', 'tahun_dibayar', 'id_spp', 'jumlah_bayar'];
    public    $timestamps = false;
}
