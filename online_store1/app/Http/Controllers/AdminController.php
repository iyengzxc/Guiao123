<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;

use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function showStaff()
{
    $staff = User::where('role', 'staff')->get(); // Assuming 'role' is the column that indicates the user role
    return view('admin.index', ['staff' => $staff]);
}
    

    public function createStaff()
    {
        return view('admin.create-staff');
    }

    public function storeStaff(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits:11'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address'=> $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Staff created successfully.');
    }

    public function deleteStaff($id)
{
    $staff = User::findOrFail($id);
    $staff->delete();

    return redirect()->route('admin.staff')->with('success', 'Staff member deleted successfully.');
}

public function editStaff($id)
{
    $staff = User::findOrFail($id); // Assuming 'User' is your model for staff members
    return view('admin.edit', compact('staff'));
}

public function updateStaff(Request $request, $id)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
    ]);

    $staff = User::findOrFail($id);
    $staff->name = $request->name;
    $staff->phone = $request->phone;
    $staff->address = $request->address;
    $staff->email = $request->email;
    
    $staff->save();

    return redirect()->route('admin.index')->with('success', 'Staff updated successfully');
}



}
