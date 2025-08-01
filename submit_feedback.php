<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capture form data
    $patientName = htmlspecialchars(trim($_POST['patientName']));
    $rating = htmlspecialchars(trim($_POST['rating']));
    $feedback = htmlspecialchars(trim($_POST['feedback']));

    // Validate required fields
    if (empty($patientName) || empty($rating) || empty($feedback)) {
        echo "<script>alert('All fields are required!'); window.history.back();</script>";
        exit;
    }

    // Database connection details
    $servername = "localhost";
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "hospital_db"; // Replace with your database name

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO feedback (patientname, rating, feedback) VALUES (?, ?, ?)");

    $stmt->bind_param("sss", $patientName, $rating, $feedback);

    // Execute the statement
    if ($stmt->execute()) {
        // Display a thank-you message and redirect to the form
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Thank You</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    background: linear-gradient(135deg, #74ebd5, #ACB6E5);
                    color: #333;
                }
                .thank-you-container {
                    text-align: center;
                    background: #fff;
                    padding: 20px;
                    border-radius: 12px;
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
                }
                .thank-you-container h1 {
                    color: #4CAF50;
                }
                .thank-you-container p {
                    font-size: 1.2em;
                }
                .thank-you-container a {
                    display: inline-block;
                    margin-top: 15px;
                    padding: 10px 15px;
                    background: #4CAF50;
                    color: white;
                    text-decoration: none;
                    border-radius: 8px;
                    transition: background 0.3s ease;
                }
                .thank-you-container a:hover {
                    background: #45a049;
                }
            </style>
        </head>
        <body>
            <div class='thank-you-container'>
                <h1>Thank You!</h1>
                <p>Your feedback has been submitted successfully.</p>
                <a href='patient_feedback.html'>Submit Another Feedback</a>
            </div>
        </body>
        </html>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method!";
}
?>
