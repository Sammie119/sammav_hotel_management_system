<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderByDesc('updated_at')->limit(200)->get();
        return view('admin.customers', ['customers' => $customers]);
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        if($request->has('id')){
            $customer = Customer::find($request->id);
        }
        else {
            $customer = new Customer;
        }

        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->location = $request->location;

        if($request->has('id')){
            $customer->update();

            return redirect('customers')->with('success', 'Guest Updated Successfully!!');
        }
        else {
            $customer->save();

            return redirect('customers')->with('success', 'Guest Created Successfully!!');
        }
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect('customers')->with('success', 'Guest Deleted Successfully!!');
    }
}
