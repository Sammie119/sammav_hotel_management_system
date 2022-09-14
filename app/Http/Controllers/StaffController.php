<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\VWStaff;
use App\Models\SetupSalary;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = VWStaff::orderByDesc('staff_id')->get();
        return view('admin.staff', ['staff' => $staff]);
    }

    public function salaryIndex()
    {
        $salary = VWStaff::orderByDesc('staff_id')->get();
        return view('admin.salary_setup', ['salary' => $salary]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'firstname' => 'required',
            'othernames' => 'required',
            'date_of_birth' => 'required|date',
            'phone' => 'required|numeric',
            'salary_type_id' => 'required_without:id|numeric',
            'department_id' => 'required_without:id|numeric',
            'position_id' => 'required_without:id|numeric'
        ]);

        if($request->has('id')){
            $staff = Staff::find($request->id);
        }
        else {
            $staff = new Staff;
        }

        $staff->firstname = $request->firstname;
        $staff->othernames = $request->othernames;
        $staff->date_of_birth = $request->date_of_birth;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->level_of_education = $request->level_of_education;
        $staff->qualification = $request->qualification;
        $staff->relative_name = $request->relative_name;
        $staff->relative_contact = $request->relative_contact;
    

        if($request->has('id')){
            $staff->update();

            return redirect('staff')->with('success', 'Staff Info Updated Successfully!!');
        }
        else {
            $staff->save();

            $salary = new SetupSalary();
            $salary->staff_id = $staff->staff_id;
            $salary->salary_type_id = $request->salary_type_id;
            $salary->department_id = $request->department_id;
            $salary->position_id = $request->position_id;
            $salary->salary = 0;
            $salary->created_by = Auth()->user()->user_id;
            $salary->updated_by = Auth()->user()->user_id;

            $salary->save();

            return redirect('staff')->with('success', 'Staff Created Successfully!!');
        }
    }

    public function updateSalary(Request $request)
    {
        // dd($request->all());
        $salary = SetupSalary::find($request->id);

        $salary->salary_type_id = $request->salary_type_id;
        $salary->department_id = $request->department_id;
        $salary->position_id = $request->position_id;
        $salary->salary = $request->salary;
        $salary->ssnit_number = $request->ssnit_number;
        $salary->banker = $request->banker;
        $salary->bank_branch = $request->bank_branch;
        $salary->bank_account = $request->bank_account;
        $salary->updated_by = Auth()->user()->user_id;

        $salary->update();

        $des = VWStaff::where('salary_id', $request->id)->first('fullname');

        $this->trackPriceChanges('Salary', $des->fullname, $salary->salary);

        return redirect('salary')->with('success', 'Staff Salary Updated Successfully!!');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($staff_id)
    {
        $staff = Staff::find($staff_id);
        $staff->delete();

        $salary = SetupSalary::where('staff_id', $staff_id)->first();
        $salary->delete();

        return redirect('staff')->with('success', 'Staff Deleted Successfully!!');
    }
}
