<?php
session_start();
include 'config.php'; // Database connection

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

if ($username && $password && $role) {
    // Check login details in the database
    $sql = "SELECT * FROM users WHERE username = ? AND role = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            // Redirect based on the user's role
            if ($role == 'KB-TPP' || $role == 'KB-CADDS') {
                header("Location: kb_dashboard.php");
            } elseif ($role == 'PPLI-TPP' || $role == 'PPLI-CADDS') {
                header("Location: ppli_dashboard.php");
            }
            exit();
        } else {
            echo "<script>alert('Password salah!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Login gagal!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Sila isi semua medan.'); window.history.back();</script>";
}
?>
