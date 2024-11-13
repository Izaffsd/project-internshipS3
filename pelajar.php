<?php
// pelajar.php
session_start(); // Start the session
if (!isset($_SESSION['username'])) {
    header("Location: login_pelajar.php"); // Redirect to login if not logged in
    exit();
}

include 'config.php'; // Include the database connection file

// Fetch the username from the session
$student_name = $_SESSION['username'];

// Query the database for the student details
$sql = "SELECT * FROM students WHERE student_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_name);
$stmt->execute();
$result = $stmt->get_result();

// Check if we got a result
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="./images/Logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <title>Welcome <?php echo htmlspecialchars($student_name); ?></title>

    <!-- font awesome cdn link  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />

    <script src="https://kit.fontawesome.com/0ede200358.js" crossorigin="anonymous"></script>


    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css"
    />

    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
    />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/pelajar.css" />
    <link rel="stylesheet" href="css/footer.css" />

  </head>
  <body>
    <!-- header section starts  -->

    <header class="header">
      <a href="pelajar.php" class="logo">System<span>Internship</span></a>


      <div class="icons">
        <div id="menu-btn" class="fas fa-bars"></div>
        <div id="info-btn" class="fas fa-info-circle"></div>
        <div id="search-btn" class="fas fa-search"></div>
        <div id="login-btn" class="fas fa-solid fa-right-to-bracket"></div>
      </div>

      <form action="" class="search-form">
        <input
          type="search"
          name=""
          placeholder="search here..."
          id="search-box"
        />
        <label for="search-box" class="fas fa-search"></label>
      </form>


    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>
    <form action="" method="POST" class="login-form">

        <div class="login-section">
            <div class="login-card pelajar-card">
                <div class="icon-box">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h2>Logout as <?php echo htmlspecialchars($student_name); ?></h2>
                <a href="logout.php" class="btn-login">Continue Logout</a>
            </div>


        </div>

    </form>

    </header>

    <div class="contact-info">
      <div id="close-contact-info" class="fas fa-times"></div>

      <div class="info">
            <i class="fas fa-phone"></i>
            <h3>Phone Number</h3>
            <p>+60 331204600</p>
            <p>+60189192276</p>
        </div>

        <div class="info">
            <i class="fas fa-envelope"></i>
            <h3>Email Address</h3>
            <p>info.ilpkls@jtm.gov.my</p>
        </div>

        <div class="info">
            <i class="fas fa-map-marker-alt"></i>
            <h3>Office Address</h3>
            <p>Institut Latihan Perindustrian Kuala Langat<br>Jalan Sultan Abd Samad, 42700 Banting, Selangor</p>
        </div>

        <div class="share">
            <a href="https://www.instagram.com/ilpkualalangat_official?igsh=MW9uc3Z4YXMzOTR6ZA==" class="fab fa-instagram"></a>
            <a href="https://x.com/ilpkualalangat?s=21" class="fab fa-twitter"></a>
            <a href="https://www.tiktok.com/@ilpkualalangat_official?_t=8pQV6cJJQzB&_r=1" class="fab fa-tiktok"></a>
            <a href="https://www.facebook.com/ILPKLS?mibextid=LQQJ4d" class="fab fa-facebook-f"></a>
        </div>
    </div>

    <!-- header section ends -->

    <?php
// Check if a session is already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login_pelajar.php");
    exit();
}

// Include the database connection file
include 'config.php';

$student_name = $_SESSION['username'];

// Fetch student details
$sql = "SELECT * FROM students WHERE student_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
    <section class="home" id="home"> 
        <div class="swiper-wrapper">
            <section class="swiper-slide slide" style="background: url(images/BG1.png) no-repeat">
                <div class="content">
                    <h3>Innovating Your Digital Future</h3>
                    <p>Elevate your business with cutting-edge web development, mobile applications, and AI solutions.</p>
                    <a href="request_eligibility.php" class="btn">Membuat Permohonan</a>
                       <?php if ($row['status'] === 'Layak'): ?>
        <a href="fill_form.php" class="btn">Isi Borang LI</a>
    <?php endif; 
} else {
    echo "<p>No details available.</p>";
}
?>
                </div>
            </section>
        </div>
    </section>

    <section class="about" id="about">
        <h1>Welcome, <?php echo htmlspecialchars($row['student_name']); ?>!</h1>
        <h2>Your Details:</h2>
        <table class="table">
            <tr>
                <td class="titlef">Name</td>
                <td><?php echo htmlspecialchars($row['student_name']); ?></td>
            </tr>
            <tr>
                <td class="titlef">Campus</td>
                <td><?php echo htmlspecialchars($row['campus']); ?></td>
            </tr>
            <tr>
                <td class="titlef">NDP</td>
                <td><?php echo htmlspecialchars($row['ndp']); ?></td>
            </tr>
        </table>

        <a href="forgot_psw.php" class="btn">Change Password</a>
    </section>

 




    <!-- footer section ends -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

    <script>
      lightGallery(document.querySelector(".projects .box-container"));
    </script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
