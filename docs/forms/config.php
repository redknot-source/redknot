<?php
/**
 * Red-Knot Immigration Configuration File
 * Configure email settings and file upload parameters for BigRock hosting
 */

// Email Configuration
define('ADMIN_EMAIL', 'info@redknot.ae');
define('FROM_EMAIL', 'noreply@redknot.ae');
define('SITE_NAME', 'Red-Knot Immigration');

// File Upload Configuration
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['pdf', 'doc', 'docx']);
define('UPLOAD_BASE_DIR', 'uploads/');

// Directory Structure
define('CAREER_UPLOAD_DIR', UPLOAD_BASE_DIR . 'resumes/');
define('ASSESSMENT_UPLOAD_DIR', UPLOAD_BASE_DIR . 'assessments/');

// Security Settings
define('SESSION_TIMEOUT', 3600); // 1 hour
define('MAX_ATTEMPTS_PER_IP', 5); // Max form submissions per IP per hour

// Create upload directories if they don't exist
function create_upload_directories() {
    $directories = [
        UPLOAD_BASE_DIR,
        CAREER_UPLOAD_DIR,
        ASSESSMENT_UPLOAD_DIR
    ];
    
    foreach ($directories as $dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
            // Create .htaccess to prevent direct access
            $htaccess_content = "Options -Indexes\nDeny from all\n";
            file_put_contents($dir . '.htaccess', $htaccess_content);
        }
    }
}

// Rate limiting function
function check_rate_limit($ip) {
    $rate_file = 'rate_limits.json';
    $current_time = time();
    $rate_data = [];
    
    if (file_exists($rate_file)) {
        $rate_data = json_decode(file_get_contents($rate_file), true) ?: [];
    }
    
    // Clean old entries (older than 1 hour)
    foreach ($rate_data as $stored_ip => $data) {
        if ($current_time - $data['first_attempt'] > 3600) {
            unset($rate_data[$stored_ip]);
        }
    }
    
    // Check current IP
    if (isset($rate_data[$ip])) {
        if ($rate_data[$ip]['count'] >= MAX_ATTEMPTS_PER_IP) {
            if ($current_time - $rate_data[$ip]['first_attempt'] < 3600) {
                return false; // Rate limit exceeded
            } else {
                // Reset after 1 hour
                unset($rate_data[$ip]);
            }
        }
    }
    
    // Increment counter
    if (!isset($rate_data[$ip])) {
        $rate_data[$ip] = [
            'count' => 1,
            'first_attempt' => $current_time
        ];
    } else {
        $rate_data[$ip]['count']++;
    }
    
    // Save updated data
    file_put_contents($rate_file, json_encode($rate_data));
    return true;
}

// Initialize
create_upload_directories();
?>