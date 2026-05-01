<?php
header("Content-Type: application/json");
require_once "../includes/db.php";

$response = [];

if (!isset($_GET['student_id'])) {
    $response['error'] = "Missing student_id parameter.";
    echo json_encode($response);
    exit;
}

$student_id = intval($_GET['student_id']);

$query = "SELECT id, incident_type, description, date 
          FROM behavior 
          WHERE student_id = ? 
          ORDER BY date DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$behavior = [];

while ($row = $result->fetch_assoc()) {
    $behavior[] = $row;
}

$response['behavior'] = $behavior;

echo json_encode($response);
?>
