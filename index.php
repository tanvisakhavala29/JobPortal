<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Index - JobPortal</title>
    <script>
        (function () {
            try {
                const u = JSON.parse(localStorage.getItem('jobportal_current_user') || 'null');
                if (!u) { window.location = 'login.php'; return; }
                if (u.isAdmin) { window.location = 'admin.php'; return; }
                // regular user -> show client app
                window.location = 'client.php';
            } catch (e) { window.location = 'login.php'; }
        })();
    </script>
</head>

<body></body>

</html>