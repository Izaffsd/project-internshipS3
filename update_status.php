<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'KB') {
    header("Location: login_pengajar.php");
    exit();
}

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $application_id = $_POST['application_id'];
    $action = $_POST['action'];

    $status = ($action === 'approve') ? 'Approved' : 'Rejected';

    // Update application status
    $stmt = $conn->prepare("UPDATE applications SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $application_id);

    if ($stmt->execute()) {
        header("Location: kb_dashboard.php");
    } else {
        echo "Error updating status.";
    }

    $stmt->close();
    $conn->close();
}
?>
