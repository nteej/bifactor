<?php

namespace App\Models;

use App\Services\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    const UpdatableAttributes = ['name', 'contact', 'email', 'info'];
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s', 'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /*public function getInfoAttribute($value)
    {
        return json_decode($value);
    }*/
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
}
