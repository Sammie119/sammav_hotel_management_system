<?php

    function nameOfInstitution()
    {
        return \App\Models\SystemSetup::select('name')->first()->name;
    }

    function getDropdownName($id)
    {
        return Illuminate\Support\Facades\DB::table('dropdowns')->select('dropdown_name')->where('dropdown_id', $id)->first()->dropdown_name;
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

    function getUsername($user_id)
    {
        return Illuminate\Support\Facades\DB::table('users')->select('username')->where('user_id', $user_id)->first()->username;
    }