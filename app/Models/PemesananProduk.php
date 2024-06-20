<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemesananProduk extends Model
{
    protected $fillable = [
        'pemesanan_id', 'produk_id', 'harga', 'jumlah',
    ];

    protected $table = 'pemesanan_produk';
    
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

}
