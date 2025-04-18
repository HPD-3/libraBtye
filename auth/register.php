<?php
include('../config/db.php');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        echo "<script>
            alert('Registration successful! Click OK to login.');
            window.location.href = '../login.php';
        </script>";
    } catch (mysqli_sql_exception $e) {
    
        if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
            echo "<script>
                alert('Registration failed: Username already exists.');
                window.location.href = '../login.php';
            </script>";
        } else {
            echo "<script>
                alert('An unexpected error occurred: " . addslashes($e->getMessage()) . "');
                window.location.href = '../login.php';
            </script>";
        }
    }
}
?>
