<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get billing details based on patient name and ward
function getBillingDetails($name, $ward) {
    global $conn;
    $stmt = $conn->prepare("SELECT billing_amount, billing_details FROM billing WHERE name = ? AND ward = ?");
    $stmt->bind_param("ss", $name, $ward);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Get name and ward from the request (e.g., from a form submission)
$name = isset($_GET['name']) ? $_GET['name'] : '';
$ward = isset($_GET['ward']) ? $_GET['ward'] : '';

// Fetch billing details
$billing_details = getBillingDetails($name, $ward);

// Fetch list of wards from the database for the dropdown
function getWardList() {
    global $conn;
    $result = $conn->query("SELECT DISTINCT ward FROM billing");
    $wards = [];
    while ($row = $result->fetch_assoc()) {
        $wards[] = $row['ward'];
    }
    return $wards;
}

$ward_list = getWardList();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Billing Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
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

        input[type="text"], select {
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
        <h1>Patient Billing Details</h1>

        <form method="get" action="">
            <label for="name">Patient Name:</label>
            <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($name); ?>">

            <label for="ward">Ward:</label>
            <select id="ward" name="ward" required>
                <option value="">Select Ward</option>
                <?php foreach ($ward_list as $ward_name): ?>
                    <option value="<?php echo htmlspecialchars($ward_name); ?>" <?php echo $ward == $ward_name ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($ward_name); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Get Billing Details</button>
        </form>

        <?php if ($billing_details): ?>
            <div class="result">
                <h2>Billing Details for <?php echo htmlspecialchars($name); ?> in <?php echo htmlspecialchars($ward); ?> Ward</h2>
                <p><strong>Billing Amount:</strong> $<?php echo htmlspecialchars($billing_details['billing_amount']); ?></p>
                <p><strong>Billing Details:</strong> <?php echo htmlspecialchars($billing_details['billing_details']); ?></p>
            </div>
        <?php elseif ($name && $ward): ?>
            <div class="result">
                <p>No billing details found for "<?php echo htmlspecialchars($name); ?>" in "<?php echo htmlspecialchars($ward); ?>" ward.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
