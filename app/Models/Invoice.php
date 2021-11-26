<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, HasUuid, SoftDeletes;



    const UpdatableAttributes = ['invoice_no', 'due_date', 'customer_id', 'company_id', 'total_amount', 'info', 'state', 'status'];
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s', 'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

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

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeCustomer(Builder $query, int $id)
    {
        return $query->whereCustomerId($id);
    }

    public function scopeCompany(Builder $query, int $id)
    {
        return $query->whereCompanyId($id);
    }

    public function scopeInvoiceTotal(Builder $query, int $companyId): array
    {

        $inv_total = $this->where('company_id', $companyId)->where('state', 'open')->get();
        $q = 0;
        if (!$inv_total->isEmpty()) {
            $q = $inv_total->sum('total_amount');
        }
        return array("total_amount" => $q);
    }




}
