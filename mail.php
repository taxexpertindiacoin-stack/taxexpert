<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form se data collect karein
    $name = filter_var(trim($_POST["userName"]), FILTER_SANITIZE_STRING);
    $subject = filter_var(trim($_POST["userSubject"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["userEmail"]), FILTER_SANITIZE_EMAIL);
    $phone = filter_var(trim($_POST["userPhone"]), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);

    // Agar koi field khaali hai to error dein
    if (empty($name) || empty($subject) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        http_response_code(400);
        echo "Please fill out all required fields and provide a valid email address.";
        exit;
    }

    // Email kisko bhejna hai
    $recipient = "taxexpertindia.co.in@gmail.com";

    // Email ka content banayein
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n\n";
    $email_content .= "Subject: $subject\n";
    $email_content .= "Message:\n$message\n";

    // Email ke headers
    $email_headers = "From: $name <$email>";

    // Email bhejein
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
