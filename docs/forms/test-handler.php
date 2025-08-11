<?php
// Simple test handler for debugging mod_security issues

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'GET request received - form should use POST';
    exit();
}

echo '<h2>Form Submission Test Results</h2>';
echo '<p><strong>SUCCESS:</strong> PHP form handler is working!</p>';
echo '<p><strong>Server Time:</strong> ' . date('Y-m-d H:i:s') . '</p>';

if (isset($_POST['name'])) {
    echo '<p><strong>Name:</strong> ' . htmlspecialchars($_POST['name']) . '</p>';
}

if (isset($_POST['email'])) {
    echo '<p><strong>Email:</strong> ' . htmlspecialchars($_POST['email']) . '</p>';
}

echo '<p><a href="../test-form.html">← Back to Test Form</a></p>';
?>