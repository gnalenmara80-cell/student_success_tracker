<?php
require_once "db.php"; // database connection

// GPA calculation
function calculateGPA($studentId) {
    global $conn;

    $sql = "SELECT grade FROM grades WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return 0;
    }

    $totalPoints = 0;
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $grade = $row['grade'];

        if ($grade >= 90) $points = 4.0;
        else if ($grade >= 80) $points = 3.0;
        else if ($grade >= 70) $points = 2.0;
        else if ($grade >= 60) $points = 1.0;
        else $points = 0.0;

        $totalPoints += $points;
        $count++;
    }

    return round($totalPoints / $count, 2);
}

// Average score calculation
function calculateAverageScore($studentId) {
    global $conn;

    $sql = "SELECT AVG(grade) AS avg_grade FROM grades WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    return round($result['avg_grade'], 2);
}

// Attendance rate calculation
function calculateAttendanceRate($studentId) {
    global $conn;

    $sql = "SELECT 
                SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) AS present_days,
                COUNT(*) AS total_days
            FROM attendance
            WHERE student_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result['total_days'] == 0) return 0;

    return round(($result['present_days'] / $result['total_days']) * 100, 2);
}

// Skill trend calculation (Improving / Declining / Stable)
function calculateSkillTrend($studentId) {
    global $conn;

    $sql = "SELECT grade FROM grades WHERE student_id = ? ORDER BY date_recorded ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    $grades = [];
    while ($row = $result->fetch_assoc()) {
        $grades[] = $row['grade'];
    }

    if (count($grades) < 2) return "Not enough data";

    $first = $grades[0];
    $last = end($grades);

    if ($last > $first) return "Improving";
    if ($last < $first) return "Declining";
    return "Stable";
}

// Summary of all performance metrics
function getPerformanceSummary($studentId) {
    return [
        "gpa" => calculateGPA($studentId),
        "average_score" => calculateAverageScore($studentId),
        "attendance_rate" => calculateAttendanceRate($studentId),
        "skill_trend" => calculateSkillTrend($studentId)
    ];
}
?>
