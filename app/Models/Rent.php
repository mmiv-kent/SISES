<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    // Specify the actual table name
    protected $table = 'room_rental';

    protected $fillable = [
        'student_id',
        'room_id',
        'start_date',
        'end_date',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
