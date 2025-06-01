<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}
$to = '6856sahil@gmail.com';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars(strip_tags(trim($_POST["name"])));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone   = htmlspecialchars(strip_tags(trim($_POST["phone"])));
    $trip    = htmlspecialchars(strip_tags(trim($_POST["trip"])));
    $remarks = htmlspecialchars(strip_tags(trim($_POST["remarks"])));

    if (!empty($name) && !empty($email) && !empty($phone) && !empty($trip)) {
        $subject = "New Trip Enquiry from $name";
        $message = "You have received a new trip enquiry:\n\n" .
                   "Name: $name\n" .
                   "Email: $email\n" .
                   "Phone: $phone\n" .
                   "Selected Trip: $trip\n" .
                   "Remarks: " . (!empty($remarks) ? $remarks : "None");

        $headers = "From: Backpack & Beyond <no-reply@yourdomain.com>\r\n";
        $headers .= "Reply-To: $email\r\n";

        if (mail($to, $subject, $message, $headers)) {
            echo "OK";
        } else {
            echo "Email failed. Please try again later.";
        }
    } else {
        echo "Please fill in all required fields.";
    }
} else {
    echo "Invalid request method.";
}
?>
