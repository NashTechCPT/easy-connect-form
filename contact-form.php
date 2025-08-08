<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize form fields
    $first_name = sanitize_text_field($_POST['ecf-first-name']);
    $last_name = sanitize_text_field($_POST['ecf-last-name']);
    $email = sanitize_email($_POST['ecf-email']);
    $phone = sanitize_text_field($_POST['ecf-phone']);
    $message = sanitize_textarea_field($_POST['ecf-message']);

    // Send the email if all required fields are filled
    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($message)) {
        // Email to admin
        $to = get_option('admin_email');
        $subject = 'New Contact Form Submission';
        $body = "You have received a new message from $first_name $last_name.<br><br>";
        $body .= "<strong>Email:</strong> $email<br>";
        $body .= "<strong>Phone:</strong> $phone<br>";
        $body .= "<strong>Message:</strong><br>$message<br>";
        $headers = array(
            'Content-Type: text/html; charset=UTF-8'
        );

        wp_mail($to, $subject, $body, $headers);

        // Email confirmation to client
        $client_to = $email;
        $client_subject = "Thank you for contacting us!";
        $client_body = "Hi $first_name,<br><br>Thank you for reaching out. We received your message and will get back to you soon.<br><br>Best regards,<br>NashTechCPT Team";
        $client_headers = array(
            'Content-Type: text/html; charset=UTF-8'
        );

        wp_mail($client_to, $client_subject, $client_body, $client_headers);

        echo '<p class="ecf-success-message">Thank you for reaching out. We will get back to you soon!</p>';
    } else {
        echo '<p class="ecf-error-message">All required fields must be filled out. Please try again.</p>';
    }
}
?>

<form id="ecf-contact-form" method="post" action="">
    <div class="ecf-form-group">
        <label for="ecf-first-name">First Name:</label>
        <input type="text" id="ecf-first-name" name="ecf-first-name" required>
    </div>
    <div class="ecf-form-group">
        <label for="ecf-last-name">Last Name:</label>
        <input type="text" id="ecf-last-name" name="ecf-last-name" required>
    </div>
    <div class="ecf-form-group">
        <label for="ecf-email">Email:</label>
        <input type="email" id="ecf-email" name="ecf-email" required>
    </div>
    <div class="ecf-form-group">
        <label for="ecf-phone">Phone:</label>
        <input type="tel" id="ecf-phone" name="ecf-phone">
    </div>
    <div class="ecf-form-group">
        <label for="ecf-message">Message:</label>
        <textarea id="ecf-message" name="ecf-message" rows="4" required></textarea>
    </div>
    <div class="ecf-form-group">
        <button type="submit" id="ecf-submit-button">Submit</button>
    </div>
</form>