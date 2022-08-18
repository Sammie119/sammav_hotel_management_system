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

            default:
                return "No Role for User";
                break;
        }
    }