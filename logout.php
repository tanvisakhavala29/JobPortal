<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Logging out...</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div style="max-width:720px;margin:80px auto;text-align:center;padding:20px;">
        <h2>Signing out…</h2>
        <p>If you are not redirected automatically, <a href="login.php">click here</a>.</p>
    </div>
    <script>
        try {
            if (window.auth && typeof window.auth.logout === 'function') window.auth.logout();
            else localStorage.removeItem('jobportal_current_user');
        } catch (e) { }
        // small delay for user to see message
        setTimeout(() => { window.location = 'login.php'; }, 200);
    </script>
</body>

</html>