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

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
