<?php

namespace App\Models;

use App\Services\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FcOrder extends Model
{
    use HasFactory, HasUuid, SoftDeletes;
    protected $guarded=[];
}
