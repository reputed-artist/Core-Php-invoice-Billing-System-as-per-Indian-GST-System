<?php
// check_invoice.php
header('Content-Type: application/json');

// Database connection details
$host = 'localhost';
$db = 'loginsystem';
$user = 'root';
$pass = '';

// Get the invoice ID from POST request
$invid = isset($_REQUEST['invid']) ? $_REQUEST['invid'] : '';

// Create a connection to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Prepare and execute the SQL statement
$stmt = $conn->prepare("SELECT name, address, mob FROM delivery_addresses WHERE invid = ?");
if (!$stmt) {
    die(json_encode(['error' => 'Prepare failed: ' . $conn->error]));
}

$stmt->bind_param("s", $invid);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

// Check if invoice exists and return JSON response
if ($result) {
    echo json_encode(['exists' => true, 'data' => $result]);
} else {
    echo json_encode(['exists' => false]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
