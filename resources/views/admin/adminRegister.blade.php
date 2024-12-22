<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Registration</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #212529;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .form-card {
      background-color: #2d2d2d;
      color: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
      width: 100%;
      max-width: 600px;
    }
    .form-control {
      background-color: transparent;
      color: #fff;
      border: 1px solid #fff;
    }
    .form-control::placeholder {
      color: #aaa;
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #60a5fa;
    }
    .btn-primary {
      background-color: #3b82f6;
      border: none;
    }
    .btn-primary:hover {
      background-color: #2563eb;
    }
    .alert-danger {
      margin-top: 0.5rem;
    }
  </style>
</head>
<body>
  <div class="form-card">
    <h3 class="text-center mb-4">Admin Registration</h3>
    <form method="POST" action="{{ route('admin.register') }}">
      @csrf
      <div class="mb-3">
        <input type="text" name="name" class="form-control" placeholder="Admin Name" value="{{ old('name') }}" required>
        @error('name')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
        @error('email')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <input type="tel" name="phoneNo" class="form-control" placeholder="Phone Number" value="{{ old('phoneNo') }}" required>
        @error('phoneNo')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        @error('password')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
