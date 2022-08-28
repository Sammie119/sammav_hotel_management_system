<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GallaryImages extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'image_id';

    protected $guarded = [];

    public function roomtype()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
