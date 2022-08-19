<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Room;
use App\Models\User;
use App\Models\Dropdown;
use App\Models\RoomType;
use Illuminate\Http\Request;

class FormRequestController extends Controller
{
    public function getCreateModalData($data)
    {
        switch ($data) {
            case 'new_user':
                return view('forms.input-forms.user_form');
                break;

            case 'new_dropdown':
                return view('forms.input-forms.dropdown_form');
                break;

            case 'new_roomtype':
                return view('forms.input-forms.roomtype_form');
                break;

            case 'new_room':
                return view('forms.input-forms.room_form');
                break;
            
            case 'new_customer':
                return view('forms.input-forms.customer_form');
                break;

            default:
                return "No Form Selected";
                break;
        }
    }

   public function getEditModalData($data, $id)
   {
        switch ($data) {
            case 'edit_user':
                $user = User::find($id);
                return view('forms.input-forms.user_form', ['user' => $user]);
                break;

            case 'edit_dropdown':
                $dropdown = Dropdown::find($id);
                return view('forms.input-forms.dropdown_form', ['dropdown' => $dropdown]);
                break;

            case 'edit_roomtype':
                $roomtype = RoomType::find($id);
                return view('forms.input-forms.roomtype_form', ['roomtype' => $roomtype]);
                break;

            case 'edit_room':
                $room = Room::find($id);
                return view('forms.input-forms.room_form', ['room' => $room]);
                break;

            case 'edit_customer':
                $customer = Customer::find($id);
                return view('forms.input-forms.customer_form', ['customer' => $customer]);
                break;
            
            default:
                return "No Form Selected";
                break;
        }
   }

   public function getViewModalData($data, $id)
   {
        // switch ($data) {
        //     case 'new_user':
        //         return "View User Form $id";
        //         // return view('forms.add.add-category');
        //         break;
            
        //     default:
        //         return "No Form Selected";
        //         break;
        // }
   }

    public function getDeleteModalData($data, $id)
    {
        switch ($data) {
            case 'delete_user':
                return view('forms.delete-forms.delete-user', ['id' => $id]);
                break;

            case 'delete_dropdown':
                return view('forms.delete-forms.delete-dropdown', ['id' => $id]);
                break;
            
            case 'delete_roomtype':
                return view('forms.delete-forms.delete-roomtype', ['id' => $id]);
                break;

            case 'delete_room':
                return view('forms.delete-forms.delete-room', ['id' => $id]);
                break;

            case 'delete_customer':
                return view('forms.delete-forms.delete-customer', ['id' => $id]);
                break;
        
            default:
                return "No Form Selected";
                break;
        }
    }
}
