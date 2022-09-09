<?php

namespace App\Http\Controllers;

use App\Models\SystemSetup;
use App\Models\TaxSSNIT;
use Illuminate\Http\Request;

class SystemSetupController extends Controller
{
    public function index()
    {
        $hos = SystemSetup::find(1);
        return view('admin.system_setup_name', ['hos' => $hos]);
    }

    public function store(Request $request)
    {
        $hos = SystemSetup::find($request->id);
        
        $hos->update([
            'name' => $request['name'],
            'address' => $request['address'],
            'phone1' => $request['phone1'],
            'phone2' => $request['phone2'],
            'text_logo' => $request['text_logo'],
            'facebook' => $request['facebook'],
            'email' => $request['email'],
        ]);

        if($hos){
            return redirect('setup')->with('success', 'Hostel Details Updated Successfully!!');
        }
    }

    public function indexTax()
    {
        $tax = TaxSSNIT::orderByDesc('id')->get();
        return view('admin.tax_ssnit', ['taxs' => $tax]);
    }

    public function storeTax(Request $request)
    {
        // dd($request->all());
        $tax = TaxSSNIT::firstOrCreate([
            'first_0' => $request['first_0'],
            'next_5' => $request['next_5'],
            'next_10' => $request['next_10'],
            'next_17_5' => $request['next_17_5'],
            'next_25' => $request['next_25'],
            'exceeding' => $request['exceeding'],
            'ssf_employer' => $request['ssf_employer'],
            'ssf_employee' => $request['ssf_employee'],
        ]);

        if($tax){
            return redirect('tax')->with('success', 'Tax Created Successfully!!');
        }
    }

    public function destroy($id)
    {
        $tax = TaxSSNIT::find($id);

        $tax->delete();

        return redirect('tax')->with('success', 'Tax Deleted Successfully!!');
    }
}
