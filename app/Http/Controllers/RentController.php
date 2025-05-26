<?php
namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Room;
use App\Models\Students;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function index()
    {
        $rentals = Rent::with(['student', 'room'])->paginate(2); // Correct relationship
        $students = Students::all(); // Corrected
        $rooms = Room::where('is_available', true)->get();

        return view('rent.index', compact('rentals', 'students', 'rooms'));
    }

    public function create()
    {
        $rooms = Room::where('is_available', true)->get();
        $students = Students::all(); // Corrected
        return view('rent.create', compact('rooms', 'students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        Rent::create([
            'student_id' => $validated['student_id'],
            'room_id' => $validated['room_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => 'active',
        ]);

        Room::where('id', $validated['room_id'])->update(['is_available' => false]);

        return redirect()->route('rentals.index')->with('success', 'Rental created successfully.');
    }

    public function edit(Rent $rental)
    {
        $rooms = Room::all();
        $students = Students::all(); // Corrected
        return view('rent.edit', compact('rental', 'rooms', 'students'));
    }

    public function update(Request $request, Rent $rental)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,completed,canceled',
        ]);

        $rental->update($validated);

        return redirect()->route('rentals.index')->with('success', 'Rental updated.');
    }

    public function destroy(Rent $rental)
    {
        $rental->delete();
        return redirect()->route('rentals.index')->with('success', 'Rental deleted.');
    }

    public function generatePdf()
    {
        $rentals = Rent::with(['student', 'room'])->get();

        $pdf = Pdf::loadView('rent.pdf', compact('rentals'));

        return $pdf->download('rental-transactions.pdf');
    }
}
