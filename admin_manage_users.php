<?php
include 'config.php'; // Sambungan ke pangkalan data

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Dapatkan data dari borang dan bersihkan input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $course = trim($_POST['course']);

    // Periksa input kosong
    if (empty($username) || empty($password) || empty($role) || empty($full_name) || empty($email) || empty($phone) || empty($course)) {
        echo "Sila pastikan semua medan diisi.";
        exit();
    }

    // Semak jika username sudah wujud
    $check_sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Username sudah wujud
        echo "Username telah wujud. Sila cuba username yang lain.";
    } else {
        // Hash kata laluan untuk keselamatan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Teruskan dengan memasukkan data ke dalam pangkalan data
        $insert_sql = "INSERT INTO users (username, password, role, full_name, email, phone, course) 
                       VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("sssssss", $username, $hashed_password, $role, $full_name, $email, $phone, $course);

        if ($stmt->execute()) {
            echo "Pengguna berjaya ditambah!";
        } else {
            echo "Ralat: " . $stmt->error;
        }
    }

    // Tutup pernyataan dan sambungan
    $stmt->close();
    $conn->close();
} else {
    echo "Kaedah permintaan tidak dibenarkan.";
}
?>
