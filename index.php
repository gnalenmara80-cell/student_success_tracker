<?php
$conn = new mysqli("localhost", "root", "", "student_success_tracker");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Success Tracker</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 60%; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>

<h1>Student Success Tracker</h1>
<h2>Student List (Live Database Data)</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Grade Level</th>
        <th>Enrollment Date</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['student_id'] ?></td>
            <td><?= $row['first_name'] . " " . $row['last_name'] ?></td>
            <td><?= $row['grade_level'] ?></td>
            <td><?= $row['enrollment_date'] ?></td>
        </tr>
    <?php endwhile; ?>

</table>

</body>
</html>
