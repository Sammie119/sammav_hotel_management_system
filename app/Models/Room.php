<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'room_id';

    protected $guarded = [];

    public function roomtype()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
