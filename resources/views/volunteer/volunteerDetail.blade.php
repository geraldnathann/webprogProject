<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Registered Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background for better readability */
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            color: #343a40; /* Dark gray color for the title */
            margin-bottom: 30px;
            font-weight: bold;
        }

        .table {
            background-color: #ffffff; /* White background for table */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for a lifted look */
            overflow: hidden; /* To keep the border-radius clean */
        }

        .table th {
            background-color: #343a40; /* Dark header for contrast */
            color: #ffffff; /* White text for header */
            text-align: center;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
        }

        p {
            text-align: center;
            color: #6c757d; /* Muted text color */
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>My Registered Events</h1>

    @if($registeredEvents->isEmpty())
        <p>You have not registered for any events yet.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registeredEvents as $eventDetail)
                    <tr>
                        <td>{{ $eventDetail->event->title }}</td>
                        <td>{{ $eventDetail->event->description }}</td>
                        <td>{{ \Carbon\Carbon::parse($eventDetail->event->date)->format('d M Y') }}</td>
                        <td>{{ $eventDetail->event->location }}</td>
                        <td>{{ \Carbon\Carbon::parse($eventDetail->created_at)->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>