<?php include("includes/header.php"); ?>
<?php include("includes/db.php"); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $grade = $_POST['grade_level'];
    $date = $_POST['enrollment_date'];

    $stmt = $conn->prepare("INSERT INTO students (first_name, last_name, grade_level, enrollment_date)
                            VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $first, $last, $grade, $date);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<h2>Add New Student</h2>

<form method="POST">
    <label>First Name:</label><br>
    <input type="text" name="first_name" required><br><br>

    <label>Last Name:</label><br>
    <input type="text" name="last_name" required><br><br>

    <label>Grade Level:</label><br>
    <input type="number" name="grade_level" required><br><br>

    <label>Enrollment Date:</label><br>
    <input type="date" name="enrollment_date" required><br><br>

    <button type="submit">Add Student</button>
</form>

<?php include("includes/footer.php"); ?>

// updated for commit history
