<!DOCTYPE html>
<html>
<head>
    <title>API Test Page</title>
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
        .container {
            width: 70%;
            margin: auto;
        }
        button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background: #333;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 6px;
        }
        button:hover {
            background: #555;
        }
        pre {
            background: white;
            padding: 15px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        label {
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
    </style>

    <script>
        function callAPI(endpoint) {
            const studentId = document.getElementById("student_id").value;

            if (!studentId) {
                alert("Please enter a student ID first.");
                return;
            }

            fetch(`api/${endpoint}?student_id=${studentId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("output").textContent =
                        JSON.stringify(data, null, 4);
                })
                .catch(error => {
                    document.getElementById("output").textContent =
                        "Error: " + error;
                });
        }
    </script>
</head>

<body>

<h1>Student Success Tracker – API Test Page</h1>

<div class="container">

    <label>Enter Student ID:</label>
    <input type="number" id="student_id" placeholder="Example: 1">

    <button onclick="callAPI('get_attendance.php')">Test Attendance API</button>
    <button onclick="callAPI('get_grades.php')">Test Grades API</button>
    <button onclick="callAPI('get_behavior.php')">Test Behavior API</button>
    <button onclick="callAPI('get_interventions.php')">Test Interventions API</button>
    <button onclick="callAPI('get_gpa.php')">Test GPA API</button>
    <button onclick="callAPI('get_performance_summary.php')">Test Performance Summary API</button>

    <h2>API Response:</h2>
    <pre id="output">Click a button to test an API...</pre>

</div>

</body>
</html>
