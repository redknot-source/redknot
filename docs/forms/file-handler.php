<?php
/**
 * Secure File Upload Handler for Red-Knot Immigration
 * Handles resume uploads for career applications and visa assessments
 */

require_once 'config.php';

class FileHandler {
    
    /**
     * Handle file upload with security checks
     * @param array $file - $_FILES array for the file
     * @param string $upload_type - 'career' or 'assessment'
     * @param string $user_name - Name for file naming
     * @return array - ['success' => bool, 'message' => string, 'filename' => string]
     */
    public static function handle_upload($file, $upload_type, $user_name = '') {
        // Check if file was uploaded
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return [
                'success' => false,
                'message' => 'No file uploaded or upload error occurred',
                'filename' => ''
            ];
        }
        
        // Validate file size
        if ($file['size'] > MAX_FILE_SIZE) {
            return [
                'success' => false,
                'message' => 'File size exceeds 5MB limit',
                'filename' => ''
            ];
        }
        
        // Validate file extension
        $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($file_extension, ALLOWED_EXTENSIONS)) {
            return [
                'success' => false,
                'message' => 'Only PDF, DOC, and DOCX files are allowed',
                'filename' => ''
            ];
        }
        
        // Validate MIME type for additional security
        $allowed_mimes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];
        
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!in_array($mime_type, $allowed_mimes)) {
            return [
                'success' => false,
                'message' => 'Invalid file type detected',
                'filename' => ''
            ];
        }
        
        // Determine upload directory
        $upload_dir = ($upload_type === 'career') ? CAREER_UPLOAD_DIR : ASSESSMENT_UPLOAD_DIR;
        
        // Generate secure filename
        $safe_name = self::sanitize_filename($user_name);
        $timestamp = date('Y-m-d_H-i-s');
        $random_string = bin2hex(random_bytes(4));
        $new_filename = $upload_type . '_' . $safe_name . '_' . $timestamp . '_' . $random_string . '.' . $file_extension;
        
        $upload_path = $upload_dir . $new_filename;
        
        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            // Set appropriate file permissions
            chmod($upload_path, 0644);
            
            // Log successful upload
            self::log_upload($new_filename, $upload_type, $safe_name);
            
            return [
                'success' => true,
                'message' => 'File uploaded successfully',
                'filename' => $new_filename
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to save uploaded file',
                'filename' => ''
            ];
        }
    }
    
    /**
     * Sanitize filename
     * @param string $filename
     * @return string
     */
    private static function sanitize_filename($filename) {
        // Remove special characters and spaces
        $filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename);
        // Limit length
        $filename = substr($filename, 0, 30);
        // Remove multiple underscores
        $filename = preg_replace('/_+/', '_', $filename);
        // Remove leading/trailing underscores
        $filename = trim($filename, '_');
        
        return $filename ?: 'user';
    }
    
    /**
     * Log file upload
     * @param string $filename
     * @param string $upload_type
     * @param string $user_name
     */
    private static function log_upload($filename, $upload_type, $user_name) {
        $log_entry = date('Y-m-d H:i:s') . " - File uploaded: $filename - Type: $upload_type - User: $user_name - IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
        file_put_contents('file_upload_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
    }
    
    /**
     * Get file information for email
     * @param array $upload_result
     * @return string
     */
    public static function get_file_info($upload_result) {
        if ($upload_result['success']) {
            return "File uploaded: " . $upload_result['filename'];
        } else {
            return "File upload failed: " . $upload_result['message'];
        }
    }
}
?>