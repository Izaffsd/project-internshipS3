<?php
//kb_dashboard.php
session_start();

// Check if user is 'KB-TPP' or 'KB-CADDS'
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'KB-TPP' && $_SESSION['role'] != 'KB-CADDS')) {
    header('Location: login_pengajar.php');
    exit;
}

// Determine course based on user role
$course = $_SESSION['role'] == 'KB-TPP' ? 'TPP' : 'CADDS';
$role_display = $_SESSION['role'] == 'KB-TPP' ? 'Koordinator Bidang TPP' : 'Koordinator Bidang CADDS';

$notification_message = isset($_SESSION['notification_message']) ? $_SESSION['notification_message'] : '';
unset($_SESSION['notification_message']);

include 'config.php';

$id = $_GET['id'] ?? null;
$status = $_POST['status'] ?? null;

if ($status && $id) {
    $sql = "UPDATE students SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        $_SESSION['notification_message'] = 'Status berjaya dikemaskini!';
    } else {
        $_SESSION['notification_message'] = 'Gagal mengemaskini status. Sila cuba lagi.';
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

$student = null;
if ($id) {
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penilaian Pelajar</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --success-color: #059669;
            --danger-color: #dc2626;
            --background-color: #f1f5f9;
            --card-background: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #475569;
            --border-color: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-primary);
            line-height: 1.6;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            flex-grow: 1;
        }

        .logout-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .logout-btn svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .logout-btn {
                width: 100%;
                justify-content: center;
            }
        }

        .header h1 {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.5rem;
        }

        .card {
            background: var(--card-background);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .card h2 {
            color: var(--text-primary);
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
        }

        .assessment-form {
            background: var(--card-background);
            padding: 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-1px);
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 1rem;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table th {
            background-color: rgba(37, 99, 235, 0.1);
            color: var(--text-primary);
            font-weight: 600;
        }

        .table tr:hover {
            background-color: rgba(37, 99, 235, 0.05);
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .action-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .action-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--text-secondary);
        }

        .notification {
            position: fixed;
            top: 2rem;
            right: 2rem;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            background-color: var(--success-color);
            color: white;
            opacity: 0;
            transform: translateY(-1rem);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .notification.show {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .header {
                padding: 1.5rem;
            }

            .card {
                padding: 1.5rem;
            }

            .table th,
            .table td {
                padding: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="header">
            <div class="header-content">
                <h1>Selamat datang, <?= $role_display ?></h1>
                <p><?= htmlspecialchars($_SESSION['username']); ?></p>
            </div>
            <a href="logout.php" class="logout-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Log Keluar
            </a>
        </div>

        <?php if ($student): ?>
        <div class="card">
            <h2>Penilaian Pelajar</h2>
            <div class="assessment-form">
                <div class="form-group">
                    <label>Nama Pelajar:</label>
                    <p class="form-control"><?= htmlspecialchars($student['student_name']); ?></p>
                </div>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="status">Status Kelayakan:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="Layak" <?= ($student['status'] === 'Layak') ? 'selected' : ''; ?>>Layak</option>
                            <option value="Tidak Layak" <?= ($student['status'] === 'Tidak Layak') ? 'selected' : ''; ?>>Tidak Layak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
                </form>
            </div>
        </div>
        <?php endif; ?>

        <div class="card">
            <h2>Senarai Pelajar <?= htmlspecialchars($course); ?> untuk Penilaian</h2>
            
            <?php
            $sql = "SELECT * FROM students WHERE course = ? AND status = 'Dalam Proses'";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $course);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Pelajar</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['student_name']) ?></td>
                                <td>
                                    <span class="status-badge status-pending">
                                        <?= htmlspecialchars($row['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="kb_dashboard.php?id=<?= htmlspecialchars($row['id']) ?>" 
                                       class="action-link">
                                        Tentukan Kelayakan
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state">
                    <p>Tiada pelajar untuk penilaian pada masa ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div id="notification" class="notification"></div>

    <script>
        function showNotification(message) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.classList.add('show');
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        const notificationMessage = <?= json_encode($notification_message); ?>;
        if (notificationMessage) {
            showNotification(notificationMessage);
        }
    </script>
</body>
</html>