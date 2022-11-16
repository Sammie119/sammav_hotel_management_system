<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('login');
        } else {
            return back();
        }
    }

    public function adminHome()
    {
        return view('admin.dashbaord');
    }

    public function userHome()
    {
        return view('home');
    }

    public function postRegistration(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$request->id.',user_id',
            'role' => 'required',
            'p_contact' => 'required',
            'position' => 'required',
            'department' => 'required',
            'password' => 'nullable|min:6|same:confirm_password',
            'confirm_password' => 'nullable|min:6|same:password'
        ]);

        if($request->has('id')) {
            if(isset($request->password)){
                User::updateOrCreate(
                    [
                        'username' => $request['username']
                    ],
                    [
                    'name' => $request['name'],
                    'username' => $request['username'],
                    'role' => $request['role'],
                    'p_contact' => $request['p_contact'],
                    'o_contact' => $request['o_contact'],
                    'department' => $request['department'],
                    'position' => $request['position'],
                    'password' => Hash::make($request['password'])
                    ]
                );
            } else {
                User::updateOrCreate(
                    [
                        'username' => $request['username']
                    ],
                    [
                    'name' => $request['name'],
                    'username' => $request['username'],
                    'role' => $request['role'],
                    'p_contact' => $request['p_contact'],
                    'o_contact' => $request['o_contact'],
                    'department' => $request['department'],
                    'position' => $request['position'],
                    ]
                );
            }
            

            return back()->with('success', 'User Updated Successfully!!');
        }
        else{
            User::updateOrCreate(
                [
                    'username' => $request['username']
                ],
                [
                'name' => $request['name'],
                'username' => $request['username'],
                'role' => $request['role'],
                'p_contact' => $request['p_contact'],
                'o_contact' => $request['o_contact'],
                'department' => $request['department'],
                'position' => $request['position'],
                'password' => Hash::make($request['password'])
                ]
            );

            return back()->with('success', 'New User Successfully Created!!');
        }

    }

    public function postLogin(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // dd($request->all());

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...dashboard
            if (Auth()->user()->role >= 2) {
                
                Session::flash('success', 'Logged in Successfully!');
                return redirect()->intended('dashboard');
            } else {
                
                Session::flash('success', 'Logged in Successfully!');
                return redirect()->intended('home');
            }
        }
        
        return back()->with('erorr', 'Oppes! Wrong Credentials!');
    }

    public function usersList()
    {
        $users = User::where('role', '!=', '2')->get();
        return view('admin.users', ['users' => $users]);
    }

    public function userProfile()
    {
        $user = User::find(Auth()->user()->user_id);
        return view('user_profile', ['user' => $user]);
    }

    public function profileStore(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$request->id.',user_id',
            'p_contact' => 'required',
            'password' => 'nullable|min:6|same:confirm_password',
            'confirm_password' => 'nullable|min:6|same:password'
        ]);

        $user = User::find($request->id);

        if(isset($request->password)) {
            $user->update([
                'name' => $request['name'],
                'username' => $request['username'],
                'p_contact' => $request['p_contact'],
                'o_contact' => $request['o_contact'],
                'password' => Hash::make($request['password'])
            ]);
        }
        else {
            $user->update([
                'name' => $request['name'],
                'username' => $request['username'],
                'p_contact' => $request['p_contact'],
                'o_contact' => $request['o_contact'],
            ]);
        }
     
        return $this->logout();
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with('success', 'User Deleted Successfully!!');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
