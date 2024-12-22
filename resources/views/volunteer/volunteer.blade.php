<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #444;
        }

        .message {
            text-align: center;
            margin: 20px 0;
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: rgb(255, 255, 255);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table thead {
            background-color: #28242c;
            color: #fff;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .container{
            width: 90%;
        }
        button {
            background-color: #ffcc04;
            color: #28242c;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .center {
            text-align: center;
        }

        .margin-top {
            margin-top: 150px;
        }
    </style>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/css/styles.css" rel="stylesheet" />
</head>
<body>
@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif



<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top"><i class="fa-solid fa-earth-asia"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/volunteer/event-detail">Events</a></li>
            </ul>
        </div>
    </div>
</nav>
<div>
@if (session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif
</div>
<table border="1" cellspacing="0" cellpadding="10" class="margin-top" class="container">
    <thead>
        <tr>
            <th>Event ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->location }}</td>
                <td>
                    <form action="{{ route('volunteer.register', $event->id) }}" method="POST" onsubmit="return confirmRegistration('{{ $event->title }}')">
                        @csrf
                        <button type="submit">Register</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    function confirmRegistration(eventTitle) {
        return confirm(`Are you sure you want to register for the event "${eventTitle}"?`);
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
<script src="/js/scripts.js"></script>
</body>
</html>
