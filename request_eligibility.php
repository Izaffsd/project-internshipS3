<?php
// request_eligilibility.php
session_start(); // Start the session
if (!isset($_SESSION['username'])) {
    header("Location: login_pelajar.php"); // Redirect to login if not logged in
    exit();
}

include 'config.php'; // Include the database connection file

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_SESSION['username']; // Fetch the username from session
    $ndp = $_POST['ndp'];
    $reason = $_POST['reason'];

    // Insert request into the database
    $sql = "INSERT INTO eligibility_requests (student_name, ndp, reason, status) VALUES (?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $student_name, $ndp, $reason);

    if ($stmt->execute()) {
        echo "<script>alert('Your eligibility request has been submitted.'); window.location.href = 'pelajar.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eligibility Request Form</title>
    <style>
      .form-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            margin-left: 54rem;
        }

        .form-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .form-header {
            color: #2d3748;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
        }

        .form-header:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: #4299e1;
            border-radius: 3px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
        }

        textarea.form-control {
            height: 120px;
            resize: vertical;
        }

        .btn {
            width: 100%;
            padding: 14px 24px;
            background: #4299e1;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #3182ce;
            transform: translateY(-2px);
        }

        .btn:active {
            transform: translateY(0);
        }

        @media (max-width: 480px) {
            .form-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<section class="form-container">
    <div class="form-card">
        <h4 class="form-header">Request Eligibility</h4>
        <form method="post" action="">
            <div class="form-group">
                <label for="ndp">NDP (Student ID No.)</label>
                <input type="text" id="ndp" class="form-control" name="ndp" placeholder="Enter your student ID number" required>
            </div>
            <div class="form-group">
                <label for="reason">Reason for Request</label>
                <textarea id="reason" class="form-control" name="reason" placeholder="Explain your reason for applying..." required></textarea>
            </div>
            <button type="submit" class="btn">Submit Request</button>
        </form>
    </div>
</section>

<!-- Footer inclusion -->
<?php include 'footer.php'; ?>

</body>
</html>