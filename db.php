<?php
$hostname = "sql312.infinityfree.com";
$db_user  = "if0_42311925";
$db_pass  = "VfP9Ws20YSDO"; // চোখের আইকনে ক্লিক করে পাসওয়ার্ডটি দেখে এখানে বসান
$db_name  = "if0_42311925_db_mistral";

$conn = new mysqli($hostname, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>