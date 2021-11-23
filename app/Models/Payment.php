<?php

namespace App\Models;

use App\Services\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, HasUuid, SoftDeletes;
    protected $guarded = [];
    public function setInfoAttribute($value)
    {
        $this->attributes['info'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getInfoAttribute()
    {
        $model = new $this;
        $jsonToConvert = $this->attributes['info'];
        $modelArray = $model->fromJson($jsonToConvert);
        return $modelArray;

    }
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function scopeCreditPayments(Builder $query, int $invoiceId): float
    {
        $inv_total = $this->where('invoice_id', $invoiceId)->where('state', 'credit')->get();
        $q = 0;
        if (!$inv_total->isEmpty()) {
            $q = $inv_total->sum('amount');
        }
        return $q;

    }
    public function scopeDebitPayments(Builder $query, int $invoiceId): float
    {
        $inv_total = $this->where('invoice_id', $invoiceId)->where('state', 'debit')->get();
        $q = 0;
        if (!$inv_total->isEmpty()) {
            $q = $inv_total->sum('amount');
        }
        return $q;

    }

}
