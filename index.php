<?php
include 'db.php';
session_start();
if(!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }

$user_mobile = $_SESSION['user'];
$user_data = $conn->query("SELECT name, refer_code FROM users WHERE mobile='$user_mobile'")->fetch_assoc();
$setting = $conn->query("SELECT * FROM settings WHERE id=1")->fetch_assoc();

// আপনার ডোমেইন অনুযায়ী রেফার লিঙ্ক তৈরি করা
$my_refer_link = "http://mistralai.infy.click/register.php?ref=" . $user_data['refer_code'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root { --primary: #7c3aed; --bg: #f1f5f9; }
        body { font-family: 'Poppins', sans-serif; background: var(--bg); margin: 0; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; box-sizing: border-box; }
        .dashboard-card { background: white; width: 100%; max-width: 400px; padding: 30px; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); text-align: center; }
        .refer-box { background: #f8fafc; border: 2px dashed #cbd5e1; padding: 15px; border-radius: 15px; margin: 20px 0; }
        .refer-link { font-size: 12px; color: #64748b; word-break: break-all; display: block; margin-bottom: 10px; }
        .copy-btn { background: var(--primary); color: white; border: none; padding: 8px 15px; border-radius: 8px; cursor: pointer; font-size: 13px; font-weight: 600; }
        .btn-group a { display: block; padding: 15px; margin: 10px 0; border-radius: 12px; text-decoration: none; color: white; font-weight: 600; }
    </style>
</head>
<body>
    <div class="dashboard-card">
        <h2>Welcome, <?php echo $user_data['name']; ?></h2>
        
        <div class="refer-box">
            <p style="margin:0; font-size: 14px; font-weight: 600; color: #1e293b;">Your Referral Link</p>
            <span class="refer-link" id="refLink"><?php echo $my_refer_link; ?></span>
            <button class="copy-btn" onclick="copyLink()">Copy My Link</button>
        </div>

        <div class="btn-group">
            <a href="<?php echo $setting['telegram_link']; ?>" style="background:#0088cc;">Join Telegram</a>
            <a href="<?php echo $setting['whatsapp_link']; ?>" style="background:#25d366;">Join WhatsApp</a>
        </div>
        <br><a href="logout.php" style="color:red; text-decoration:none; font-size:14px;">Logout</a>
    </div>

    <script>
    function copyLink() {
        var linkText = document.getElementById("refLink").innerText;
        navigator.clipboard.writeText(linkText);
        Swal.fire('Copied!', 'Your referral link has been copied.', 'success');
    }
    </script>
</body>
</html>