<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class m_level extends Model
{
    use HasFactory;
    protected $table = "m_levels";
    protected $primaryKey = "level_id";
    protected $keyType = 'int';

    public function users(): HasMany
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }
}
