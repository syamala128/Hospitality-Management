<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical_db"; // Ensure the correct database is selected

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the database
$conn->select_db($dbname);

// Sanitize and validate input data
$patientName = isset($_POST['patientName']) ? trim($_POST['patientName']) : '';
$mobileNo = isset($_POST['mobileNo']) ? trim($_POST['mobileNo']) : '';
$doctor = isset($_POST['doctor']) ? trim($_POST['doctor']) : '';
$appointmentDate = isset($_POST['appointmentDate']) ? trim($_POST['appointmentDate']) : '';
$appointmentTime = isset($_POST['appointmentTime']) && !empty($_POST['appointmentTime']) ? trim($_POST['appointmentTime']) : 'Not set';

// Validate required fields
if (empty($patientName) || empty($mobileNo) || empty($doctor) || empty($appointmentDate)) {
    echo "<div style='text-align:center; color:red; font-size:18px;'>Error: All required fields must be filled out.</div>";
    exit();
}

// SQL query to insert data into the appointments table
$sql = "INSERT INTO appointments (patient_name, mobile_no, doctor, appointment_date, appointment_time) 
        VALUES (?, ?, ?, ?, ?)";

// Prepare statement to prevent SQL injection
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "<div style='text-align:center; color:red; font-size:18px;'>Error preparing statement: " . $conn->error . "</div>";
    exit();
}

// Bind parameters and execute
$stmt->bind_param("sssss", $patientName, $mobileNo, $doctor, $appointmentDate, $appointmentTime);

if ($stmt->execute()) {
    // Display confirmation message with submitted data
    echo "<!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <title>Appointment Confirmation</title>
              <style>
                  body {
                      font-family: Arial, sans-serif;
                      background-color: #f4f4f4;
                      margin: 0;
                      display: flex;
                      justify-content: center;
                      align-items: center;
                      height: 100vh;
                  }
                  .confirmation-container {
                      background-color: #fff;
                      padding: 20px;
                      border-radius: 8px;
                      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                      text-align: center;
                      max-width: 400px;
                      width: 100%;
                  }
                  .confirmation-container h2 {
                      color: #4CAF50;
                      margin-bottom: 20px;
                  }
                  .confirmation-container p {
                      font-size: 16px;
                      color: #333;
                      margin: 8px 0;
                  }
              </style>
          </head>
          <body>
              <div class='confirmation-container'>
                  <h2>Appointment Successfully Booked!</h2>
                  <p><strong>Name:</strong> " . htmlspecialchars($patientName) . "</p>
                  <p><strong>Mobile No:</strong> " . htmlspecialchars($mobileNo) . "</p>
                  <p><strong>Doctor:</strong> " . htmlspecialchars($doctor) . "</p>
                  <p><strong>Date:</strong> " . htmlspecialchars($appointmentDate) . "</p>
                  <p><strong>Time:</strong> " . htmlspecialchars($appointmentTime) . "</p>
              </div>
          </body>
          </html>";
} else {
    echo "<div style='text-align:center; color:red; font-size:18px;'>Error: " . $stmt->error . "</div>";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
