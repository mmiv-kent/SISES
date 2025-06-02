<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Room;
use App\Models\Rent;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Students::count();
        $availableRooms = Room::where('is_available', '1')->count();
        $activeRentals = Room::where('is_available', '0')->count(); // Adjust column if needed

        return view('dashboard', compact('totalStudents', 'availableRooms', 'activeRentals'));
    }
}
