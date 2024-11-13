<?php
session_start();
include 'config.php'; // Include database connection file

// Login process for students
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $password = $_POST['password'];

    // Check if the student_name exists in the students table
    $sql = "SELECT * FROM students WHERE student_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Successful login, save the session
            $_SESSION['username'] = $student_name; // Changed to match the session variable used in pelajar.php
            header("Location: pelajar.php"); // Redirect to pelajar.php
            exit();
        } else {
            $error = "Incorrect student name or password.";
        }
    } else {
        $error = "Incorrect student name or password.";
    }
}
?>

<?php include 'header.php'; ?>

<section class="home" id="home">
    <div class="swiper-wrapper">
      <section class="swiper-slide slide" style="background: url('images/BG1.png') no-repeat center center/cover;">
        <div class="content">
          <h3>Student</h3>
          <p>Join us and enhance your skills with top-notch education in web development, mobile applications, and AI solutions.</p>
        </div>
        <div class="form-container">
            <div class="form-card">
                <h4 class="form-header">Log In as Student</h4>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="login_pelajar.php" method="post">
                    <div class="form-group">
                        <label for="student_name">Student Name</label>
                        <input type="text" id="student_name" class="form-control" name="student_name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn">Log In</button>
                    <p>Don't have an account? <a href="index.php">Create one!</a></p>
                    <p><a href="forgot_psw.php">Forgot your password?</a></p>
                </form>
            </div>
        </div>
      </section>
    </div>
</section>
<?php include 'footer.php'; ?>
