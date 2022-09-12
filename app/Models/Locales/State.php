<?php

namespace App\Models\Locales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PHPUnit\Framework\Constraint\Count;

class State extends Model
{
    use HasFactory;
    protected $fillable = ['name','state_letter','code','country_id','ddd'];

    /**
     * @return BelongsTo
     */
    public function country() : BelongsTo
    {
        return $this->belongsTo(Count::class);
    }
}
