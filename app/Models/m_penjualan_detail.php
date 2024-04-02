<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class m_penjualan_detail extends Model
{
    use HasFactory;
    protected $table = "m_penjualan_details";
    protected $primaryKey = "detail_id";

    protected $fillable =
        [
        'detail_id',
        'penjualan_id',
        'barang_id',
        'harga',
        'jumlah',
        ];

    public function penjualan(): BelongsTo
    {
        return $this->belongsTo(m_penjualan::class, 'penjualan_id', 'penjualan_id');
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(m_barang::class, 'barang_id', 'barang_id');
    }
}
