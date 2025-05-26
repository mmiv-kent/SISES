<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    // Show all rooms
    public function index(Request $request)
    {
        $query = Room::query();

        // Filter by room number (partial match)
        if ($request->filled('room_number')) {
            $query->where('room_number', 'like', '%' . $request->room_number . '%');
        }

        // Filter by availability (expects '1' or '0')
        if ($request->filled('is_available')) {
            $query->where('is_available', $request->is_available);
        }

        // Filter by minimum price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Filter by maximum price
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $rooms = $query->paginate(5)->withQueryString(); // keep filters on pagination links

        return view('rooms.index', compact('rooms'));
    }


    // Show form to create a new room
    public function create()
    {
        return view('rooms.create');
    }

    // Store new room in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms,room_number',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Room added successfully.');
    }

    // Show form to edit a room
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    // Update room info
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms,room_number,' . $room->id,
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'is_available' => 'required|boolean', // add this line
        ]);

        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }


    // Delete a room
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }



    public function exportPdf(Request $request)
    {
        $query = Room::query();

        // Apply filters from the request, same as index()
        if ($request->filled('room_number')) {
            $query->where('room_number', 'like', '%' . $request->room_number . '%');
        }
        if ($request->filled('is_available')) {
            $query->where('is_available', $request->is_available);
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $rooms = $query->get(); // all filtered rooms, no pagination

        $pdf = Pdf::loadView('rooms.pdf', compact('rooms'));

        return $pdf->download('rooms-list.pdf');
    }

}
