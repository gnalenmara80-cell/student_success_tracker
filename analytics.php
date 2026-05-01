<?php include("includes/header.php"); ?>
<?php include("includes/db.php"); ?>

<div class="container mt-4">
    <h2>Analytics Dashboard</h2>

    <!-- Summary Cards -->
    <div class="row mt-4" id="summary-cards">
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <h5>GPA</h5>
                <p id="gpa">Loading...</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <h5>Average Score</h5>
                <p id="avgScore">Loading...</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <h5>Attendance Rate</h5>
                <p id="attendanceRate">Loading...</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <h5>Skill Trend</h5>
                <p id="skillTrend">Loading...</p>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 -->
    <div class="row mt-5">
        <div class="col-md-6">
            <h5>Scores Over Time</h5>
            <canvas id="gradesLineChart"></canvas>
        </div>
        <div class="col-md-6">
            <h5>Scores by Subject</h5>
            <canvas id="subjectBarChart"></canvas>
        </div>
    </div>

    <!-- Charts Row 2 -->
    <div class="row mt-5">
        <div class="col-md-6">
            <h5>Attendance Overview</h5>
            <canvas id="attendanceChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
$present = $conn->query("SELECT COUNT(*) AS total FROM attendance WHERE status='Present'")->fetch_assoc()['total'];
$absent = $conn->query("SELECT COUNT(*) AS total FROM attendance WHERE status='Absent'")->fetch_assoc()['total'];
?>

<script>

// Load Summary Metrics

fetch("api/get_performance_summary.php?student_id=1")
    .then(res => res.json())
    .then(data => {
        document.getElementById("gpa").innerText = data.gpa;
        document.getElementById("avgScore").innerText = data.average_score;
        document.getElementById("attendanceRate").innerText = data.attendance_rate + "%";
        document.getElementById("skillTrend").innerText = data.skill_trend;
    });


// Load Grades for Charts

fetch("api/get_grades.php?student_id=1")
    .then(res => res.json())
    .then(data => {
        const dates = data.map(item => item.date_recorded);
        const scores = data.map(item => item.score);
        const subjects = data.map(item => item.subject);

        new Chart(document.getElementById("gradesLineChart"), {
            type: "line",
            data: {
                labels: dates,
                datasets: [{
                    label: "Scores Over Time",
                    data: scores,
                    borderColor: "blue",
                    fill: false
                }]
            }
        });

        new Chart(document.getElementById("subjectBarChart"), {
            type: "bar",
            data: {
                labels: subjects,
                datasets: [{
                    label: "Scores by Subject",
                    data: scores,
                    backgroundColor: "orange"
                }]
            }
        });
    });

// Attendance Pie Chart

new Chart(document.getElementById('attendanceChart'), {
    type: 'pie',
    data: {
        labels: ['Present', 'Absent'],
        datasets: [{
            data: [<?php echo $present; ?>, <?php echo $absent; ?>],
            backgroundColor: ['#4CAF50', '#F44336']
        }]
    }
});
</script>

<?php $conn->close(); ?>
<?php include("includes/footer.php"); ?>

// updated for commit history