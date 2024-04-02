<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\m_kategori;

class m_barang extends Model
{
    use HasFactory;

    protected $table = "m_barangs";
    protected $primaryKey = "barang_id";
    protected $fillable =
        [
            'barang_id',
            'kategori_id',
            'barang_kode',
            'barang_nama',
            'harga_beli',
            'harga_jual'
        ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(m_kategori::class, 'kategori_id', 'kategori_id');
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(m_barang::class, 'barang_id', 'barang_id');
    }

    public function stok(): HasMany
    {
        return $this->hasMany(m_stok::class, 'user_id', 'user_id');
    }

    public function penjualan_detail(): HasMany
    {
        return $this->HasMany(m_penjualan_detail::class, 'barang_id', 'barang_id');
    }

}
