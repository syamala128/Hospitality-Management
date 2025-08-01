<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .patient-list {
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 800px;
        }

        .patient {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .patient:last-child {
            border-bottom: none;
        }

        .patient h3 {
            margin: 0;
            color: #007bff;
        }

        .patient p {
            margin: 5px 0;
            color: #555;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="patient-list">
        <h2>List of Patients</h2>
        <?php
        // Patient data
        $patients = [
            ['name' => 'Mahesh', 'disease' => 'Eczema', 'contactNo' => '9234567890', 'gender' => 'Male', 'symptoms' => 'Itching and skin rashes'],
            ['name' => 'Nithin', 'disease' => 'Hypertension', 'contactNo' => '9876543210', 'gender' => 'Male', 'symptoms' => 'Severe headache, chest pain'],
            ['name' => 'Venkat', 'disease' => 'Acne', 'contactNo' => '9876553210', 'gender' => 'Male', 'symptoms' => 'Small red bumps'],
            ['name' => 'Pooja', 'disease' => 'Heart failure', 'contactNo' => '9816543214', 'gender' => 'Female', 'symptoms' => 'Swollen legs and rapid heartbeat'],
            ['name' => 'Laya', 'disease' => 'IBS', 'contactNo' => '9875543210', 'gender' => 'Female', 'symptoms' => 'Diarrhea and constipation'],
            ['name' => 'Divya', 'disease' => 'Strep Throat', 'contactNo' => '9836543210', 'gender' => 'Female', 'symptoms' => 'Throat pain and rashes'],
            ['name' => 'Nitya', 'disease' => 'Asthma', 'contactNo' => '9846543210', 'gender' => 'Female', 'symptoms' => 'Chest pain and cough'],
            ['name' => 'Karthik', 'disease' => 'Hyperlipidemia', 'contactNo' => '9875654210', 'gender' => 'Male', 'symptoms' => 'Leg cramps and chest pain'],
            ['name' => 'Anoop', 'disease' => 'Rosacea', 'contactNo' => '987693210', 'gender' => 'Male', 'symptoms' => 'Facial redness, puffy eyes'],
            ['name' => 'Sweetha', 'disease' => 'Bronchiolitis', 'contactNo' => '9886543210', 'gender' => 'Female', 'symptoms' => 'Wheezing and loss of appetite'],
        ];

        // Display patients
        foreach ($patients as $patient) {
            echo '<div class="patient">';
            echo '<h3>' . $patient['name'] . '</h3>';
            echo '<p><strong>Disease:</strong> ' . $patient['disease'] . '</p>';
            echo '<p><strong>Contact No:</strong> ' . $patient['contactNo'] . '</p>';
            echo '<p><strong>Gender:</strong> ' . $patient['gender'] . '</p>';
            echo '<p><strong>Symptoms:</strong> ' . $patient['symptoms'] . '</p>';
            echo '</div>';
        }
        ?>
        <a href="front.html" class="back-button">Back to Home</a>
    </div>
</body>
</html>
