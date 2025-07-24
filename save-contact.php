<?php
// Detect environment
$LOCAL_ENV = true; // Default to local
session_start();
$_SESSION['thank_you_msg'] = "Thank you, we will contact you soon.";

// Check if running on production (e.g., if /var is a real path)
if (is_dir('/var')) {
    $LOCAL_ENV = false;
}

// Connect to DB
if ($LOCAL_ENV) {
    $conn = new mysqli("localhost", "root", "", "itsoftech");
} else {
    $conn = new mysqli("localhost", "razcrqqi_itsoftech", "]hPMREBf5w=S@^k&", "razcrqqi_itsoftech");
}

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and validate inputs
$mobile = htmlspecialchars($_POST['mobile_no'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$message = htmlspecialchars($_POST['message'] ?? '');

// Optional: Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

// Insert into database
$sql = "INSERT INTO tbl_contact_messages (mobile_no, email, message, created_at) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("sss", $mobile, $email, $message);
$stmt->execute();
$stmt->close();

// Send email notification
$to = "your_email@domain.com";
$subject = "New Contact Form Submission";
$body = "Mobile: $mobile\nEmail: $email\n\nMessage:\n$message";
$headers = "From: noreply@itsoftech.com";

mail($to, $subject, $body, $headers);

// Close DB connection
$conn->close();

// Redirect to thank you page
header("Location: /services");
exit();
?>
