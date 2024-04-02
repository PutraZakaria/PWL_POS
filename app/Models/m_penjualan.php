<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class m_penjualan extends Model
{
    use HasFactory;
    protected $table = "m_penjualans";
    protected $primaryKey = "penjualan_id";

    protected $fillable =
        [
        'penjualan_id',
        'user_id',
        'pembeli',
        'penjualan_kode',
        'penjualan_tanggal',
        ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    public function penjualan_detail(): HasMany
    {
        return $this->hasMany(m_penjualan_detail::class, 'penjualan_id', 'penjualan_id');
    }

    public function barang(): HasMany
    {
        return $this->hasMany(m_barang::class, 'barang_id', 'barang_id');
    }
}
