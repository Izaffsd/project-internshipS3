<?php
session_start();
include 'config.php'; // Include the database connection file

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure user type is set
    if (isset($_POST['user_type'])) {
        $user_type = $_POST['user_type'];

        if ($user_type == 'student') {
            // Get form inputs for student
            $student_name = $_POST['student_name'];
            $campus = $_POST['campus'];
            $ndp = $_POST['ndp'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password
            $course = $_POST['course']; // Capture the course input

            // Check if the student NDP already exists
            $checkNDP = "SELECT * FROM students WHERE ndp = ?";
            $stmt = $conn->prepare($checkNDP);
            $stmt->bind_param("s", $ndp);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<script>alert('Student ID already exists!'); window.location.href = 'index.php';</script>";
            } else {
                // Insert new student into the database
                $sql = "INSERT INTO students (student_name, campus, ndp, password, course) VALUES (?, ?, ?, ?, ?)"; // Include course
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $student_name, $campus, $ndp, $password, $course); // Include course

                if ($stmt->execute()) {
                    header("Location: login_pelajar.php"); // Redirect students to the login page
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
        }
    } else {
        echo "<script>alert('User type is not defined!');</script>"; // This is the error you're seeing
    }
}
?>

<!-- Your HTML output -->
<?php include 'header.php'; ?>



      <section class="home" id="home">
  <div class="swiper home-slider">
    <div class="swiper-wrapper">

      <section class="swiper-slide slide" style="background: url('images/BG1.png') no-repeat center center/cover;">
        <div class="content">
          <h3>Internship is the first Step</h3>
          <p>Gain valuable real-world experience and develop your skills through our internship program. Work alongside industry experts, tackle real challenges, and take the first step towards a successful career.</p>
        </div>

<div class="form-container">
  <div class="form-card">
  <h4 class="form-header">Student Information</h4>
  <form method="post" action="" enctype="multipart/form-data">
              <input type="hidden" name="user_type" value="student">
              <div class="form-group">
                  <label for="student-name">Nama Pelajar (Student's Name)</label>
                  <input type="text" id="student-name" class="form-control" name="student_name" placeholder="Enter your full name" required>
              </div>
              <div class="form-group">
                  <label for="campus">Kampus (Campus)</label>
                  <select name="campus" id="campus" required>
                      <option value="" disabled selected>Select Campus</option>
                      <option value="ILPKLS - TPP">ILPKLS - TPP</option>
                      <option value="ILPKLS - CADD">ILPKLS - CADD</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="ndp">NDP (Student ID No.)</label>
                  <input type="text" id="ndp" class="form-control" name="ndp" placeholder="Enter your student ID number" required>
              </div>
              <div class="form-group">
                  <label for="password-student">Password</label>
                  <input type="password" id="password-student" class="form-control" name="password" placeholder="Enter your password" required>
              </div>
              <div class="form-group">
                  <label for="course">Course</label> <!-- New field for course -->
                  <input type="text" id="course" class="form-control" name="course" placeholder="Enter your course name" required>
              </div>
              <button type="submit" class="btn">Submit</button>
            </form>
  </div>
</div>

      </section>

      <!-- Slide 2: Instructor Sign-up
      <section class="swiper-slide slide" style="background: url('images/BG2.png') no-repeat center center/cover;">
        <div class="content">
          <h3>Instructor</h3>
          <p>Join us in empowering students to reach their full potential while advancing your professional expertise.</p>
        </div>
        <div class="form-container">
          <div class="form-card">
            <h4 class="form-header">Sign Up as Instructor</h4>
            <form method="post" action="">
              <input type="hidden" name="user_type" value="instructor">
              <div class="form-group">
                <label for="username-instructor">Username</label>
                <input type="text" id="username-instructor" class="form-control" name="username" placeholder="Enter your username" required>
              </div>
              <div class="form-group">
                <label for="email-instructor">Email</label>
                <input type="email" id="email-instructor" class="form-control" name="email" placeholder="Enter your email" required>
              </div>
              <div class="form-group">
                <label for="password-instructor">Password</label>
                <input type="password" id="password-instructor" class="form-control" name="password" placeholder="Enter your password" required>
              </div>
              <button type="submit" class="btn">Sign Up</button>
            </form>
          </div>
        </div>
      </section> -->

    </div>
    <!-- Swiper Buttons -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</section>

<?php include 'footer.php'; ?>

<!-- Footer section ends -->

<!-- External Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS for Swiper -->
<script src="js/script.js"></script>

<script>
  // Swiper initialization
  var swiper = new Swiper('.home-slider', {
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });

  // Lightgallery initialization for projects
  lightGallery(document.querySelector(".projects .box-container"));
</script>


 
</body>
</html>
