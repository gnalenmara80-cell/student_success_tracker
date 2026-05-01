<?php
header("Content-Type: application/json");
require_once "../includes/db.php";

if (!isset($_GET['student_id'])) {
    echo json_encode(["error" => "student_id required"]);
    exit;
}

$studentId = intval($_GET['student_id']);

$sql = "SELECT subject, grade AS score, date_recorded 
        FROM grades 
        WHERE student_id = ?
        ORDER BY date_recorded ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();

$grades = [];
while ($row = $result->fetch_assoc()) {
    $grades[] = $row;
}


// Updated commit history

echo json_encode($grades);
?>
