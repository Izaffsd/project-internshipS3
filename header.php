<?php
// Ensure there's no whitespace before this line
// Your PHP code...
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
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/footer.css" />



  </head>
  <body>
<!-- header section starts  -->
<div class="header1">
    <div class="contact-section">
        <div class="announcement">
            <span class="scrolling-text">
                <a href="index.php" target="_blank">ILP - <strong> Kuala Langat</strong></a>
            </span>
        </div>
        <div class="contact-info1">
            <span><i class="fa fa-envelope"></i>info.ilpkls@jtm.gov.my</span>
        </div>
    </div>
</div>

<header class="header">
    <a href="index.php" class="logo">System<span>Internship</span></a>

    <a href="index.php"><img src="images/ilp.png" alt="logo" class="logo-img"></a>
    <div class="icons">
        <div id="menu-btn" class="fas fa-bars"></div>
        <div id="info-btn" class="fas fa-info-circle"></div>
        <div id="search-btn" class="fas fa-search"></div>
        <div id="login-btn" class="fas fa-right-to-bracket"></div>
    </div>

    <form action="" class="search-form">
        <input type="search" placeholder="search here..." id="search-box" />
        <label for="search-box" class="fas fa-search"></label>
    </form>

  
    <form action="" method="POST" class="login-form">
        <div class="login-section">
            <div class="login-card pelajar-card">
                <div class="icon-box">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h2>Login as Student</h2>
                <a href="login_pelajar.php" class="btn-login">Continue as Student</a>
            </div>

            <div class="login-card pengajar-card">
                <div class="icon-box">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h2>Login as KB/PPLI</h2>
                <a href="login_pengajar.php" class="btn-login">Continue as KB/PPLI</a>
            </div>
        </div>
    </form>

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
</header>
<script src="js/script.js"></script>
