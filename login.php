<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login - JobPortal</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/data_sdk.js"></script>
    <script src="assets/js/auth.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loginForm = document.getElementById('login-form');
            const signupForm = document.getElementById('signup-form');

            if (loginForm) loginForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const email = document.getElementById('login-email').value;
                const password = document.getElementById('login-password').value;
                const r = await auth.login(email, password);
                if (r.ok) {
                    // redirect based on role
                    const u = auth.getCurrentUser();
                    if (u && u.isAdmin) window.location = 'admin.php'; else window.location = 'index.php';
                } else {
                    alert(r.message || 'Login failed');
                }
            });

            if (signupForm) signupForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const username = document.getElementById('signup-username').value;
                const email = document.getElementById('signup-email').value;
                const password = document.getElementById('signup-password').value;
                const r = await auth.signup(username, email, password);
                if (r.ok) {
                    window.location = 'index.php';
                } else {
                    alert(r.message || 'Signup failed');
                }
            });
        });
    </script>
</head>

<body>
    <div style="max-width:480px;margin:40px auto;padding:20px;">
        <h1>Login to JobPortal</h1>
        <form id="login-form" style="margin-bottom:20px;">
            <div><label>Email</label><input id="login-email" type="email" required></div>
            <div><label>Password</label><input id="login-password" type="password" required></div>
            <div><button type="submit">Login</button></div>
        </form>

        <hr>
        <h2>Sign up</h2>
        <form id="signup-form">
            <div><label>Full name</label><input id="signup-username" type="text" required></div>
            <div><label>Email</label><input id="signup-email" type="email" required></div>
            <div><label>Password</label><input id="signup-password" type="password" required></div>
            <div><button type="submit">Sign up</button></div>
        </form>
    </div>
</body>

</html>