<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanPayment;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::orderByDesc('loan_id')->get();
        return view('admin.all-loans', ['loans' => $loans]);
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
            'staff_id' => 'required|numeric',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'amount_per_month' => 'required|numeric',
            'number_of_months' => 'required|numeric|min:1|max:48', // max:48 = 4 years
        ]);

        if($request->has('id')){
            $loan = Loan::find($request->id);
            
        }
        else {
            $loan = new Loan;
            $loan_pay = new LoanPayment;
        }        
        
        $loan->staff_id = $request->staff_id;
        $loan->description = $request->description;
        $loan->amount = $request->amount;
        $loan->amount_per_month = $request->amount_per_month;
        $loan->number_of_months = $request->number_of_months;

        if($request->has('id')){
            $loan->updated_by = Auth()->user()->user_id;
            $loan->update();

            LoanPayment::where('loan_id', $request->id)->update(array(
                'staff_id' => $request->staff_id, 
                'amount' => $request->amount,
                'updated_by' => Auth()->user()->user_id
            ));

            return redirect('loans')->with('success', 'Loan Updated Successfully!!');
        }
        else {
            $loan->created_by = Auth()->user()->user_id;
            $loan->updated_by = Auth()->user()->user_id;
            $loan->save();

            $loan_pay->loan_id = $loan->loan_id;
            $loan_pay->staff_id = $request->staff_id;
            $loan_pay->amount = $request->amount;
            $loan_pay->amount_paid = 0;
            $loan_pay->months_paid = 0;
            $loan_pay->created_by = Auth()->user()->user_id;
            $loan_pay->updated_by = Auth()->user()->user_id;
            $loan_pay->save();

            return redirect('loans')->with('success', 'Loan Created Successfully!!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loan = Loan::find($id);
        if($loan->status === 0){
            $loan->delete();

            return redirect('loans')->with('success', 'Loan Deleted Successfully!!');
        }
        else {
            return back()->with('error', 'Loan Payment has Started or Completed. Cannot Delete!!!!');
        }
    }
}
