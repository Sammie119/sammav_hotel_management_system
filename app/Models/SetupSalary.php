<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SetupSalary extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'salary_id';

    protected $guarded = [];
}
