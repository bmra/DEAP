<?php
// Database connection details
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "medisep";

session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  // Get the submitted username and password
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Create a database connection
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  // Check the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute the SQL statement
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($sql);

  // Check if the login is successful
    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $type = $row['type'];
      $user_id = $row['id']; // Obtem o ID do usuário
    
    // Store user information in session variables
    $_SESSION['loggedin'] = true;
    $_SESSION['user_id'] = $user_id;

    // Redirect based on the user type
    if ($type == '1') {
      header("Location: Admin/adminHome.html");
    } elseif ($type == '2') {
      header("Location: Medico/medicoHome.html");
    } elseif ($type == '3') {
      header("Location: Paciente/pacienteHome.html");
    } else {
      echo "Invalid user type.";
    }
  } else {
    echo "Invalid username or password.";
  }

  // Close the database connection
  $conn->close();
}
?>
