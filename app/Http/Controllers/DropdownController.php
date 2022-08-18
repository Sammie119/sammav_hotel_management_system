<?php

namespace App\Http\Controllers;

use App\Models\Dropdown;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function index()
    {
        $dropdowns = Dropdown::orderBy('category_id')->get();
        return view('admin.dropdowns', ['dropdowns' => $dropdowns]);
    }

    public function store(Request $request)
    {
        if($request->has('id')){
            $dropdown = Dropdown::find($request->id);
        }
        else {
            $dropdown = new Dropdown;
        }

        $dropdown->category_id = $request->category_id;
        $dropdown->dropdown_name = $request->dropdown_name;

        if($request->has('id')){
            $dropdown->update();

            return redirect('dropdowns')->with('success', 'Dropdown Updated Successfully!!');
        }
        else {
            $dropdown->save();

            return redirect('dropdowns')->with('success', 'Dropdown Created Successfully!!');
        }

    }

    public function distroy($id)
    {
        $dropdown = Dropdown::find($id);
        $dropdown->delete();

        return redirect('dropdowns')->with('success', 'Dropdown Deleted Successfully!!');
    }
}
