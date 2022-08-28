<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payroll extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'payroll_episodes';

    protected $primaryKey = 'pay_id';

    protected $guarded = [];
    
    protected $casts = [
        'income' => 'array',
        'deduction' => 'array'
    ];

    // protected function setAdminPermissionsAttribute($request_perms)
    // {
    //     $perms = array();
        
    //     foreach ($request_perms as $val) {
    //         $perm = ['admin_permission' => $val];
    //         array_push($perms, $perm);
    //     }
    //     $this->attributes['admin_permissions'] =  json_encode(array("admin_permissions" => $perms));
    // }
}
