<?php
require_once 'config.php';

// If already logged in, go to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    if ($_POST['password'] === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Fjalëkalimi i gabuar!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Lala Painting</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0A192F 0%, #172A45 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 32px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-card h2 {
            color: #0A192F;
            margin-bottom: 8px;
            font-size: 2rem;
        }
        .login-card p {
            color: #8892B0;
            margin-bottom: 30px;
        }
        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #0A192F;
            font-weight: 500;
        }
        .input-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #ddd;
            border-radius: 40px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        .input-group input:focus {
            outline: none;
            border-color: #D4AF37;
            box-shadow: 0 0 0 3px rgba(212,175,55,0.2);
        }
        .btn-login {
            background: #0A192F;
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background: #172A45;
            transform: translateY(-2px);
        }
        .error {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 40px;
            margin-bottom: 20px;
        }
        .back-link {
            margin-top: 20px;
            display: block;
            color: #8892B0;
            text-decoration: none;
        }
        .back-link:hover {
            color: #D4AF37;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Lala Painting</h2>
        <p>Admin Panel</p>
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="input-group">
                <label>Fjalëkalimi</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-login">Hyr</button>
        </form>
        <a href="index.php" class="back-link">← Kthehu në faqen kryesore</a>
    </div>
</body>
</html>