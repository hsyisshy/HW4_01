<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Laravel App</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    
    body {
      background: linear-gradient(135deg, #f7f9fc, #e5eff9);
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
  </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
  <div class="card shadow rounded-3" style="max-width: 50%; width: 100%;">
    <div class="card-body p-5 text-center">
      <h1 class="card-title mb-4">Welcome to My Laravel App</h1>
      
      <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('login') }}" class="btn btn-outline-secondary px-4">Login</a>
        <a href="{{ route('register') }}" class="btn btn-primary px-4">Register</a>
      </div>
    </div>
  </div>

 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
