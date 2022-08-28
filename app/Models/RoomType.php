<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomType extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'r_type_id';

    protected $guarded = [];

    public function galleryimages()
    {
        return $this->hasMany(GallaryImages::class, 'room_type_id');
    }
}
