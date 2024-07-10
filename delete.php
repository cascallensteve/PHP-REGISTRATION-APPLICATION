<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID is set
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Prepare the SQL delete statement
    $sql = "DELETE FROM clients WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $successMessage = "Client deleted successfully";
    } else {
        $errorMessage = "Error deleting client: " . $conn->error;
    }

    $stmt->close();
} else {
    $errorMessage = "ID parameter is missing";
}

// Close the connection
$conn->close();

// Redirect back to the main page with a success or error message
header("Location: /my shop/index.php?successMessage=" . urlencode($successMessage) . "&errorMessage=" . urlencode($errorMessage));
exit;
?>
