<!DOCTYPE html>
<html>
<head>
    <title>Rooms List</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Rooms List</h2>

    <table>
        <thead>
            <tr>
                <th>Room Number</th>
                <th>Capacity</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td>{{ $room->room_number }}</td>
                    <td>{{ $room->capacity }}</td>
                    <td>{{ number_format($room->price, 2) }}</td>
                    <td>{{ $room->is_available ? 'Available' : 'Unavailable' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
