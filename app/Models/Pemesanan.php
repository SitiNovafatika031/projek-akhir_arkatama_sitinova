<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $fillable = [
        'nama_penerima', 'alamat', 'ongkir_id', 'kota', 'kode_pos', 'no_telp','subtotal' ,'status_bayar'
    ];

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'pemesanan_produk')
                    ->withPivot('harga', 'jumlah')
                    ->withTimestamps();
    }

    public function pemesananProduks()
    {
        return $this->hasMany(PemesananProduk::class, 'pemesanan_id');
    }
    public function ongkir()
    {
        return $this->belongsTo(Ongkir::class);
    }
    
}