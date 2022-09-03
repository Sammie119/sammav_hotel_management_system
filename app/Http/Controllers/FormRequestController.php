<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Room;
use App\Models\User;
use App\Models\Dropdown;
use App\Models\GallaryImages;
use App\Models\Loan;
use App\Models\PayrollDependecy;
use App\Models\RoomType;
use App\Models\ServicePrice;
use App\Models\Staff;
use App\Models\VWStaff;
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

            case 'new_image':
                return view('forms.input-forms.gallery_form');
                break;

            case 'new_staff':
                return view('forms.input-forms.staff_form');
                break;

            case 'new_loan':
                return view('forms.input-forms.loan_form');
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

            case 'edit_price':
                $setprice = ServicePrice::find($id);
                return view('forms.input-forms.price_form', ['setprice' => $setprice]);
                break;

            case 'edit_image':
                $image = GallaryImages::find($id);
                return view('forms.input-forms.gallery_form', ['image' => $image]);
                break;

            case 'edit_staff':
                $staff = Staff::find($id);
                return view('forms.input-forms.staff_form', ['staff' => $staff]);
                break;

            case 'edit_salary':
                $staff = VWStaff::where('salary_id', $id)->first();
                return view('forms.input-forms.salary_form', ['staff' => $staff]);
                break;

            case 'edit_salary_paymemt':
                $staff = VWStaff::where('salary_id', $id)->first();
                $pay = PayrollDependecy::where('staff_id', $staff->staff_id)->orderByDesc('id')->first();
                $loans = Loan::where([
                                    ['staff_id', '=', $staff->staff_id],
                                    ['status', '!=', 2],
                                ])->get();
                return view('forms.input-forms.salary_payment_form', [
                    'staff' => $staff, 
                    'pay' => $pay,
                    'loans' => $loans,
                ]);
                break;

            // Use when the need be
            case 'edit_all_payment':
                $staff = VWStaff::where('salary_id', $id)->first();
                return '<h1>Edit All</h1>';
                // return view('forms.input-forms.salary_payment_form', ['staff' => $staff]);
                break;
            // Use when the need be

            case 'edit_loan':
                $loan = Loan::find($id);
                $staff = VWStaff::where('staff_id', $loan->staff_id)->first();
                return view('forms.input-forms.loan_form', ['loan' => $loan, 'staff' => $staff]);
                break;
        
            default:
                return "No Form Selected";
                break;
        }
   }
   
   
   public function getViewModalData($data, $id)
   {
        switch ($data) {
            case 'view_image':
                $image = GallaryImages::find($id);
                return view('forms.view-forms.gallery_view', ['image' => $image]);
                break;

            case 'view_staff':
                $staff = VWStaff::where('staff_id', $id)->first();
                return view('forms.view-forms.staff_view', ['staff' => $staff]);
                break;

            case 'view_all_payment':
                $staff = VWStaff::where('staff_id', $id)->first();
                return '<h1>View All</h1>';
                // return view('forms.view-forms.staff_view', ['staff' => $staff]);
                break;

            case 'view_loan':
                $loan = Loan::find($id);
                $staff = VWStaff::where('staff_id', $loan->staff_id)->first();
                return view('forms.view-forms.loan_view', ['loan' => $loan, 'staff' => $staff]);
                break;
            
            default:
                return "No Form Selected";
                break;
        }
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

            case 'delete_image':
                return view('forms.delete-forms.delete-image', ['id' => $id]);
                break;

            case 'delete_staff':
                return view('forms.delete-forms.delete-staff', ['id' => $id]);
                break;
            
            // Use when the need be 
            case 'delete_all_paymemt':
                return view('forms.delete-forms.delete-paid-salary', ['id' => $id]);
                break;
            // Use when the need be

            case 'delete_loan':
                return view('forms.delete-forms.delete-loan', ['id' => $id]);
                break;
        
            default:
                return "No Form Selected";
                break;
        }
    }
}
