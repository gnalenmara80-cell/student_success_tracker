<?php include("includes/header.php"); ?>
<?php include("includes/db.php"); ?>

<?php
$result = $conn->query("
    SELECT a.date, a.status, s.first_name, s.last_name
    FROM attendance a
    JOIN students s ON a.student_id = s.id
");
?>

<h2>Attendance Records</h2>

<table>
    <tr>
        <th>Student</th>
        <th>Date</th>
        <th>Status</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['status'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>

</div>
</body>
</html>
