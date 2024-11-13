
<?php include 'header.php'; ?>

    <!-- home section starts  -->
<!-- home section starts -->
<section class="home" id="home">
    <div class="swiper-wrapper">

        <!-- Slide 1: Instructor Sign-up -->
        <section class="swiper-slide slide" style="background: url('images/BG1.png') no-repeat center center/cover;">
            <div class="content">
                <h3>KB / PPLI</h3>
                <p>Join us and enhance your skills with top-notch education in web development, mobile applications, and AI solutions.</p>
            </div>
            <div class="form-container">
                <div class="form-card">
                    <h4 class="form-header">Log In as KB/PPLI</h4>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <!-- Updated form -->
                    <form action="login_process.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                        </div>

                        <div class="form-group">
                            <label for="role">Pilih Peranan:</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="KB-TPP">Koordinator Bidang (TPP)</option>
                                <option value="KB-CADDS">Koordinator Bidang (CADDS)</option>
                                <option value="PPLI-TPP">Pegawai Pelatih Latihan Industri (TPP)</option>
                                <option value="PPLI-CADDS">Pegawai Pelatih Latihan Industri (CADDS)</option>
                            </select>
                        </div>

                        <button type="submit" class="btn">Login</button>
                    </form>
                </div>
            </div>
        </section>
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
