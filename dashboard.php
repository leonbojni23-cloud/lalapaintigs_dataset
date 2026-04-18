<?php
require_once 'config.php';
requireLogin();

// Determine which page to show
$page = $_GET['page'] ?? 'dashboard';

// Fetch stats for dashboard
$totalProjects = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM projects"))['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Lala Painting</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="admin-assets/admin.css">
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-paint-brush"></i> Lala<span>Admin</span></h2>
                <button class="sidebar-close" id="sidebarClose"><i class="fas fa-times"></i></button>
            </div>
            <ul class="sidebar-menu">
                <li class="<?php echo $page == 'dashboard' ? 'active' : ''; ?>">
                    <a href="dashboard.php?page=dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="menu-group">Galeria</li>
                <li class="<?php echo $page == 'gallery-view' ? 'active' : ''; ?>">
                    <a href="dashboard.php?page=gallery-view"><i class="fas fa-images"></i> Shiko Projektet</a>
                </li>
                <li class="<?php echo $page == 'gallery-add' ? 'active' : ''; ?>">
                    <a href="dashboard.php?page=gallery-add"><i class="fas fa-plus-circle"></i> Shto Projekt</a>
                </li>
                <li class="menu-group">Përmbajtja</li>
                <li class="<?php echo $page == 'content-home' ? 'active' : ''; ?>">
                    <a href="dashboard.php?page=content-home"><i class="fas fa-home"></i> Teksti Homepage</a>
                </li>
                <li class="<?php echo $page == 'content-about' ? 'active' : ''; ?>">
                    <a href="dashboard.php?page=content-about"><i class="fas fa-info-circle"></i> Seksioni Rreth Nesh</a>
                </li>
                <li class="<?php echo $page == 'content-services' ? 'active' : ''; ?>">
                    <a href="dashboard.php?page=content-services"><i class="fas fa-paint-roller"></i> Shërbimet</a>
                </li>
                <li class="menu-group">Cilësimet</li>
                <li class="<?php echo $page == 'settings-password' ? 'active' : ''; ?>">
                    <a href="dashboard.php?page=settings-password"><i class="fas fa-key"></i> Ndrysho Fjalëkalimin</a>
                </li>
                <li class="<?php echo $page == 'settings-general' ? 'active' : ''; ?>">
                    <a href="dashboard.php?page=settings-general"><i class="fas fa-cog"></i> Cilësimet e Përgjithshme</a>
                </li>
                <li class="menu-group"></li>
                <li>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Dilni</a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <header class="top-bar">
                <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                <h1>
                    <?php
                    $titles = [
                        'dashboard' => 'Dashboard',
                        'gallery-view' => 'Shiko Projektet',
                        'gallery-add' => 'Shto Projekt të Ri',
                        'content-home' => 'Modifiko Tekstin e Homepage',
                        'content-about' => 'Modifiko Seksionin Rreth Nesh',
                        'content-services' => 'Modifiko Shërbimet',
                        'settings-password' => 'Ndrysho Fjalëkalimin',
                        'settings-general' => 'Cilësimet e Përgjithshme'
                    ];
                    echo $titles[$page] ?? 'Dashboard';
                    ?>
                </h1>
                <div class="user-menu">
                    <span><i class="fas fa-user-circle"></i> Admin</span>
                    <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </header>

            <!-- Dynamic Content Area -->
            <div class="content-area">
                <?php
                // Include the requested page
                $allowed_pages = ['dashboard', 'gallery-view', 'gallery-add', 'content-home', 'content-about', 'content-services', 'settings-password', 'settings-general'];
                if (in_array($page, $allowed_pages)) {
                    include "admin-pages/{$page}.php";
                } else {
                    echo "<div class='card'><p>Faqja nuk u gjet.</p></div>";
                }
                ?>
            </div>
        </main>
    </div>

    <!-- Overlay for mobile sidebar -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <script src="admin-assets/admin.js"></script>
</body>
</html>