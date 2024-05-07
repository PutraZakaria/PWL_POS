<?php

namespace App\Models;

// use App\Models\m_level;

// use Attribute;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = "m_users";
    protected $primaryKey = "user_id";

    protected $fillable =
        [
        'user_id',
        'username',
        'nama',
        'password',
        'level_id',
        'image',
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/posts/' . $image),
        );
    }
}
