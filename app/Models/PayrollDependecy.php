<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayrollDependecy extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'incomes' => 'array',
        'deductions' => 'array',
        'amount_incomes' => 'array',
        'amount_deductions' => 'array',
        'rate_incomes' => 'array',
        'rate_deductions' => 'array'
    ];

    // protected function setIncomesAttribute($request_perms)
    // {
    //     $perms = array();
        
    //     foreach ($request_perms as $val) {
    //         $perm = ['income' => $val];
    //         array_push($perms, $perm);
    //     }
    //     $this->attributes['incomes'] =  json_encode($perms);
    // }

    // protected function setAmountIncomesAttribute($request_perms)
    // {
    //     $perms = array();
        
    //     foreach ($request_perms as $val) {
    //         $perm = ['amount_income' => $val];
    //         array_push($perms, $perm);
    //     }
    //     $this->attributes['amount_incomes'] =  json_encode($perms);
    // }

    // protected function setDeductionsAttribute($request_perms)
    // {
    //     $perms = array();
        
    //     foreach ($request_perms as $val) {
    //         $perm = ['deduction' => $val];
    //         array_push($perms, $perm);
    //     }
    //     $this->attributes['deductions'] =  json_encode($perms);
    // }

    // protected function setAmountDeductionsAttribute($request_perms)
    // {
    //     $perms = array();
        
    //     foreach ($request_perms as $val) {
    //         $perm = ['amount_deduction' => $val];
    //         array_push($perms, $perm);
    //     }
    //     $this->attributes['amount_deductions'] =  json_encode($perms);
    // }

    public function pay_staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
