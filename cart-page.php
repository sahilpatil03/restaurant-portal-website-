<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection code here using mysqli
$host = "localhost"; // Your database host
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "restaurant"; // Your database name
$port = 3307;

// Create a mysqli connection
$your_db_connection = new mysqli($host, $username, $password, $database, $port);

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect or handle the case where the user is not logged in
    header("Location: login.html");
    exit();
} 

// Fetch appointments associated with the logged-in user
$loggedInUser = $_SESSION['user']; // Assuming the username is stored in the session

// Fetch appointments from the database
$sql = "SELECT * FROM logsign WHERE userName = '$loggedInUser'"; // Adjust the SQL query as per your database structure
$result = $your_db_connection->query($sql);

// Check for connection errors
if ($your_db_connection->connect_error) {
    die("Connection failed: " . $your_db_connection->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect or handle the case where the user is not logged in
    header("Location: login.html");
    exit();
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];

    // Query to retrieve user data by username
    $sql = "SELECT * FROM menu WHERE name = ?";

    // Execute the SQL statement (make sure to establish a database connection first)
    // You should use prepared statements to prevent SQL injection
    // Replace 'your_db_connection' with your database connection code
    $stmt = $your_db_connection->prepare($sql);
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (isset($user["password"])) {
            $storedPassword = $user["password"];
            $providedPassword = $password;

            if ($storedPassword !== null && $providedPassword !== null && strcasecmp(trim($providedPassword), trim($storedPassword)) == 0) {
                // Password is correct; user is authenticated
                session_start();
                $_SESSION["user_id"] = $user["id"];
                header("Location: cart-page.html?fromLogin=true"); // Redirect to a dashboard or home page
                exit();
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "Password is not set for the user.";
        }
    } else {
        echo "Username not found";
    }

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    // Close your database connection here
}
?>
