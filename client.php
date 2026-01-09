<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Jobs - JobPortal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <script>
        // Ensure user is logged in and not admin
        (function () {
            try {
                const u = JSON.parse(localStorage.getItem('jobportal_current_user') || 'null');
                if (!u) { window.location = 'login.php'; return; }
                if (u.isAdmin) { window.location = 'admin.php'; return; }
            } catch (e) { window.location = 'login.php'; }
        })();
    </script>
</head>

<body class="h-full overflow-auto">
    <!-- Client-only UI (taken from job.php) -->
    <div id="client-page" class="w-full min-h-full">
        <header id="client-header" class="w-full shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-center sm:text-left">
                        <h1 id="portal-title" class="font-bold mb-1">Campus Career Connect</h1>
                        <p id="portal-tagline" class="opacity-80">Your Gateway to Career Opportunities</p>
                    </div>
                    <button id="client-logout-btn" class="px-6 py-2.5 rounded-lg font-medium transition-colors"> Logout
                    </button>
                </div>
            </div>
        </header>
        <main class="w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 id="jobs-heading" class="font-bold">Available Positions</h2>
                    <select id="client-job-filter"
                        class="px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2">
                        <option value="all">All Types</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Internship">Internship</option>
                        <option value="Contract">Contract</option>
                    </select>
                </div>
                <div id="client-jobs-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
                <div id="client-no-jobs" class="text-center py-16 hidden">
                    <div class="text-6xl mb-4">💼</div>
                    <h3 class="font-bold mb-2">No Jobs Available</h3>
                    <p>Check back later for new opportunities!</p>
                </div>
            </div>
        </main>
    </div>

    <!-- Apply Modal -->
    <div id="apply-modal" class="modal">
        <div class="modal-content">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h2 class="font-bold">Apply for Position</h2>
                    <button id="close-apply-modal" class="text-2xl leading-none hover:opacity-70">×</button>
                </div>
                <p id="apply-job-title" class="mt-2 opacity-70"></p>
            </div>
            <form id="apply-form" class="p-6">
                <div class="space-y-4">
                    <div><label for="applicant-name" class="block font-medium mb-1">Full Name</label>
                        <input type="text" id="applicant-name" required
                            class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                            placeholder="John Doe">
                    </div>
                    <div><label for="applicant-email" class="block font-medium mb-1">Email Address</label>
                        <input type="email" id="applicant-email" required
                            class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                            placeholder="john@example.com">
                    </div>
                    <div><label for="applicant-phone" class="block font-medium mb-1">Phone Number</label>
                        <input type="tel" id="applicant-phone" required
                            class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                            placeholder="+1 (555) 000-0000">
                    </div>
                    <div><label for="applicant-resume" class="block font-medium mb-1">Resume/CV Link</label>
                        <input type="url" id="applicant-resume" required
                            class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                            placeholder="https://linkedin.com/in/yourprofile">
                    </div>
                </div>
                <div class="flex gap-3 mt-6"><button type="submit" id="submit-application-btn"
                        class="flex-1 px-6 py-3 rounded-lg font-medium transition-colors"> Submit Application </button>
                    <button type="button" id="cancel-apply-btn"
                        class="px-6 py-3 rounded-lg font-medium transition-colors border-2"> Cancel </button>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/data_sdk.js"></script>
    <script src="assets/js/element_sdk.js"></script>
    <script src="assets/js/auth.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>