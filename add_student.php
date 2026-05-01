<?php
$conn = new mysqli("localhost", "root", "", "student_success_tracker");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $grade = $_POST['grade_level'];
    $date = $_POST['enrollment_date'];

    $conn->query("INSERT INTO students (first_name, last_name, grade_level, enrollment_date)
                  VALUES ('$first', '$last', '$grade', '$date')");

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<nav style="margin-bottom:20px;">
    <a href="index.php">Home</a> |
    <a href="add_student.php">Add Student</a> |
    <a href="attendance.php">Attendance</a> |
    <a href="grades.php">Grades</a> |
    <a href="analytics.php">Analytics</a>
</nav>

<h2>Add New Student</h2>

<form method="POST">
    First Name: <input type="text" name="first_name" required><br><br>
    Last Name: <input type="text" name="last_name" required><br><br>
    Grade Level: <input type="number" name="grade_level" required><br><br>
    Enrollment Date: <input type="date" name="enrollment_date" required><br><br>
    <button type="submit">Add Student</button>
</form>

</body>
</html>
