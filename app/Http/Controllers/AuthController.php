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
        return view('dashboard');
    }

    public function userHome()
    {
        return view('home');
    }

    public function registration()
    {
        return view('register');
    }

    public function postRegistration(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'role' => 'required',
            'contact' => 'required',
            'position' => 'required',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required|min:6|same:password'
        ]);

        User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'role' => $request['role'],
            'contact' => $request['contact'],
            'position' => $request['position'],
            'password' => Hash::make($request['password'])
        ]);

        return back()->with('success', 'New User Successfully Created!!');
    }

    public function postLogin(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...dashboard
            if (Auth()->user()->role == 1) {
                
                Session::flash('success', 'Logged in Successfully!');
                return redirect()->intended('dashboard');
            } else {
                
                Session::flash('success', 'Logged in Successfully!');
                return redirect()->intended('home');
            }
        }
        
        return back()->with('success', 'Oppes! You have entered invalid credentials!');
    }

    public function usersList()
    {
        $users = User::where('position', '!=', 'Super Admin')->get();
        return view('user_list', ['users' => $users]);
    }

    public function userProfile()
    {
        $user = User::find(Auth()->user()->id);
        return view('profile', ['user' => $user]);
    }

    public function profileStore(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$request->id.',id',
            'role' => 'required',
            'contact' => 'required',
            'position' => 'required',
            'password' => 'nullable|min:6|same:confirm_password',
            'confirm_password' => 'nullable|min:6|same:password'
        ]);

        $user = User::find($request->id);

        if(isset($request->password)) {
            $user->update([
                'name' => $request['name'],
                'username' => $request['username'],
                'role' => $request['role'],
                'contact' => $request['contact'],
                'position' => $request['position'],
                'password' => Hash::make($request['password'])
            ]);
        }
        else {
            $user->update([
                'name' => $request['name'],
                'username' => $request['username'],
                'role' => $request['role'],
                'contact' => $request['contact'],
                'position' => $request['position'],
            ]);
        }

        return $this->logout();
    }

    public function userEdit($id)
    {
        $user = User::find($id);
        return view('edit_user', ['user' => $user]);
    }

    public function updateUser(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$request->id.',id',
            'role' => 'required',
            'contact' => 'required',
            'position' => 'required',
        ]);

        $user = User::find($request->id);

        $user->update([
            'name' => $request['name'],
            'role' => $request['role'],
            'contact' => $request['contact'],
            'position' => $request['position'],
        ]);

        return back()->with('success', 'User Updated Successfully Created!!');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with('success', 'User Deleted Successfully Created!!');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
