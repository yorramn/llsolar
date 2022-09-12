<?php

namespace App\Models\Customer;

use App\Models\StatusNegotiation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cpf', 'cnpj', 'cellphone', 'email', 'status_negotiation_id'];

    protected $with = ['address','dependents','contracts','attachments','statusNegotiation'];

    /**
     * @return HasOne
     */
    public function address() : HasOne
    {
        return $this->hasOne(CustomerAddress::class);
    }

    /**
     * @return HasMany
     */
    public function dependents() : HasMany
    {
        return $this->hasMany(CustomerDependents::class);
    }

    /**
     * @return HasOne
     */
    public function contracts() : HasOne
    {
        return $this->hasOne(CustomerContactContract::class);
    }

    /**
     * @return HasMany
     */
    public function attachments() : HasMany
    {
        return $this->hasMany(CustomerAttachments::class)
            ->orderBy('created_at', 'desc');
    }

    public function statusNegotiation() : BelongsTo
    {
        return $this->belongsTo(StatusNegotiation::class);
    }

    public function getCnpjAttribute($value)
    {
        return $value !== '' ? $value : null;
    }

}
