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

$query = "SELECT id, intervention_type, notes, date 
          FROM interventions 
          WHERE student_id = ? 
          ORDER BY date DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$interventions = [];

while ($row = $result->fetch_assoc()) {
    $interventions[] = $row;
}

$response['interventions'] = $interventions;

echo json_encode($response);
?>
