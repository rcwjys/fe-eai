<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Guest Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
 
    .navbar {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 10px 20px;
      background-color: #f8f9fa;
    }

    .navbar-brand {
      font-weight: bold;
      color: #343a40;
      font-size: 1.5rem;
    }

    .navbar-brand:hover {
      color: #007bff;
    }

    .navbar-nav .nav-item {
      margin-left: 20px;
    }

    .navbar-nav .nav-link {
      color: #343a40;
      font-size: 1rem;
    }

    .navbar-nav .nav-link:hover {
      color: #007bff;
    }

    .navbar-nav .nav-item.active .nav-link {
      color: #007bff;
      font-weight: bold;
    }

    .navbar-toggler {
      border: none;
      outline: none;
    }

    @media (max-width: 992px) {
      .navbar-nav {
        flex-direction: column;
        align-items: flex-start;
      }
      .navbar-nav .nav-item {
        margin-left: 0;
      }
      .navbar-nav .nav-link {
        padding: 10px 0;
      }
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}">Guest</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="{{url('/')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/candidates')}}">Calon Kandidat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/login')}}">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
