<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'pemesanan_id',
        'nama_pelanggan',
        'jumlah_transfer',
        'nama_bank',
        'keterangan',
        'tanggal',
        'struk_pembayaran',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}