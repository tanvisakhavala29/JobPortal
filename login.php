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
    <div class="auth-container">
        <div class="auth-card">
            <h1 class="auth-title">JobPortal</h1>
            <div class="auth-switch" role="tablist">
                <button id="btn-login" class="active" type="button">Login</button>
                <button id="btn-signup" type="button">Sign up</button>
            </div>

            <div id="login-section">
                <form id="login-form" class="panel" style="margin-bottom:6px;">
                    <div class="form-row"><label for="login-email">Email</label><input id="login-email" type="email"
                            required></div>
                    <div class="form-row"><label for="login-password">Password</label><input id="login-password"
                            type="password" required></div>
                    <div class="auth-actions"><button type="submit">Login</button></div>
                </form>
            </div>

            <div id="signup-section" class="hidden">
                <form id="signup-form" class="panel">
                    <div class="form-row"><label for="signup-username">Full name</label><input id="signup-username"
                            type="text" required></div>
                    <div class="form-row"><label for="signup-email">Email</label><input id="signup-email" type="email"
                            required></div>
                    <div class="form-row"><label for="signup-password">Password</label><input id="signup-password"
                            type="password" required></div>
                    <div class="auth-actions"><button type="submit">Sign up</button></div>
                </form>
            </div>

            <p class="auth-note">By signing up you agree to the terms of use.</p>
        </div>
    </div>

    <script>
        // toggle login / signup views
        document.addEventListener('DOMContentLoaded', () => {
            const btnLogin = document.getElementById('btn-login');
            const btnSignup = document.getElementById('btn-signup');
            const loginSection = document.getElementById('login-section');
            const signupSection = document.getElementById('signup-section');

            if (btnLogin && btnSignup) {
                btnLogin.addEventListener('click', () => {
                    btnLogin.classList.add('active'); btnSignup.classList.remove('active');
                    loginSection.classList.remove('hidden'); signupSection.classList.add('hidden');
                });
                btnSignup.addEventListener('click', () => {
                    btnSignup.classList.add('active'); btnLogin.classList.remove('active');
                    signupSection.classList.remove('hidden'); loginSection.classList.add('hidden');
                });
            }
        });
    </script>
</body>

</html>