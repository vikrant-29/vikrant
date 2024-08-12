<?php
// Database connection parameters
$host = 'localhost'; // Change as needed
$port = '5432';      // Default port for PostgreSQL
$dbname = 'mydata'; // Replace with your database name
$user = 'postgres'; // Replace with your database username
$password = '1234'; // Replace with your database password

// Create connection
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Sanitize input
$username = pg_escape_string($username);
$password = pg_escape_string($password);

// Prepare SQL query to insert data into the database
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

// Execute query
$result = pg_query($conn, $sql);

// Check if the query was successful
if ($result) {
    echo "Login data saved successfully!";
} else {
    echo "Error saving data: " . pg_last_error();
}

// Close the connection
pg_close($conn);
?>
