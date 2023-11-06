<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection code here (e.g., using mysqli or PDO)
$host = "localhost"; // Your database host
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "restaurant"; // Your database name
$port = 3307;

// Create a mysqli connection
$your_db_connection = new mysqli($host, $username, $password, $database, $port);

// Check for connection errors
if ($your_db_connection->connect_error) {
    die("Connection failed: " . $your_db_connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"]; 
    $contact = $_POST["contact"];

    // Insert user data into the database
    $sql = "INSERT INTO logsign (username, email, password, address, contact) VALUES (?, ?, ?, ?, ?)";
    
    // Execute the SQL statement (make sure to establish a database connection first)
    // You should use prepared statements to prevent SQL injection
    // Replace 'your_db_connection' with your database connection code
    $stmt = $your_db_connection->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("sssss", $username, $email, $password, $address, $contact);
        if ($stmt->execute()) {
            // Registration successful, display an alert and redirect
            echo '<script type="text/javascript">alert("Registration successful!");</script>';
            echo '<script type="text/javascript">window.location = "login.html";</script>';
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error in preparing the SQL statement: " . $your_db_connection->error;
    }

    // Close your database connection here
    $your_db_connection->close();
}
?>
