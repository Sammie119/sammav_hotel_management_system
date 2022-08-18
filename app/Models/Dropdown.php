<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dropdown extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'dropdown_id';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(DropdownCategory::class, 'category_id');
    }
}
