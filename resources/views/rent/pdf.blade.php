<!DOCTYPE html>
<html>
<head>
    <title>Rental Transactions</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Rental Transactions</h2>

    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Room</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentals as $rental)
                <tr>
                    <td>{{ $rental->student->name ?? 'Unknown' }}</td>
                    <td>{{ $rental->room->room_number ?? 'N/A' }}</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>{{ ucfirst($rental->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
