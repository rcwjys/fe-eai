<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Registration Form</h2>
        <form action="{{ url('/register') }}" method="POST" id="registrationForm">
            @csrf
            <div class="form-group mt-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="user_email">Email address</label>
                <input type="email" class="form-control" id="user_email" name="user_email" required>
            </div>
            <div class="form-group">
                <label for="user_password">Password</label>
                <input type="password" class="form-control" id="user_password" name="user_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>
