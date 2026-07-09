<?php
include 'db.php';
session_start();
if(isset($_POST['login'])){
    $num = $_POST['mobile'];
    $pass = $_POST['password'];
    $res = $conn->query("SELECT * FROM users WHERE mobile='$num' AND password='$pass'");
    if($res->num_rows > 0){
        $_SESSION['user'] = $num;
        header("Location: index.php");
    } else {
        $error = "Invalid Mobile or Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mistral AI - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #3b82f6; --bg: #f8fafc; }
        body { font-family: 'Poppins', sans-serif; background: var(--bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .card { background: white; width: 90%; max-width: 400px; padding: 40px 30px; border-radius: 24px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); text-align: center; }
        /* CSS সেকশনে এটি আপডেট করুন */
.logo-box { 
    width: 80px; 
    height: 80px; 
    background: #000; 
    border-radius: 50%; 
    margin: 0 auto 20px; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    border: 3px solid #fff; 
    box-shadow: 0 4px 15px rgba(0,0,0,0.2); 
    overflow: hidden; /* এটি লোগোকে গোল সার্কেলের বাইরে যেতে দিবে না */
}
.logo-box img { 
    width: 100%; 
    height: 100%; 
    object-fit: cover; 
}
        h2 { margin: 0; color: #1e293b; font-weight: 600; }
        input { width: 100%; padding: 12px 16px; margin: 8px 0; border: 1.5px solid #e2e8f0; border-radius: 12px; box-sizing: border-box; }
        .btn { width: 100%; padding: 14px; background: var(--primary); border: none; color: white; font-weight: 600; border-radius: 12px; cursor: pointer; margin-top: 15px; }
        .footer-link { margin-top: 20px; font-size: 13px; color: #64748b; }
        .footer-link a { color: var(--primary); text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="card">
    <div class="logo-box">
        <img src="https://avatars.githubusercontent.com/u/144955682?s=200&v=4" alt="Logo">
    </div>
    <h2>Mistral AI</h2>
    <!-- বাকি সব ঠিক থাকবে -->
        <p>Login to continue</p>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="number" name="mobile" placeholder="Mobile Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" class="btn">Login Now</button>
        </form>
        <div class="footer-link">Don't have an account? <a href="register.php">Register</a></div>
    </div>
</body>
</html>