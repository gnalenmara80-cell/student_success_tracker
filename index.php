<?php include("includes/header.php"); ?>
<?php include("includes/db.php"); ?>

<?php
// Fetch all students
$sql = "SELECT id, first_name, last_name, grade_level, enrollment_date
        FROM students
        ORDER BY id ASC";

$result = $conn->query($sql);
?>

<h2>Student List (Live Database Data)</h2>

<!--  SEARCH BAR -->
<input type="text" id="searchInput" placeholder="Search students..." style="margin-bottom: 15px; padding: 8px; width: 250px;">

<table id="studentTable">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Grade Level</th>
        <th>Enrollment Date</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>

            <!--  CLICKABLE STUDENT PROFILE -->
            <td>
                <a href="student.php?id=<?= $row['id'] ?>">
                    <?= $row['first_name'] . " " . $row['last_name'] ?>
                </a>
            </td>

            <td><?= $row['grade_level'] ?></td>
            <td><?= $row['enrollment_date'] ?></td>

            <!-- EDIT / DELETE BUTTONS -->
            <td>
                <a href="edit_student.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                <a href="delete_student.php?id=<?= $row['id'] ?>" class="btn-delete"
                   onclick="return confirm('Are you sure you want to delete this student?');">
                   Delete
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<!-- SEARCH FILTER SCRIPT -->
<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#studentTable tr:not(:first-child)");

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});
</script>

<?php include("includes/footer.php"); ?>
