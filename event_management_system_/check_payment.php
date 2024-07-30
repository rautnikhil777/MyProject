<?php 
session_start();
include "db_config.php";

$cid = $_SESSION["cid"];
$pid = $_POST["pid"];
$cardholder = $_POST["cardholder"];
$cardno = $_POST["cardno"];
$status = 'pending'; // or any default value you want to set

// Prepare the SQL statement with placeholders
$stmt = $con->prepare("INSERT INTO bill (bill_date, user_id, event_id, card_holder, card_number, status) VALUES (CURRENT_DATE, ?, ?, ?, ?, ?)");
$stmt->bind_param("iisss", $cid, $pid, $cardholder, $cardno, $status);

// Execute the statement
$stmt->execute();

// Check for errors
if ($stmt->error) {
    die("Error: " . $stmt->error);
}

$stmt->close();
$con->close();
?>

<script>
    alert('Payment accepted successfully. You will get a confirmation message very soon.');
    location.href = 'user_home.php';
</script>
