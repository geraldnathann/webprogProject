<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            background-color: #fff;
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

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .center {
            text-align: center;
        }

        .margin-top{
            margin-top: 150px;
        }


    </style> 
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
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
                        @auth
                            <!-- Show logout button when user is logged in -->
                            <!-- <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <li class="nav-item">Logout</li>
                            </form> -->
                            <li class="nav-item "><a class="nav-link" href="/logout">Logout</a></li>
                        @else
                            <!-- Show login button when user is not logged in -->
                            <!-- <a href="{{ route('loginForm.view') }}">Login</a> -->
                            <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="/register-as-partner-form ">Register</a></li>
                        @endauth
                        
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container margin-top">
        <table border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
               
             
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Expiration Date</th>
                <th>Event Title</th>
                <th>Event Description</th>
                <th>Event Date</th>
                <th>Event Location</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($donations as $donation)
                <tr>
                    <td>{{ $donation->id }}</td>
                    <td>{{ $donation->user->name }}</td>
                    
                    
                    <td>{{ $donation->name }}</td>
                    <td>{{ $donation->quantity }}</td>
                    <td>{{ $donation->expiration_date }}</td>
                   
                    @if ($donation->event)
                                <td>{{ $donation->event->title }}</td>
                                <td>{{ $donation->event->description }}</td>
                                <td>{{ \Carbon\Carbon::parse($donation->event->date)->format('d M Y') }}</td>
                                <td>{{ $donation->event->location }}</td>
                            @else
                                <td colspan="4">No event registered for this donation.</td>
                            @endif
                            <td>{{ $donation->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div >  
        <a class="btn btn-primary btn-xl text-uppercase" href="/pick-up-form">Request Pickup</a>
    </div>
    </div>
</body>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</html>