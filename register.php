<?php
include 'db.php';
session_start();
$error = "";

// ১. রেফার কোড লজিক: লিঙ্ক থেকে আসলে সেটা বসবে, না হলে অটো জেনারেট হবে
if(isset($_GET['ref'])){
    $final_refer = htmlspecialchars($_GET['ref']);
} else {
    $final_refer = "MS-" . strtoupper(bin2hex(random_bytes(3)));
}

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $ref = $_POST['refer_code'];

    if($pass !== $cpass){
        $error = "Password and Confirm Password do not match!";
    } else {
        // একই নাম্বার ও পাসওয়ার্ড চেক
        $check = $conn->query("SELECT * FROM users WHERE mobile='$mobile' AND password='$pass'");
        if($check->num_rows > 0){
            $error = "আপনি এই পাসওয়ার্ডটি আগে ব্যবহার করেছেন। দয়া করে অন্য পাসওয়ার্ড দিন।";
        } else {
            $sql = "INSERT INTO users (name, mobile, email, password, refer_code) VALUES ('$name', '$mobile', '$email', '$pass', '$ref')";
            if($conn->query($sql)){
                $_SESSION['user'] = $mobile;
                $success = true;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mistral AI - Premium Register</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #7c3aed; --bg: #f8fafc; }
        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: var(--bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 20px; }
        
        .card { background: white; width: 100%; max-width: 400px; padding: 30px; border-radius: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center; }
        
        .logo-box { width: 85px; height: 85px; background: #000; border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; border: 3px solid #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.2); overflow: hidden; }
        .logo-box img { width: 100%; height: 100%; object-fit: cover; }
        
        h2 { margin: 0; color: #1e293b; font-weight: 600; font-size: 24px; }
        p { color: #64748b; font-size: 13px; margin-bottom: 20px; }
        
        input { width: 100%; padding: 12px 16px; margin: 8px 0; border: 1.5px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none; transition: 0.3s; }
        input:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1); }
        
        .refer-input { background: #f1f5f9; color: #475569; font-weight: 600; border: 1.5px dashed #cbd5e1; cursor: not-allowed; }

        .btn { width: 100%; padding: 14px; background: var(--primary); border: none; color: white; font-weight: 600; border-radius: 12px; cursor: pointer; margin-top: 15px; font-size: 16px; transition: 0.3s; }
        .btn:hover { opacity: 0.9; transform: translateY(-1px); }
        
        .footer-link { margin-top: 20px; font-size: 13px; color: #64748b; }
        .footer-link a { color: var(--primary); text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>

    <div class="card">
        <div class="logo-box">
            <img src="https://avatars.githubusercontent.com/u/144955682?s=200&v=4" alt="Mistral AI">
        </div>
        <h2>Mistral AI</h2>
        <p>Create your premium account</p>

        <?php if($error) echo "<p style='color:red; font-size:12px; font-weight:bold;'>$error</p>"; ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="number" name="mobile" placeholder="Mobile Number" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="cpassword" placeholder="Confirm Password" required>
            
            <label style="font-size: 11px; color: #94a3b8; display: block; text-align: left; margin: 5px 0 0 5px;">Referral Code:</label>
            <input type="text" name="refer_code" value="<?php echo $final_refer; ?>" class="refer-input" readonly>
            
            <button type="submit" name="register" class="btn">Register Now</button>
        </form>
        <div class="footer-link">Already have an account? <a href="login.php">Login</a></div>
    </div>

    <?php if(isset($success)) { ?>
    <script>
        Swal.fire({
            title: 'Success!',
            text: 'Account created successfully!',
            icon: 'success',
            confirmButtonText: 'Enter Dashboard',
            confirmButtonColor: '#7c3aed'
        }).then(() => { window.location='index.php'; });
    </script>
    <?php } ?>

</body>
</html>