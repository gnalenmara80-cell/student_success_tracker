<?php
require_once "includes/db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Database Test Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #333;
            color: white;
        }
        .ok {
            color: green;
            font-weight: bold;
        }
        .fail {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>Student Success Tracker – Database Test</h1>

<table>
    <tr>
        <th>Table Name</th>
        <th>Status</th>
        <th>Row Count</th>
    </tr>

<?php
$tables = ["students", "attendance", "grades", "behavior", "interventions"];

foreach ($tables as $table) {
    echo "<tr>";
    echo "<td>$table</td>";

    // Check if table exists
    $check = $conn->query("SHOW TABLES LIKE '$table'");
    if ($check->num_rows > 0) {
        echo "<td class='ok'>OK</td>";

        // Count rows
        $count = $conn->query("SELECT COUNT(*) AS total FROM $table");
        $row = $count->fetch_assoc();
        echo "<td>" . $row['total'] . "</td>";
    } else {
        echo "<td class='fail'>Missing</td>";
        echo "<td>0</td>";
    }

    echo "</tr>";
}
?>

</table>

</body>
</html>
