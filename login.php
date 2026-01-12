<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMK TI Bali Global Denpasar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Background pattern */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(0, 212, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0, 212, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(0, 212, 255, 0.05) 0%, transparent 50%);
            z-index: 1;
        }

        /* Logo */
        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: url('https://smktibaliglobalsingaraja.sch.id/wp-content/uploads/2022/12/Logo-PNG-Tanpa-Tulisan-300x300.png') no-repeat center;
            background-size: 60px 60px;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #1a1a1a;
            font-weight: bold;
        }

        .logo-text {
            color: #ffffff;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .logo-subtitle {
            color: #cccccc;
            font-size: 14px;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: #ffffff;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #cccccc;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #cccccc;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .input-field {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            color: #ffffff;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: #00d4ff;
            background: rgba(255, 255, 255, 0.15);
        }

        .input-field::placeholder {
            color: #666666;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 212, 255, 0.4);
        }

        .login-btn:active {
            transform: translateY(1px);
        }

        .error-message {
            background: #dc3545;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        .success-message {
            background: #28a745;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666666;
            font-size: 12px;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                margin: 20px;
                padding: 30px 20px;
            }

            .logo {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }

            .logo-text {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <div class="logo"></div>
            <div class="logo-text">SMK TI Bali Global</div>
            <div class="logo-subtitle">Denpasar</div>
        </div>


        <?php if(isset($_SESSION['error'])): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="success-message">
                <i class="fas fa-check-circle"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="auth/login.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="input-field" placeholder="Masukkan email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="input-field" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="login-btn">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>

        <div class="footer">
            <p>&copy; 2024 SMK TI Bali Global Denpasar. All rights reserved.</p>
        </div>
    </div>
</body>
</html>