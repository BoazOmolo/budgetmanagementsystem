<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function admin()
    {
        $totalusers = User::count();
        $administrators = User::where('role_as', 1)->count(); // Retrieve administrators
        $users = User::where('role_as', 0)->count(); // Retrieve regular users
        return view('admin.dashboard', compact('totalusers', 'administrators', 'users'))->with('success', 'Admin Logged In Successfully!');
    }

    public function manageUsers()
    {
        $administrators = User::where('role_as', 1)->get(); // Retrieve administrators
        $users = User::where('role_as', 0)->get(); // Retrieve regular users

        return view('admin.users', compact('administrators', 'users'));
    }

    public function create()
    {   
        return view('admin.create');
    }

    public function createUserView()
    {
        return view('admin.createuser'); 
    }

    public function createUser(Request $request)
    {
        

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'The passwords do not match.',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->role_as = 0;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User added successfully.');
    }

    public function createAdminView()
    {
        return view('admin.createadmin'); 
    }


    public function createAdmin(Request $request)
    {
        

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'The passwords do not match.',
        ]);
        $administrator = new User();
        $administrator->name = $validatedData['name'];
        $administrator->email = $validatedData['email'];
        $administrator->password = bcrypt($validatedData['password']);
        $administrator->role_as = 1;
        $administrator->save();

        return redirect()->route('admin.users')->with('success', 'Admin added successfully.'); 
    }

    
}
