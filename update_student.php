<?php
include("includes/db.php");

$id = intval($_POST['id']);
$first = $_POST['first_name'];
$last = $_POST['last_name'];
$grade = $_POST['grade_level'];
$date = $_POST['enrollment_date'];

$stmt = $conn->prepare("
    UPDATE students 
    SET first_name = ?, last_name = ?, grade_level = ?, enrollment_date = ?
    WHERE id = ?
");

$stmt->bind_param("ssisi", $first, $last, $grade, $date, $id);
$stmt->execute();

header("Location: student.php?id=$id");
exit;
?>

// Updated for commit 