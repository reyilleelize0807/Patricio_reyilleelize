<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Rajdhani', sans-serif; }

        /* exact same purple color scheme as your register.php */
        body.bg-theme { background-color: #0a0118; }

        .panel {
        background: #1a0b2e;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 20px 40px rgba(24,4,30,0.45);
        width: 100%;
        max-width: 420px;
        border: 1px solid #a855f7;
        }

        h1 {
        color: #a855f7;
        font-size: 1.9rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 1.25rem;
        letter-spacing: .6px;
        }

        .field {
        width: 100%;
        background: #0a0118;
        border: 1px solid #4b2a56;
        color: #f3e8ff;
        padding: 12px 14px;
        border-radius: 0.5rem;
        margin-bottom: 0.9rem;
        transition: box-shadow .18s ease, border-color .18s ease;
        }

        .field::placeholder { color: #9f86c9; }

        .field:focus {
        outline: none;
        border-color: #a855f7;
        box-shadow: 0 0 8px #a855f7;
        background: #0a0118;
        }

        .relative { position: relative; }

        .show-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: #a855f7;
        font-weight: 700;
        cursor: pointer;
        }

        .submit {
        width: 100%;
        padding: 12px;
        background: #a855f7;
        color: #fff;
        font-weight: 700;
        border-radius: 0.5rem;
        border: none;
        cursor: pointer;
        transition: background .18s ease, transform .12s ease, box-shadow .12s ease;
        letter-spacing: .8px;
        }

        .submit:hover {
        background: #9333ea;
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(168,85,247,0.18);
        }

        p.hint {
        color: #bda4e8;
        text-align: center;
        margin-top: 0.9rem;
        }
        p.hint a { color: #a855f7; font-weight: 600; text-decoration: none; }
        p.hint a:hover { color: #c084fc; text-decoration: underline; }

        @media (max-width:420px){
        .panel { padding: 1.25rem; border-radius: 0.75rem; max-width: 360px; }
        h1 { font-size: 1.5rem; }
        }
    </style>
    </head>
    <body class="bg-theme flex items-center justify-center min-h-screen">

    <div class="panel" role="region" aria-label="Login form">
        <h1>LOGIN</h1>

        <!-- keep all PHP/form logic unchanged -->
        <form method="post" class="space-y-4">
        <input type="text" name="username" placeholder="Username" required class="field">

        <div class="relative">
            <input type="password" id="login-password" name="password" placeholder="Password" required class="field pr-16">
            <button type="button" onclick="togglePassword('login-password', this)" class="show-btn">Show</button>
        </div>

        <button type="submit" class="submit">LOGIN</button>
        </form>

        <p class="hint">Don't have an account? <a href="<?= site_url('/') ?>">Register</a></p>
    </div>

    <script>
        function togglePassword(id, btn) {
        const input = document.getElementById(id);
        if (!input) return;
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = 'Hide';
        } else {
            input.type = 'password';
            btn.textContent = 'Show';
        }
        }
    </script>
</body>
</html>
