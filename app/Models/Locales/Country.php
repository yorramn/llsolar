<?php

namespace App\Models\Locales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'name_pt', 'letter', 'bacen'];

    /**
     * @return HasMany
     */
    public function states() : HasMany
    {
        return $this->hasMany(State::class);
    }
}
