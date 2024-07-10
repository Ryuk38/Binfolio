<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "binfolio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement with placeholders
$sql = "INSERT INTO contact (f_nm, l_nm, email, messages) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters and execute statement
$first_name = $_POST['f_name'];
$last_name = $_POST['l_name'];
$email = $_POST['em'];
$message = $_POST['msg'];

$stmt->bind_param("ssss", $first_name, $last_name, $email, $message);

if ($stmt->execute()) {
    // Redirect to contact.php with anchor #contact
    header("Location: contact.php#contact");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
