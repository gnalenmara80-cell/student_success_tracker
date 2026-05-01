<?php include("includes/header.php"); ?>
<?php include("includes/db.php"); ?>

<?php
$result = $conn->query("
    SELECT g.subject, g.grade, g.date_recorded, s.first_name, s.last_name
    FROM grades g
    JOIN students s ON g.student_id = s.id
");
?>

<h2>Grade Records</h2>

<table>
    <tr>
        <th>Student</th>
        <th>Subject</th>
        <th>Grade</th>
        <th>Date Recorded</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
            <td><?= $row['subject'] ?></td>
            <td><?= $row['grade'] ?></td>
            <td><?= $row['date_recorded'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include("includes/footer.php"); ?>

// updated for commit history