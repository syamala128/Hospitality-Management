<?php
// Define the insurance amounts based on cause of death
$insuranceAmounts = [
    "Accident" => 50000,
    "Natural Causes" => 100000,
    "Heart Attack" => 75000,
    "Cancer" => 120000,
    "Stroke" => 90000
];

$insuranceAmount = "";
$name = $causeOfDeath = $dob = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs
    $name = $_POST['name'];
    $causeOfDeath = $_POST['causeOfDeath'];
    $dob = $_POST['dob'];

    // Check if the cause of death exists in the array
    if (array_key_exists($causeOfDeath, $insuranceAmounts)) {
        $insuranceAmount = $insuranceAmounts[$causeOfDeath];
    } else {
        $insuranceAmount = "Cause of death not found, no insurance amount available.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Claim Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f9f9f9;
        }
        .container {
            width: 50%;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            text-align: center;
        }
        .result p {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Insurance Claim Form</h2>

    <!-- Form to submit details -->
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($name); ?>">

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required value="<?php echo htmlspecialchars($dob); ?>">

        <label for="causeOfDeath">Cause of Death:</label>
        <select id="causeOfDeath" name="causeOfDeath" required>
            <option value="">Select Cause of Death</option>
            <option value="Accident" <?php echo ($causeOfDeath == "Accident") ? 'selected' : ''; ?>>Accident</option>
            <option value="Natural Causes" <?php echo ($causeOfDeath == "Natural Causes") ? 'selected' : ''; ?>>Natural Causes</option>
            <option value="Heart Attack" <?php echo ($causeOfDeath == "Heart Attack") ? 'selected' : ''; ?>>Heart Attack</option>
            <option value="Cancer" <?php echo ($causeOfDeath == "Cancer") ? 'selected' : ''; ?>>Cancer</option>
            <option value="Stroke" <?php echo ($causeOfDeath == "Stroke") ? 'selected' : ''; ?>>Stroke</option>
        </select>

        <button type="submit">Submit</button>
    </form>

    <!-- Display result -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <div class="result">
            <h3>Insurance Details</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($dob); ?></p>
            <p><strong>Cause of Death:</strong> <?php echo htmlspecialchars($causeOfDeath); ?></p>
            <p><strong>Insurance Amount:</strong> $<?php echo number_format($insuranceAmount); ?></p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
