<?php
header("Content-Type: application/json");
require_once "../includes/db.php";

if (!isset($_GET['student_id'])) {
    echo json_encode(["error" => "student_id required"]);
    exit;
}

$studentId = intval($_GET['student_id']);

$sql = "SELECT date, status 
        FROM attendance 
        WHERE student_id = ?
        ORDER BY date ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();

$attendance = [];
while ($row = $result->fetch_assoc()) {
    $attendance[] = $row;
}

echo json_encode($attendance);
?>

// updated for commit history
