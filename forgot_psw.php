<?php
session_start();
include 'config.php'; // Include the database connection file

// Initialize variables for errors or messages
$error = $success = "";

// Handle form submission for password reset
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ndp = $_POST['ndp'];

    // Check if the NDP exists in the students table
    $checkNDP = "SELECT * FROM students WHERE ndp = ?";
    $stmt = $conn->prepare($checkNDP);
    $stmt->bind_param("s", $ndp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();

        // If new password fields are filled, process password reset
        if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            // Validate passwords match
            if ($new_password === $confirm_password) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the student's password in the database
                $updatePassword = "UPDATE students SET password = ? WHERE ndp = ?";
                $stmt = $conn->prepare($updatePassword);
                $stmt->bind_param("ss", $hashed_password, $ndp);

                if ($stmt->execute()) {
                    $success = "Your password has been successfully reset!";
                } else {
                    $error = "There was an error resetting your password. Please try again.";
                }
            } else {
                $error = "Passwords do not match!";
            }
        }
    } else {
        $error = "Student ID not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://kit.fontawesome.com/0ede200358.js" crossorigin="anonymous"></script>
    <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            position: relative; /* Ensure positioning for back button */
            background-color: #fff;
            padding: 2.4rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 2.5rem;
            margin-top: 2.5rem;

        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
        }
        .form-control {
            width: 92%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn {
            width: 40%;
            padding: 0.8rem;
            background-color: #0056f1;

            color: white;
            border: none;
            border-radius: 1.8rem;
            cursor: pointer;
            font-size: 0.9rem;
            margin-left: 14.7rem;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #007bff;

            
        }
        .back-btn {
            text-decoration: none;
        }
        
        p {
            text-align: center;
        }
        .alert {
            padding: 0.8rem;
            margin-bottom: 1rem;
            border-radius: 4px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .backb {
            position: absolute;
            top: 20px;   /* Adjust the vertical positioning */
            left: 30px;  /* Adjust the horizontal positioning */
        }
        span {
            margin-left: 1rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-container">
             <div class="backb">
            <a href="login_pelajar.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i><span>Return to Login</span></a>
            </div>
        <h2>Forgot Password</h2>
        <form method="post" action="forgot_psw.php">
            <div class="form-group">
                <label for="ndp">Enter your NDP (Student ID)</label>
                <input type="text" id="ndp" class="form-control" name="ndp" placeholder="Enter your Student ID" required>
            </div>

            <?php if (!empty($student)): // Display password reset form if student is found ?>
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" class="form-control" name="new_password" placeholder="Enter new password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm New Password</label>
                    <input type="password" id="confirm-password" class="form-control" name="confirm_password" placeholder="Confirm new password" required>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn">Reset Password</button>

            <?php if ($success): ?>
                <p class="alert alert-success"><?php echo $success; ?></p>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <p class="alert alert-danger"><?php echo $error; ?></p>
            <?php endif; ?>
            
            
        </form>
    </div>
</body>
</html>
