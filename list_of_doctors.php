<!DOCTYPE html>
<html>
<head>
    <title>Doctors Dropdown</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }
        h1 {
            color: #4CAF50;
            margin-bottom: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .doctor-details {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .doctor-details h3 {
            margin: 0 0 10px;
            font-size: 20px;
            color: #4CAF50;
        }
        .doctor-details p {
            margin: 5px 0;
            color: #555;
        }
        .no-results {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            width: 90%;
            max-width: 600px;
            text-align: center;
            color: #999;
            margin: 10px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <h1>Search Specialist</h1>
    <form action="" method="POST">
        <label for="specialization">Choose a specialization:</label>
        <select name="specialization" id="specialization" required>
            <option value="">Select Specialization</option>
            <?php
            // Array of specializations
            $specializations = [
                "Cardiology",
                "Neurology",
                "Gynecologist",
                "Pediatrics",
                "Dermatology"
            ];

            // Loop through the array to populate the dropdown
            foreach ($specializations as $specialization) {
                echo '<option value="' . $specialization . '">' . $specialization . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Find Doctors">
    </form>

    <?php
    // Array of doctors with their specializations, appointments, and timings
    $doctors = [
        ["name" => "Dr. Suresh Joshi", "specialization" => "Cardiology", "appointments" => 10, "timings" => "9:00 AM - 1:00 PM"],
        ["name" => "Dr. Rajesh", "specialization" => "Cardiology", "appointments" => 8, "timings" => "3:00 PM - 5:00 PM"],
        ["name" => "Dr. Abhijit", "specialization" => "Neurology", "appointments" => 8, "timings" => "10:00 AM - 12:00 PM"],
        ["name" => "Dr. Leela", "specialization" => "Neurology", "appointments" => 8, "timings" => "12:00 AM - 2:00 PM"],
        ["name" => "Dr. Ramya", "specialization" => "Gynecologist", "appointments" => 12, "timings" => "11:00 AM - 1:00 PM"],
        ["name" => "Dr. Aparna Devi", "specialization" => "Gynecologist", "appointments" => 10, "timings" => "04:00 PM - 6:00 PM"],
        ["name" => "Dr. Subhash Gupta", "specialization" => "Pediatrics", "appointments" => 7, "timings" => "3:00 PM - 5:00 PM"],
        ["name" => "Dr. Pallavi", "specialization" => "Pediatrics", "appointments" => 12, "timings" => "9:00 PM - 11:00 PM"],
        ["name" => "Dr.Ashok Rajgopal", "specialization" => "Dermatology", "appointments" => 5, "timings" => "2:00 PM - 4:00 PM"],
        ["name" => "Dr. Abhiram", "specialization" => "Dermatology", "appointments" => 7, "timings" => "7:00 PM - 9:00 PM"]
    ];

    // Display doctors based on the selected specialization
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedSpecialization = $_POST['specialization'];
        if ($selectedSpecialization) {
            echo "<h2>Doctors in $selectedSpecialization:</h2>";
            $found = false;
            foreach ($doctors as $doctor) {
                if ($doctor['specialization'] == $selectedSpecialization) {
                    $found = true;
                    echo '<div class="doctor-details">';
                    echo '<h3>' . $doctor['name'] . '</h3>';
                    echo '<p><strong>Appointments:</strong> ' . $doctor['appointments'] . '</p>';
                    echo '<p><strong>Timings:</strong> ' . $doctor['timings'] . '</p>';
                    echo '</div>';
                }
            }
            if (!$found) {
                echo '<div class="no-results">No doctors available for this specialization.</div>';
            }
        } else {
            echo '<div class="no-results">Please select a specialization.</div>';
        }
    }
    ?>
</body>
</html>
