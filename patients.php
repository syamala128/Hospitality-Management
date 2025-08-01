<?php
// Database connection
$servername = "localhost"; // Your DB server
$username = "root";        // Your DB username
$password = "";            // Your DB password
$dbname = "hospital_db";    // Your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$found = false;
$patient = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $enteredName = trim($_POST['patientName']);

    // Query the database for the entered patient name
    $sql = "SELECT * FROM fetch_patients WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $enteredName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
        $found = true;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('bg2.jpg'); /* Add your background image */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container Style */
        .container {
            max-width: 600px;
            width: 90%;
            background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent background */
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 30px;
            color: #2c3e50;
            font-weight: 600;
        }

        /* Form Styling */
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Patient Details */
        .patient-details {
            background-color: #ecf0f1;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .patient-details h3 {
            color: #3498db;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .patient-details p {
            font-size: 14px;
            color: #7f8c8d;
            margin: 5px 0;
        }

        /* No Result Message */
        .no-result {
            background-color: #f2dede;
            border: 1px solid #e0b0b0;
            padding: 15px;
            border-radius: 8px;
            color: #e74c3c;
            font-size: 16px;
            margin-top: 20px;
        }

        /* Back Button */
        .back-button {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #2980b9;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Patient Details</h2>
        <?php if (!$found): ?>
            <!-- Display the search form if no patient is found -->
            <form method="POST">
                <input type="text" name="patientName" placeholder="Enter Patient Name" required>
                <button type="submit">Search</button>
            </form>
        <?php else: ?>
            <!-- Display the patient details after search -->
            <div class="patient-details">
                <h3><?php echo htmlspecialchars($patient['name']); ?></h3>
                <p><strong>Disease:</strong> <?php echo htmlspecialchars($patient['disease']); ?></p>
                <p><strong>Gender:</strong> <?php echo htmlspecialchars($patient['gender']); ?></p>
                <p><strong>Symptoms:</strong> <?php echo htmlspecialchars($patient['symptoms']); ?></p>
            </div>
        <?php endif; ?>
        <a href="hospital_dashboard.html" class="back-button">Back to Search</a>
    </div>
</body>
</html>
