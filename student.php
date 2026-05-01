<?php include("includes/header.php"); ?>
<?php include("includes/db.php"); ?>

<?php
$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
?>

<h2>Student Profile</h2>

<div class="profile-box">
    <p><strong>ID:</strong> <?= $student['id'] ?></p>
    <p><strong>Name:</strong> <?= $student['first_name'] . " " . $student['last_name'] ?></p>
    <p><strong>Grade Level:</strong> <?= $student['grade_level'] ?></p>
    <p><strong>Enrollment Date:</strong> <?= $student['enrollment_date'] ?></p>

    <a href="edit_student.php?id=<?= $student['id'] ?>" class="btn-edit">Edit Student</a>
    <a href="delete_student.php?id=<?= $student['id'] ?>" class="btn-delete"
       onclick="return confirm('Are you sure you want to delete this student?');">
       Delete Student
    </a>
</div>

<?php include("includes/footer.php"); ?>

// Updated to add comit message