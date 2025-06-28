<?php
session_start();

// If already logged in, skip login form
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($user === 'admin' && $pass === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_dashboard.php');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('https://content3.jdmagicbox.com/v2/comp/nanded/j8/9999p2462.2462.170921133730.h5j8/catalogue/gramin-technical-and-management-campus-vishnupuri-nanded-nanded-colleges-3puoj0pb0n.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    .login-box {
      background: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 15px;
      max-width: 400px;
      margin: 80px auto;
      box-shadow: 0px 0px 15px rgba(0,0,0,0.3);
    }
    .logo { display: block; margin: 0 auto 20px; width: 100px; }
  </style>
</head>
<body>
  <div class="login-box">
    <img src="https://lh5.googleusercontent.com/proxy/87d5uydqSJ8twZfzHK90pXA1MdZ0vVOwlgy68J3XubxS5Y254V8NtH9KqQ1V0vgCIb8DWSIuvQ09g0Qr4fXnX81K5vbr3Rm2Hpn-k6R8WUM51BBf3CHhOw" alt="Logo" class="logo">
    <h4 class="text-center">Admin Login</h4>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required autofocus>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
  </div>
</body>
</html>
