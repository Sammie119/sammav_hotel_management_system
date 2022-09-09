<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SMSSent extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'sms_id';

    protected $guarded = [];

    protected $casts = [
        'phone_numbers' => 'array',
    ];

}
