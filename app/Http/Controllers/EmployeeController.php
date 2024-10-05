<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Correctly import Storage

class EmployeeController extends Controller
{
    public function index()
    {
        // Get employees that belong to the current user only
        $employees = Employee::where('user_id', Auth::id())->get();

        // Check the number of employees associated with the user
        $employeeCount = Employee::where('user_id', Auth::id())->count();

        return view('dashboard.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate the image
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('employee_photos', 'public'); // Upload the photo
        }

        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_id' => auth()->id(),
            'photo' => $photoPath, // Save the photo path
        ]);

        return redirect()->route('home')->with('success', 'Employee added successfully!');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email,'.$id,
            'user_id' => 'required|exists:users,id', // Validate existence of user_id
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = $employee->photo;
        if ($request->hasFile('photo')) {
            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo); // Delete the old photo
            }
            $photoPath = $request->file('photo')->store('employee_photos', 'public'); // Upload the new photo
        }

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'user_id' => $request->user_id, // Update user_id
            'photo' => $photoPath, // Update the photo path
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        // Delete the photo if it exists
        if ($employee->photo) {
            Storage::disk('public')->delete($employee->photo);
        }

        $employee->delete();

        return redirect()->route('home')->with('success', 'Employee deleted successfully!');
    }
}
