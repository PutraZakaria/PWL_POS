<?php

namespace App\Models;

// use App\Models\m_level;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserModel extends Model
{
    use HasFactory;

    protected $table = "m_users";
    protected $primaryKey = "user_id";

    protected $fillable =
        [
        'user_id',
        'level_id',
        'username',
        'nama',
        'password',
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(m_level::class, 'level_id', 'level_id');
    }

    public function penjual(): HasMany
    {
        return $this->hasMany(m_penjualan::class, 'user_id', 'user_id');
    }

    public function stok(): HasMany
    {
        return $this->hasMany(m_stok::class, 'user_id', 'user_id');
    }
}

// class BarangModel extends Model
// {
//     public function kategori(): BelongsTo
//     {
//         return $this->belongsTo(m_kategori::class, 'kategori_id', 'kategori_id');
//     }
// }
