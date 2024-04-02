<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\m_barang;
use App\Models\m_user;

class m_stok extends Model
{
    use HasFactory;

    protected $table = "m_stoks";
    protected $primaryKey = "stok_id";
    protected $fillable =
        [
            'stok_id',
            'barang_id',
            'user_id',
            'stok_tanggal',
            'stok_jumlah'
        ];

        public function barang(): BelongsTo
        {
            return $this->belongsTo(m_barang::class, 'barang_id', 'barang_id');
        }

        public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}
