<!DOCTYPE html>
<html>
<head>
    <title>Login - MFC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: #f5f5f5; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
            font-family: Arial, sans-serif;
        }
        .login-container { 
            background: white; 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
            max-width: 400px; 
            width: 100%; 
        }
        .login-container h2 { 
            text-align: center; 
            margin-bottom: 20px; 
            color: #333; 
        }
        .form-group { 
            margin-bottom: 15px; 
        }
        .form-group label { 
            display: block; 
            margin-bottom: 5px; 
            font-weight: bold; 
        }
        .form-control { 
            width: 100%; 
            padding: 10px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            box-sizing: border-box; 
        }
        .btn { 
            width: 100%; 
            padding: 12px; 
            background: #007bff; 
            color: white; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 16px; 
        }
        .alert { 
            margin-bottom: 20px; 
            padding: 15px; 
            border-radius: 5px; 
        }
        .back-link { 
            text-align: center; 
            margin-top: 20px; 
        }
        .back-link a { 
            color: #007bff; 
            text-decoration: none; 
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login to MFC</h2>
        
        <?php
        if (isset($_GET['login_error'])) {
            echo '<div class="alert alert-danger">Invalid login or password</div>';
        }
        ?>
        
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="login">Email or Username:</label>
                <input type="text" name="login" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <button type="submit" class="btn">Login</button>
        </form>
        
        <div class="back-link">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
