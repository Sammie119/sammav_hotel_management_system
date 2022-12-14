<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Payroll;
use App\Models\VWStaff;
use App\Models\Dropdown;
use App\Models\LoanPayment;
use Illuminate\Http\Request;
use App\Models\PayrollDependecy;
use App\Models\Staff;

class PayrollController extends Controller
{
    protected function percentageToAmount($array_amount, $array_rate, $basic_salary)
    {
        $get_arr = [];

        foreach ($array_amount as $i => $amount) {

            if($array_rate[$i] === 'Amount'){
                $value = ($amount / 1) * 1;
            }
            else {
                $value = ($amount / 100) * $basic_salary;
            }
            

            array_push($get_arr, $value);
        }
        
        return $get_arr;
    }

    protected function toAmount($array_rate)
    {
        $get_arr = [];

        foreach ($array_rate as $value) {

            $value = 'Amount';            

            array_push($get_arr, $value);
        }
        
        return $get_arr;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salary = VWStaff::orderByDesc('staff_id')->get();
        return view('admin.payroll-payment', ['salaries' => $salary]);
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
            'staff_id' => 'required|numeric'
        ]);

        if($request->has('id')){
            $pay = PayrollDependecy::find($request->id);
        }
        else {
            $pay = new PayrollDependecy;
        }

        // dd($request->all());
        if($request->has('loan_id') && $request->has('amount_loan')){
            // dd($request->all());
            foreach ($request->loan_id as $i => $loan_id) {

                $payment = LoanPayment::where(['loan_id' => $loan_id, 'staff_id' => $request->staff_id])
                                    ->orderByDesc('loan_pay_id')->first();
                $loan = Loan::find($loan_id);                                     

                if($payment->amount - ($payment->total_amount_paid + $request->amount_loan[$i]) <= 0 ){
                    $status = 2;
                } else {
                    $status = 1;
                }
            
                // Update Loan Payment
                
                $loan->update(array(
                    'status' => $status, 
                    'rate' => $request->rate_loan,
                    'updated_by' => Auth()->user()->user_id
                ));

                $loan_pay = new LoanPayment;

                $loan_pay->loan_id = $loan_id;
                $loan_pay->staff_id = $request->staff_id;
                $loan_pay->amount = $loan->amount;
                $loan_pay->amount_paid = $request->amount_loan[$i];
                $loan_pay->total_amount_paid = $payment->total_amount_paid + $request->amount_loan[$i];
                $loan_pay->months_paid = $payment->months_paid + 1;
                $loan_pay->status = $status;
                $loan_pay->created_by = Auth()->user()->user_id;
                $loan_pay->updated_by = Auth()->user()->user_id;

                $loan_pay->save();
               
            }
        }
            
        $pay->staff_id = $request->staff_id;
        $pay->incomes = $request->incomes;
        $pay->amount_incomes = (!empty($request->amount_incomes)) ? $this->percentageToAmount($request->amount_incomes, $request->rate_incomes, $request->basic_salary) : null;
        $pay->rate_incomes = (!empty($request->rate_incomes)) ? $this->toAmount($request->rate_incomes) : null;
        $pay->deductions = $request->deductions;
        $pay->amount_deductions = (!empty($request->amount_deductions)) ? $this->percentageToAmount($request->amount_deductions, $request->rate_deductions, $request->basic_salary) : null;
        $pay->rate_deductions = (!empty($request->rate_deductions)) ? $this->toAmount($request->rate_deductions) : null;
        $pay->tax = getTax($request->basic_salary, $request->staff_id);
        $pay->employer_ssf = $request->employer_ssf;
        $pay->employee_ssf = $request->employee_ssf;

        if($request->has('id')){
            $pay->updated_by = Auth()->user()->user_id;
            $pay->update();

            return redirect('payroll')->with('success', 'Payroll Updated Successfully!!');
        }
        else {
            $pay->created_by = Auth()->user()->user_id;
            $pay->updated_by = Auth()->user()->user_id;
            $pay->save();

            $pay->update(array(
                'tax' => getTax($request->basic_salary, $request->staff_id), 
            ));

            return redirect('payroll')->with('success', 'Payroll Created Successfully!!');
        }
    }

    public function viewSalariesPaid($id)
    {
        $payment = Payroll::where('staff_id', $id)->orderByDesc('pay_id')->get();
        $staff_name = VWStaff::where('staff_id', $id)->first();
        return view('admin.all-paid-salary', ['payments' => $payment, 'staff_name' => $staff_name]);
    }

    public function generatePayroll(Request $request)
    {
        $staffs = VWStaff::where('salary_type', $request->salary_type)->get();
        
        foreach ($staffs as $key => $staff) {
            // dd($staff->staff_id);
            $pay_dep = PayrollDependecy::where('staff_id', $staff->staff_id)->orderByDesc('id')->first();

            $pay_loan = LoanPayment::where('staff_id', $staff->staff_id)->orderByDesc('loan_pay_id')->first();
            if(isset($pay_loan->status) && $pay_loan->status === 2){
                $pay_loan->loan_pay_id = 0;
            }
            // dd($request->all(), $pay_dep, $pay_loan, $staff->salary);

            $incomes = floatval(array_sum($pay_dep->amount_incomes ?? [0]));
            $deductions = floatval(array_sum($pay_dep->amount_deductions ?? [0])) + floatval($pay_dep->tax) + floatval($pay_dep->employee_ssf) + floatval($pay_loan->amount_paid ?? null);

            $gross_income = $staff->salary + $incomes;
            $net_income = $gross_income - $deductions;

            $payroll = new Payroll;
            $payroll->staff_id = $staff->staff_id;
            $payroll->depend_id = $pay_dep->id;
            $payroll->loan_pay_id = $pay_loan->loan_pay_id ?? null;
            $payroll->description = $request->description;
            $payroll->positon = $staff->position;
            $payroll->basic = $staff->salary;
            $payroll->gross_income = $gross_income;
            $payroll->net_income = $net_income;
            $payroll->pay_month = $request->salary_month;
            $payroll->pay_year = $request->salary_year;
            $payroll->salary_type = $request->salary_type;
            $payroll->created_by = Auth()->user()->user_id;
            $payroll->updated_by = Auth()->user()->user_id;

            $payroll->save();
        }

        return redirect('payroll')->with('success', 'Payroll Generated Successfully!!');
        
    }

    public function getPaySlip($pay_id)
    {
        $pay = Payroll::find($pay_id);
        $staff = VWStaff::where('staff_id', $pay->staff_id)->first();
        return view('admin.payslip_print', ['pay' => $pay, 'staff' => $staff]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function destroy($room_id)
    {
        $room = Payroll::find($room_id);
        $room->delete();

        return back()->with('success', 'Payroll Deleted Successfully!!');
    }
}
