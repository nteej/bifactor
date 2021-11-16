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
 * @property string $reg_no
 * @property string $name
 * @property string $address
 * @property string $br_no
 * @property float $debtor_limit
 * @property boolean $status
 * @mixin EloquentBuilderMixin
 */
class Company extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    protected $guarded = [];
}
