<?php
require_once 'config.php';
requireLogin();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT image FROM projects WHERE id = $id");
    if ($row = mysqli_fetch_assoc($result)) {
        $imagePath = __DIR__ . '/uploads/' . $row['image'];
        $stmt = mysqli_prepare($conn, "DELETE FROM projects WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            if (file_exists($imagePath)) unlink($imagePath);
            $_SESSION['delete_success'] = "Projekti u fshi me sukses.";
        } else {
            $_SESSION['delete_error'] = "Gabim gjatë fshirjes: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['delete_error'] = "Projekti nuk u gjet.";
    }
} else {
    $_SESSION['delete_error'] = "ID e pavlefshme.";
}

header('Location: dashboard.php?page=gallery-view');
exit;