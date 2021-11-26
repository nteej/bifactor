<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Company extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    /**
     *
     */
    const UpdatableAttributes = ['name', 'contact', 'email', 'info', 'debtor_limit'];
    /**
     * @var array
     */
    protected $guarded = [];
    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s', 'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * @param $value
     */
    public function setInfoAttribute($value)
    {
        $this->attributes['info'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return mixed
     */
    public function getInfoAttribute()
    {
        $model = new $this;
        $jsonToConvert = $this->attributes['info'];
        $modelArray = $model->fromJson($jsonToConvert);
        return $modelArray;

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoices(){
        return $this->belongsTo(Invoice::class);
    }
}
