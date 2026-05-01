<?php include("includes/header.php"); ?>
<?php include("includes/db.php"); ?>

<?php
$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
?>

<h2>Edit Student</h2>

<form action="update_student.php" method="POST">
    <input type="hidden" name="id" value="<?= $student['id'] ?>">

    <label>First Name:</label><br>
    <input type="text" name="first_name" value="<?= $student['first_name'] ?>" required><br><br>

    <label>Last Name:</label><br>
    <input type="text" name="last_name" value="<?= $student['last_name'] ?>" required><br><br>

    <label>Grade Level:</label><br>
    <input type="number" name="grade_level" value="<?= $student['grade_level'] ?>" required><br><br>

    <label>Enrollment Date:</label><br>
    <input type="date" name="enrollment_date" value="<?= $student['enrollment_date'] ?>" required><br><br>

    <button type="submit" class="btn-edit">Save Changes</button>
</form>

<?php include("includes/footer.php"); ?>
// updated for commit