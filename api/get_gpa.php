<?php
header("Content-Type: application/json");
require_once "../includes/calculations.php";

if (!isset($_GET['student_id'])) {
    echo json_encode(["error" => "student_id required"]);
    exit;
}

$studentId = intval($_GET['student_id']);
$gpa = calculateGPA($studentId);

echo json_encode(["gpa" => $gpa]);
?>
