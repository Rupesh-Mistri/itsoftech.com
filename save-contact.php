<?php
header("Content-Type: application/json");
session_start();

$LOCAL_ENV = true;
if (is_dir('/var')) {
    $LOCAL_ENV = false;
}

if ($LOCAL_ENV) {
    $conn = new mysqli("localhost", "root", "", "itsoftech");
} else {
    $conn = new mysqli("localhost", "razcrqqi_itsoftech", "]hPMREBf5w=S@^k&", "razcrqqi_itsoftech");
}

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit();
}

$mobile = htmlspecialchars($_POST['mobile_no'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$message = htmlspecialchars($_POST['message'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "message" => "Invalid email format."]);
    exit();
}

$sql = "INSERT INTO tbl_contact_messages (mobile_no, email, message, created_at) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo json_encode(["success" => false, "message" => "Prepare failed: " . $conn->error]);
    exit();
}
$stmt->bind_param("sss", $mobile, $email, $message);
$stmt->execute();
$stmt->close();

// // Send email
// $to = "your_email@domain.com";
// $subject = "New Contact Form Submission";
// $body = "Mobile: $mobile\nEmail: $email\n\nMessage:\n$message";
// $headers = "From: noreply@itsoftech.com";
// mail($to, $subject, $body, $headers);

// $conn->close();

echo json_encode([
  "success" => true,
  "message" => "Thank you, we will contact you soon."
]);
exit();
?>
