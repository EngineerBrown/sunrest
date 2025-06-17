<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["full_name"] ?? '');
    $email = htmlspecialchars($_POST["email"] ?? '');
    $message = "New submission:\n\n" . print_r($_POST, true);

    $to = "nsibare@gmail.com";  // change this to your real email
    $subject = "Sunrest Membership Form Submission";
    $headers = "From: no-reply@sunrest.infinityfreeapp.com\r\n" .
               "Reply-To: $email\r\n" .
               "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        header("Location: thank_you.html");
        exit();
    } else {
        echo "Error sending email. Please try again later.";
    }
} else {
    http_response_code(403);
    echo "Forbidden request method.";
}
?>
