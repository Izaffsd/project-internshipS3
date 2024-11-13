<?php
session_start(); // Memulakan sesi untuk menyemak status login
include 'config.php'; // Memasukkan fail konfigurasi untuk sambungan database
$result = mysqli_query($conn, "SELECT * FROM internships"); // Mendapatkan semua data dari table internships
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="./images/Logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <title>Sistem Latihan Industri</title>

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
    <link rel="stylesheet" href="css/pengajar.css" />
  </head>
  <body>
    <!-- header section starts  -->

    <header class="header">
      <a href="pengajar.php" class="logo">Iskandar<span>Banin</span></a>


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
                <h2>Logout as Instructor</h2>
                <a href="logout.php" class="btn-login">Continue Logout</a>
            </div>
        </div>

    </form>

    </header>

    <div class="contact-info">
      <div id="close-contact-info" class="fas fa-times"></div>

      <div class="info">
        <i class="fas fa-phone"></i>
        <h3>phone number</h3>
        <p>+123-456-7890</p>
        <p>+111-222-3333</p>
      </div>

      <div class="info">
        <i class="fas fa-envelope"></i>
        <h3>email address</h3>
        <p>admin@sherwinvishesh.com</p>
      </div>

      <div class="info">
        <i class="fas fa-map-marker-alt"></i>
        <h3>office address</h3>
        <p>tempe, AZ 85281</p>
      </div>

      <div class="share">
        <a href="https://www.instagram.com/sherwinvishesh/" class="fab fa-instagram"></a>
        <a href="https://www.linkedin.com/in/sherwinvishesh" class="fab fa-linkedin"></a>
      </div>
    </div>

    <!-- header section ends -->

    <!-- home section starts  -->

    <section class="home" id="home">
      <div class="swiper home-slider">
        <div class="swiper-wrapper">
          <section
            class="swiper-slide slide"
            style="background: url(images/BG1.png) no-repeat"
          >
            <div class="content">
              <h3>Innovating Your Digital Future</h3>
              <p>
                Elevate your business with cutting-edge web development, mobile applications, and AI solutions.
              </p>
              <a href="#about" class="btn">about</a>
              <a href="#about" class="btn">report</a>

            </div>
          </section>

          <section
            class="swiper-slide slide"
            style="background: url(images/BG2.png) no-repeat"
          >
            <div class="content">
              <h3>Where Technology Meets Vision</h3>
              <p>
                Tailored IT solutions that fit your unique business needs. Let's build something amazing together.
              </p>
              <a href="#about" class="btn">about</a>
              <a href="#about" class="btn">report</a>
            </div>
          </section>
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
</section>

    <!-- home section ends -->

<section class="about" id="about">
    <h1 class="section-heading">About</h1>

    <div class="custom-container">
        <div class="section-header">
            <h2>Senarai Latihan Industri Pelajar</h2>

        <?php if (isset($_SESSION['username'])): ?>
            <a href="create.php" class="btn create-button">Tambah Maklumat Latihan Industri</a>
        <?php endif; ?>
        </div>
        
        

        <!-- Alerts -->
        <?php if (isset($_SESSION["delete"])): ?>
            <div class="alert success-alert">
                <?php echo $_SESSION["delete"]; ?>
                <button type="button" class="close-alert">&times;</button>
            </div>
            <?php unset($_SESSION["delete"]); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION["create"])): ?>
            <div class="alert success-alert">
                <?php echo $_SESSION["create"]; ?>
                <button type="button" class="close-alert">&times;</button>
            </div>
            <?php unset($_SESSION["create"]); ?>
        <?php endif; ?>

        <!-- Data Table -->
        <table class="custom-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pelajar</th>
                    <th>Nama Syarikat</th>
                    <th>Tarikh Mula</th>
                    <th>Tarikh Tamat</th>
                    <th>Status</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['student']; ?></td>
                    <td><?php echo $row['company']; ?></td>
                    <td><?php echo $row['start_date']; ?></td>
                    <td><?php echo $row['end_date']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <a href="view.php?id=<?php echo $row['id']; ?>" class="btn info-button">Lihat</a>
                        <?php if (isset($_SESSION['username'])): ?>
                            <a href="update.php?id=<?php echo $row['id']; ?>" class="btn update-button">Kemaskini</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn delete-button">Padam</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>



<section class="footer">
    <div class="credit">
        <p>Created by <span class="creator-name">Sistem Iskandar & Banin</span> | All rights reserved!</p>
    </div>
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



