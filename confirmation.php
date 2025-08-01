<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and validate input data
$patientName = isset($_POST['patientName']) ? trim($_POST['patientName']) : '';
$mobileNo = isset($_POST['mobileNo']) ? trim($_POST['mobileNo']) : '';
$doctor = isset($_POST['doctor']) ? trim($_POST['doctor']) : '';
$appointmentDate = isset($_POST['appointmentDate']) ? trim($_POST['appointmentDate']) : '';
$appointmentTime = isset($_POST['appointmentTime']) && !empty($_POST['appointmentTime']) ? trim($_POST['appointmentTime']) : 'Not set';

// Validate required fields
if (empty($patientName) || empty($mobileNo) || empty($doctor) || empty($appointmentDate)) {
    die("Error: All required fields must be filled out.");
}

// SQL query to insert data into the appointments table
$sql = "INSERT INTO appointments (patient_name, mobile_no, doctor, appointment_date, appointment_time) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters and execute
$stmt->bind_param("sssss", $patientName, $mobileNo, $doctor, $appointmentDate, $appointmentTime);

if ($stmt->execute()) {
    // Redirect to a confirmation page with data
    header("Content-Type: text/html");
    include "confirmation.php";
} else {
    die("Error: " . $stmt->error);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
