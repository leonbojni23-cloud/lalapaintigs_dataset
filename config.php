<?php
session_start();

// ============================================
// EDIT THESE WITH YOUR OWN DATABASE DETAILS
// ============================================
define('DB_HOST', 'sql201.infinityfree.com');
define('DB_USER', 'if0_41644537');
define('DB_PASS', 'SU8WciVlFvLIaWh');
define('DB_NAME', 'if0_41644537_lalapaintinngs_database');
// ============================================

// Admin password (change this)
define('ADMIN_PASSWORD', 'admin123');

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

// Check if user is logged in (for admin pages)
function requireLogin() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: admin.php');
        exit;
    }
}
?>