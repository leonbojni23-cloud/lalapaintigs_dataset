<?php
require_once 'config.php';

// Redirect if not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = $_POST['category'];
    $image = $_FILES['image'];

    // Validation
    $errors = [];
    if (empty($title)) $errors[] = "Titulli është i detyrueshëm.";
    if (empty($description)) $errors[] = "Përshkrimi është i detyrueshëm.";
    if (empty($category)) $errors[] = "Kategoria është e detyrueshme.";
    if ($image['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Ngarkimi i imazhit dështoi.";
    } else {
        // Check file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $image['tmp_name']);
        finfo_close($finfo);
        if (!in_array($mime, $allowed_types)) {
            $errors[] = "Vetëm imazhe JPG, PNG, GIF, WEBP lejohen.";
        }
        // Check size (max 5MB)
        if ($image['size'] > 5 * 1024 * 1024) {
            $errors[] = "Madhësia e imazhit duhet të jetë nën 5MB.";
        }
    }

    if (!empty($errors)) {
        $_SESSION['upload_error'] = implode('<br>', $errors);
        header('Location: admin.php');
        exit;
    }

    // Generate unique filename
    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '_' . time() . '.' . $ext;
    $destination = __DIR__ . '/uploads/' . $filename;

    // Create uploads directory if not exists
    if (!is_dir(__DIR__ . '/uploads')) {
        mkdir(__DIR__ . '/uploads', 0755, true);
    }

    if (move_uploaded_file($image['tmp_name'], $destination)) {
        // Insert into database
        $stmt = mysqli_prepare($conn, "INSERT INTO projects (image, title, description, category) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $filename, $title, $description, $category);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['upload_success'] = "Projekti u shtua me sukses!";
        } else {
            $_SESSION['upload_error'] = "Gabim në bazën e të dhënave: " . mysqli_error($conn);
            // Delete uploaded file if DB fails
            unlink($destination);
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['upload_error'] = "Dështoi ruajtja e imazhit.";
    }

    header('Location: admin.php');
    exit;
} else {
    header('Location: admin.php');
    exit;
}
?>