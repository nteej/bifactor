<?php

namespace App\Models;

use App\Services\Traits\EloquentBuilderMixin;
use App\Services\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Note
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $contact
 * @property string $email
 * @property array $info
 * @property float $debtor_limit
 * @property boolean $status
 * @mixin EloquentBuilderMixin
 */
class Company extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    const UpdatableAttributes = ['name', 'contact', 'email', 'info', 'debtor_limit'];
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
    public function invoices(){
        return $this->belongsTo(Invoice::class);
    }
}
