
<?php
// ppli_dashboard.php
session_start();
if ($_SESSION['role'] != 'PPLI-TPP') {
    header('Location: login_pengajar.php');
    exit;
}

// Ensure 'username' session is set and not null
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';


?>

<?php include 'head_dash.php'; ?>


<!-- Dashboard untuk PPLI-TPP -->
<div class="container">
    <h2>Pelajar untuk Dinilai</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Pelajar</th>
                <th>Status</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'config.php'; // Use config.php for database connection
            $sql = "SELECT * FROM students WHERE course = 'TPP' AND status = 'Layak'";
            $result = mysqli_query($conn, $sql);

           
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Ensure 'name' and 'status' fields are set and not null
                    $student_name = isset($row['student_name']) ? htmlspecialchars($row['student_name']) : 'Unknown';
                    $student_status = isset($row['status']) ? htmlspecialchars($row['status']) : 'N/A';

                    echo "<tr>
                            <td>" . $student_name . "</td>
                            <td>" . $student_status . "</td>
                            <td><a href='rate_student.php?id=" . htmlspecialchars($row['id']) . "' class='btn-nilai'>Nilai</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Tiada pelajar yang layak untuk dinilai</td></tr>";
            }

            ?>
        </tbody>
    </table>
</div>

<!-- CSS Styles -->
<style>
    :root {
  --primary-color: #007bff;
  --primary-color-hover: #0056b3;
  --secondary-color: #333;
  --background-light: #f9f9f9;
  --background-dark: #f5f5f5;
  --text-light: #495151;
  --white: #fff;
  --black: #000;
}


    .logout-btn {
        position: absolute;
        right: 20px;
        top: 20px;
        background-color: #f44336;
        color: white;
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
    }

    
    .logout-btn:hover {
        background-color: #d32f2f;
    }

    .container {
        margin: 50px auto;
        padding: 20px;
        background-color: white;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        width: 80%;
        border-radius: 8px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    table, th, td {
        border: 1px solid #ddd;
        font-size: 2rem;
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .btn-nilai {
        background-color: var(--primary-color);
        color: white;
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 5px;
    }

    .btn-nilai:hover {
        background-color: var(--primary-color-hover);
    }
</style>
