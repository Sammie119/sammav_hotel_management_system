<?php

use App\Models\PayrollDependecy;
use App\Models\TaxSSNIT;
use App\Models\SystemSetup;
use Illuminate\Support\Facades\DB;

    function nameOfInstitution()
    {
        return SystemSetup::select('name')->first()->name;
    }

    function getDropdownName($id)
    {
        return DB::table('dropdowns')->select('dropdown_name')->where('dropdown_id', $id)->first()->dropdown_name;
    }

    function getUserRole($role)
    { 
        switch ($role) {
            case 0:
                return "User";
                break;
            
            case 1:
                return "Admin";
                break;

            case 2:
                return "Super Admin";
                break;

            case 3:
                return "System Admin";
                break;

            default:
                return "No Role for User";
                break;
        }
    }

    function getRoomStatus($status)
    { 
        switch ($status) {
            case 0:
                return "Vacant Clean";
                break;

            case 1:
                return "Vacant Dirty";
                break;
            
            case 2:
                return "Reserved/Booked";
                break;

            case 3:
                return "Occupied Clean";
                break;

            case 4:
                return "Occupied Dirty";
                break;
            
            case 5:
                return "Out of Order";
                break;

            default:
                return "No Status";
                break;
        }
    }

    function getLoanStatus($status) 
    {
        switch ($status) {
            case 0:
                return "Pending";
                break;
            
            case 1:
                return "Paying";
                break;

            case 2:
                return "Paid";
                break;

            default:
                return "No Status";
                break;
        }
    }

    function getUsername($user_id)
    {
        return DB::table('users')->select('username')->where('user_id', $user_id)->first()->username;
    }

    function getSsfEmployer($basic)
    {
        $tax = floatval(TaxSSNIT::select('ssf_employer')->orderByDesc('id')->first()->ssf_employer);
        return floatval($basic * ($tax/100));
    }

    function getSsfEmployee($basic)
    {
        $tax = floatval(TaxSSNIT::select('ssf_employee')->orderByDesc('id')->first()->ssf_employee);
        return floatval($basic * ($tax/100));
    }

    function getTax($basic, $id)
    {
        $tax = TaxSSNIT::orderByDesc('id')->first();
        $ssf = $tax->ssf_employee;
        $first = $tax->first_0;
        $next_1 = $tax->next_5;
        $next_2 = $tax->next_10;
        $next_3 = $tax->next_17_5;
        $next_4 = $tax->next_25;
        $exceeding = $tax->exceeding;

        // Allowance
        $allownce = PayrollDependecy::select('amount_incomes')->where('staff_id', $id)->orderByDesc('id')->first();

        $total_allowance = array_sum($allownce->amount_incomes ?? [0]);

        $result = floatval($basic + $total_allowance) - floatval($first + $basic * ($ssf/100));

        if($result > 0){

            if($result > $next_1) {
                $next_1_result = $result - $next_1;
            } else {
                return floatval($result * (5/100));
            }
            
            if($next_1_result >= 1){

                if($next_1_result > $next_2) {
                    $next_2_result = $next_1_result - $next_2;
                } else {
                    return floatval($next_1 * (5/100)) + floatval($next_1_result * (10/100));
                }

                if($next_2_result >= 1){

                    if($next_2_result > $next_3) {
                        $next_3_result = $next_2_result - $next_3;
                    } else {
                        return floatval($next_1 * (5/100)) + floatval($next_2 * (10/100)) + floatval($next_2_result * (17.5/100));
                    }
                    
                    if($next_3_result >= 1){

                        if($next_3_result > $next_4) {
                            $next_4_result = $next_3_result - $next_4;
                        } else {
                            return floatval($next_1 * (5/100)) + floatval($next_2 * (10/100)) + floatval($next_3 * (17.5/100)) + floatval($next_3_result * (25/100)); 
                        }

                        if($next_4_result >= 1){

                            $exceeding_result = $next_4_result;
                            
                            return floatval($next_1 * (5/100)) + floatval($next_2 * (10/100)) + floatval($next_3 * (17.5/100)) + floatval($next_4 * (25/100)) + floatval($exceeding_result * (30/100));
                            
                        } 

                    } 

                } 

            } 
        } else {

            return floatval($first * (0/100));

        }
        // return floatval($basic * (25/100));
    }