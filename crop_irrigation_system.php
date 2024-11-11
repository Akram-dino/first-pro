<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "testdb";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle API requests based on `action` parameter
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Fetch moisture data for testing
if ($action === 'get_moisture_data') {
    $data = [
        ["date" => "2024-10-01", "time" => "08:30 AM", "moisture_level" => "55%", "status" => "Normal"],
        ["date" => "2024-10-01", "time" => "12:45 PM", "moisture_level" => "43%", "status" => "Low"],
        ["date" => "2024-10-01", "time" => "03:15 PM", "moisture_level" => "61%", "status" => "Normal"],
        ["date" => "2024-10-01", "time" => "07:00 PM", "moisture_level" => "48%", "status" => "Low"]
    ];
    echo json_encode($data);
}

// Update thresholds for testing
elseif ($action === 'update_thresholds' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $minThreshold = isset($_POST['min_threshold']) ? $_POST['min_threshold'] : 40;
    $maxThreshold = isset($_POST['max_threshold']) ? $_POST['max_threshold'] : 70;

    // For the assignment, just return a success message without actual DB update
    $response = [
        "success" => true,
        "message" => "Thresholds updated successfully for min: $minThreshold% and max: $maxThreshold%."
    ];
    echo json_encode($response);
} else {
    echo json_encode(["error" => "Invalid action"]);
}

// Close the connection
$conn->close();
?>
