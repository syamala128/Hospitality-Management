<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor and Ward Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        .doctor-list {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        .doctor {
            background-color: #e9f7fd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .doctor h3 {
            color: #007bff;
            margin-bottom: 10px;
        }

        .doctor p {
            margin: 5px 0;
            font-weight: bold;
            color: #2c3e50;
        }

        @media (max-width: 768px) {
            .doctor-list {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 480px) {
            .doctor-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Doctor and Ward Information</h1>
    <div class="doctor-list">
        <?php
        // Associative array of doctors and their ward numbers
        $doctors = [
            "Dr. Abhi (Dermatology)" => "Ward No: 15",
            "Dr. Ashok Rajgopla (Dermatology)" => "Ward No: 15",
            "Dr. Rajesh (Cardiology)" => "Ward No: 12",
            "Dr. Suresh Joshi (Cardiology)" => "Ward No: 12",
            "Dr. Aparna Devi (Gynecology)" => "Ward No: 8",
            "Dr. Ramya (Gynecology)" => "Ward No: 8",
            "Dr. Pallavi (Pediatrics)" => "Ward No: 4",
            "Dr. Subhash Gupta (Pediatrics)" => "Ward No: 4",
            "Dr. Leela (Neurology)" => "Ward No: 2",
            "Dr. Abhijit (Neurology)" => "Ward No: 2"
        ];

        // Loop through the array and display doctor information
        foreach ($doctors as $doctor => $ward) {
            echo "<div class='doctor'>";
            echo "<h3>$doctor</h3>";
            echo "<p>$ward</p>";
            echo "</div>";
        }
        ?>
    </div>
</div>

</body>
</html>
