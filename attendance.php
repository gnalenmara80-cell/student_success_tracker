<?php
$conn = new mysqli("localhost", "root", "", "student_success_tracker");

$result = $conn->query("
    SELECT a.date, a.status, s.first_name, s.last_name
    FROM attendance a
    JOIN students s ON a.student_id = s.student_id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 70%; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #f2f2f2; }
    </style>
</head>

<body>

<nav style="margin-bottom:20px;">
    <a href="index.php">Home</a> |
    <a href="add_student.php">Add Student</a> |
    <a href="attendance.php">Attendance</a> |
    <a href="grades.php">Grades</a> |
    <a href="analytics.php">Analytics</a>
</nav>

<h2>Attendance Records</h2>

<table>
    <tr>
        <th>Student</th>
        <th>Date</th>
        <th>Status</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['first_name'] . " " . $row['last_name'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['status'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
