<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->input('search');
    
      
        $query = Students::query();
    
     
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
                
        }
    
       
        $students = $query->paginate(5);
    
     
        $students->appends(['search' => $search]);
    
        return view('students.index', compact('students', 'search'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'gender' => 'required|in:Male,Female',
            'dob' => 'required|date',
        ]);

        // Create the student record
        Students::create($request->all());

        // Redirect back with success message
        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Students $student)
    {
        return view('students.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Students $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Students $student)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
        ]);
    
        $student->update($request->all());
    
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Students::findOrFail($id);

        $student->delete();
    

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

    public function export()
    {
        $students = Students::all(); 

        $pdf = Pdf::loadView('students.pdf', compact('students'));
    
        return $pdf->download('students_report.pdf');
    }
}
