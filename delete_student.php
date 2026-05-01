<?php
include("includes/db.php");

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: index.php");
exit;
?>

// Updated to add commit message