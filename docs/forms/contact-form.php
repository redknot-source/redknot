<?php
/**
 * Red-Knot Immigration Contact Form Handler
 * Replaces Netlify Forms functionality for BigRock hosting
 */

// Start session for security
session_start();

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit();
}

// CSRF Protection (optional - implement if needed)
// if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
//     header('Location: /error.html');
//     exit();
// }

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to validate email
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Process different form types
$form_type = isset($_POST['form_type']) ? sanitize_input($_POST['form_type']) : '';

switch ($form_type) {
    case 'contact':
        handle_contact_form();
        break;
    case 'assessment':
        handle_assessment_form();
        break;
    case 'newsletter':
        handle_newsletter_form();
        break;
    case 'career':
        handle_career_form();
        break;
    default:
        header('Location: /error.html');
        exit();
}

function handle_contact_form() {
    // Validate and sanitize inputs
    $name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : '';
    $service = isset($_POST['service']) ? sanitize_input($_POST['service']) : '';
    $message = isset($_POST['message']) ? sanitize_input($_POST['message']) : '';
    
    // Validation
    $errors = [];
    
    if (empty($name)) {
        $errors[] = 'Name is required';
    }
    
    if (empty($email) || !validate_email($email)) {
        $errors[] = 'Valid email is required';
    }
    
    if (empty($phone)) {
        $errors[] = 'Phone number is required';
    }
    
    if (empty($message)) {
        $errors[] = 'Message is required';
    }
    
    // If validation fails
    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
        header('Location: /error.html');
        exit();
    }
    
    // Email configuration
    $to = "contact@redknotconsulting.com";
    $subject = "New Contact Form Submission - Red-Knot Immigration";
    
    // Email headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: noreply@redknotconsulting.com\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    
    // Email template
    $email_body = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>New Contact Form Submission</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            .header { background-color: #0A4C96; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .field { margin-bottom: 15px; }
            .field strong { color: #0A4C96; }
            .footer { background-color: #f4f4f4; padding: 15px; text-align: center; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>Red-Knot Immigration - New Contact Form Submission</h2>
        </div>
        <div class='content'>
            <div class='field'><strong>Name:</strong> {$name}</div>
            <div class='field'><strong>Email:</strong> {$email}</div>
            <div class='field'><strong>Phone:</strong> {$phone}</div>
            <div class='field'><strong>Service Interest:</strong> {$service}</div>
            <div class='field'><strong>Message:</strong><br>" . nl2br($message) . "</div>
            <div class='field'><strong>Submission Time:</strong> " . date('Y-m-d H:i:s T') . "</div>
            <div class='field'><strong>IP Address:</strong> " . $_SERVER['REMOTE_ADDR'] . "</div>
        </div>
        <div class='footer'>
            <p>This email was sent from the Red-Knot Immigration website contact form.</p>
            <p>Reply directly to this email to respond to the inquiry.</p>
        </div>
    </body>
    </html>
    ";
    
    // Send email
    if (mail($to, $subject, $email_body, $headers)) {
        // Log successful submission (optional)
        $log_entry = date('Y-m-d H:i:s') . " - Contact form submitted by: $name ($email)\n";
        file_put_contents('contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
        
        // Redirect to success page
        header('Location: /thank-you.html?type=contact');
        exit();
    } else {
        // Log error (optional)
        $error_log = date('Y-m-d H:i:s') . " - Email failed for: $name ($email)\n";
        file_put_contents('error_log.txt', $error_log, FILE_APPEND | LOCK_EX);
        
        // Redirect to error page
        header('Location: /error.html?type=email');
        exit();
    }
}

function handle_assessment_form() {
    // Visa assessment form processing
    $name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : '';
    $country = isset($_POST['country']) ? sanitize_input($_POST['country']) : '';
    $age = isset($_POST['age']) ? sanitize_input($_POST['age']) : '';
    $education = isset($_POST['education']) ? sanitize_input($_POST['education']) : '';
    $experience = isset($_POST['experience']) ? sanitize_input($_POST['experience']) : '';
    $english_level = isset($_POST['english_level']) ? sanitize_input($_POST['english_level']) : '';
    
    // Email configuration for assessment
    $to = "contact@redknotconsulting.com";
    $subject = "Free Visa Assessment Request - Red-Knot Immigration";
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: noreply@redknotconsulting.com\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    
    $email_body = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Free Visa Assessment Request</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            .header { background-color: #B68A35; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .field { margin-bottom: 15px; }
            .field strong { color: #0A4C96; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>Free Visa Assessment Request</h2>
        </div>
        <div class='content'>
            <div class='field'><strong>Name:</strong> {$name}</div>
            <div class='field'><strong>Email:</strong> {$email}</div>
            <div class='field'><strong>Phone:</strong> {$phone}</div>
            <div class='field'><strong>Target Country:</strong> {$country}</div>
            <div class='field'><strong>Age:</strong> {$age}</div>
            <div class='field'><strong>Education Level:</strong> {$education}</div>
            <div class='field'><strong>Work Experience:</strong> {$experience} years</div>
            <div class='field'><strong>English Level:</strong> {$english_level}</div>
            <div class='field'><strong>Submission Time:</strong> " . date('Y-m-d H:i:s T') . "</div>
        </div>
    </body>
    </html>
    ";
    
    if (mail($to, $subject, $email_body, $headers)) {
        header('Location: /thank-you.html?type=assessment');
        exit();
    } else {
        header('Location: /error.html?type=assessment');
        exit();
    }
}

function handle_newsletter_form() {
    // Newsletter subscription
    $email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
    $name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
    
    if (empty($email) || !validate_email($email)) {
        header('Location: /error.html?type=newsletter');
        exit();
    }
    
    // Store in a simple file (consider database for production)
    $subscriber_data = date('Y-m-d H:i:s') . "," . $email . "," . $name . "\n";
    file_put_contents('newsletter_subscribers.csv', $subscriber_data, FILE_APPEND | LOCK_EX);
    
    // Send confirmation email
    $to = $email;
    $subject = "Welcome to Red-Knot Immigration Newsletter";
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: contact@redknotconsulting.com\r\n";
    
    $email_body = "
    <h2>Welcome to Red-Knot Immigration!</h2>
    <p>Thank you for subscribing to our newsletter.</p>
    <p>You'll receive updates about immigration opportunities, visa processing updates, and helpful guides.</p>
    <p>Best regards,<br>Red-Knot Immigration Team</p>
    ";
    
    mail($to, $subject, $email_body, $headers);
    
    header('Location: /thank-you.html?type=newsletter');
    exit();
}

function handle_career_form() {
    // Career application form processing
    $name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : '';
    $expertise = isset($_POST['expertise']) ? sanitize_input($_POST['expertise']) : '';
    $location_preference = isset($_POST['location_preference']) ? sanitize_input($_POST['location_preference']) : '';
    $cover_letter = isset($_POST['cover_letter']) ? sanitize_input($_POST['cover_letter']) : '';
    $experience = isset($_POST['experience']) ? sanitize_input($_POST['experience']) : '';
    
    // Validation
    $errors = [];
    
    if (empty($name)) {
        $errors[] = 'Name is required';
    }
    
    if (empty($email) || !validate_email($email)) {
        $errors[] = 'Valid email is required';
    }
    
    if (empty($phone)) {
        $errors[] = 'Phone number is required';
    }
    
    if (empty($expertise)) {
        $errors[] = 'Expertise field is required';
    }
    
    if (empty($cover_letter)) {
        $errors[] = 'Cover letter is required';
    }
    
    // If validation fails
    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
        header('Location: /error.html');
        exit();
    }
    
    // Handle file upload
    $resume_info = '';
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/resumes/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $file_extension = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
        $allowed_extensions = ['pdf', 'doc', 'docx'];
        
        if (in_array(strtolower($file_extension), $allowed_extensions) && $_FILES['resume']['size'] <= 5 * 1024 * 1024) {
            $new_filename = 'resume_' . $name . '_' . date('Y-m-d_H-i-s') . '.' . $file_extension;
            $upload_path = $upload_dir . $new_filename;
            
            if (move_uploaded_file($_FILES['resume']['tmp_name'], $upload_path)) {
                $resume_info = "Resume uploaded: " . $new_filename;
            } else {
                $resume_info = "Resume upload failed";
            }
        } else {
            $resume_info = "Invalid resume file (only PDF, DOC, DOCX under 5MB allowed)";
        }
    } else {
        $resume_info = "No resume uploaded";
    }
    
    // Email configuration for career applications
    $to = "careers@redknotconsulting.com";
    $subject = "New Career Application - Red-Knot Consultants";
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: careers@redknotconsulting.com\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    
    $email_body = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>New Career Application</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            .header { background-color: #0A4C96; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .field { margin-bottom: 15px; }
            .field strong { color: #0A4C96; }
            .footer { background-color: #f4f4f4; padding: 15px; text-align: center; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>New Career Application</h2>
        </div>
        <div class='content'>
            <div class='field'><strong>Name:</strong> {$name}</div>
            <div class='field'><strong>Email:</strong> {$email}</div>
            <div class='field'><strong>Phone:</strong> {$phone}</div>
            <div class='field'><strong>Expertise:</strong> {$expertise}</div>
            <div class='field'><strong>Location Preference:</strong> {$location_preference}</div>
            <div class='field'><strong>Cover Letter:</strong><br>" . nl2br($cover_letter) . "</div>
            <div class='field'><strong>Experience:</strong><br>" . nl2br($experience) . "</div>
            <div class='field'><strong>Resume:</strong> {$resume_info}</div>
            <div class='field'><strong>Application Time:</strong> " . date('Y-m-d H:i:s T') . "</div>
            <div class='field'><strong>IP Address:</strong> " . $_SERVER['REMOTE_ADDR'] . "</div>
        </div>
        <div class='footer'>
            <p>This career application was submitted through the Red-Knot Consultants website.</p>
        </div>
    </body>
    </html>
    ";
    
    if (mail($to, $subject, $email_body, $headers)) {
        // Log successful submission
        $log_entry = date('Y-m-d H:i:s') . " - Career application submitted by: $name ($email) - $expertise\n";
        file_put_contents('career_applications_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
        
        // Redirect to success page
        header('Location: /thank-you.html?type=career');
        exit();
    } else {
        // Log error
        $error_log = date('Y-m-d H:i:s') . " - Career application email failed for: $name ($email)\n";
        file_put_contents('error_log.txt', $error_log, FILE_APPEND | LOCK_EX);
        
        // Redirect to error page
        header('Location: /error.html?type=career');
        exit();
    }
}
?> 