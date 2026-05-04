<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM USER WHERE USERNAME = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['HASHEDPASSWORD'])) {
            $_SESSION['id'] = $user['ID'];
            $_SESSION['username'] = $user['USERNAME'];
            $_SESSION['fullname'] = $user['FULLNAME'];
            $_SESSION['email'] = $user['EMAIL'];

            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid password";
            header("Location: login.html");
            exit();
        }
    } else {
        $_SESSION['error'] = "Username not found";
        header("Location: login.html");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
