<?php
include 'db.php';
$search = "";
if(isset($_POST['search_btn'])){
    $search = $_POST['search_val'];
    $users = $conn->query("SELECT * FROM users WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR mobile LIKE '%$search%'");
} else {
    $users = $conn->query("SELECT * FROM users ORDER BY id DESC");
}

if(isset($_POST['update_links'])){
    $tg = $_POST['tg']; $wa = $_POST['wa'];
    $conn->query("UPDATE settings SET telegram_link='$tg', whatsapp_link='$wa' WHERE id=1");
    echo "<script>alert('Updated!');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mistral Admin</title>
    <style>
        body { font-family: sans-serif; background: #f0f2f5; padding: 20px; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        input[type=text] { padding: 10px; width: 250px; border-radius: 5px; border: 1px solid #ccc; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background: #1e293b; color: white; }
        .search-box { margin-bottom: 20px; background: #f8fafc; padding: 15px; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mistral AI Admin</h1>
        
        <div class="search-box">
            <form method="post">
                <input type="text" name="search_val" placeholder="Search by name, email or number" value="<?php echo $search; ?>">
                <button type="submit" name="search_btn">Search User</button>
                <a href="mistral_admin_99.php">Clear</a>
            </form>
        </div>

        <form method="post" style="margin-bottom: 30px;">
            <h3>Update Links</h3>
            TG: <input type="text" name="tg" placeholder="Telegram Link">
            WA: <input type="text" name="wa" placeholder="WhatsApp Link">
            <button type="submit" name="update_links">Update</button>
        </form>

        <h3>Total Users: <?php echo $users->num_rows; ?></h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Password</th>
                <th>Refer</th>
            </tr>
            <?php while($row = $users->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><?php echo $row['refer_code']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>