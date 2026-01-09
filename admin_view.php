<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin - JobPortal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <script>
        // Ensure user is admin
        (function () {
            try {
                const u = JSON.parse(localStorage.getItem('jobportal_current_user') || 'null');
                if (!u) { window.location = 'login.php'; return; }
                if (!u.isAdmin) { window.location = 'index.php'; return; }
            } catch (e) { window.location = 'login.php'; }
        })();
    </script>
</head>

<body class="h-full overflow-auto">
    <!-- Admin-only UI (taken from job.php) -->
    <div id="admin-page" class="w-full min-h-full">
        <header id="admin-header" class="w-full shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 id="admin-welcome" class="font-bold">Admin Dashboard</h1>
                        <p id="admin-subtitle" class="text-sm opacity-70">Manage your job portal</p>
                    </div>
                    <button id="admin-logout-btn" class="px-4 py-2 rounded-lg font-medium transition-colors"> Logout
                    </button>
                </div>
            </div>
        </header>
        <main class="w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="stat-card bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-70 mb-1">Total Jobs</p>
                                <p id="stat-jobs" class="text-3xl font-bold">0</p>
                            </div>
                            <div class="text-4xl">💼</div>
                        </div>
                    </div>
                    <div class="stat-card bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-70 mb-1">Applications</p>
                                <p id="stat-applications" class="text-3xl font-bold">0</p>
                            </div>
                            <div class="text-4xl">📋</div>
                        </div>
                    </div>
                    <div class="stat-card bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-70 mb-1">Registered Users</p>
                                <p id="stat-users" class="text-3xl font-bold">0</p>
                            </div>
                            <div class="text-4xl">👥</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md mb-6">
                    <div class="flex border-b" id="admin-tabs"><button class="tab-button active"
                            data-tab="jobs">Jobs</button> <button class="tab-button"
                            data-tab="applications">Applications</button> <button class="tab-button"
                            data-tab="users">Users</button></div>
                </div>

                <div id="admin-jobs-tab" class="tab-content">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Manage Jobs</h2><button id="admin-add-job-btn"
                            class="px-6 py-2.5 rounded-lg font-medium transition-colors shadow-sm"> + Add Job </button>
                    </div>
                    <div id="admin-jobs-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
                    <div id="admin-no-jobs" class="text-center py-16 hidden">
                        <div class="text-6xl mb-4">💼</div>
                        <h3 class="font-bold mb-2">No Jobs Posted</h3>
                        <p>Click "Add Job" to create your first job posting.</p>
                    </div>
                </div>

                <div id="admin-applications-tab" class="tab-content hidden">
                    <h2 class="text-2xl font-bold mb-6">All Applications</h2>
                    <div id="admin-applications-container" class="space-y-4"></div>
                    <div id="admin-no-applications" class="text-center py-16 hidden">
                        <div class="text-6xl mb-4">📋</div>
                        <h3 class="font-bold mb-2">No Applications</h3>
                        <p>Applications will appear here once candidates apply.</p>
                    </div>
                </div>

                <div id="admin-users-tab" class="tab-content hidden">
                    <h2 class="text-2xl font-bold mb-6">Registered Users</h2>
                    <div id="admin-users-container" class="space-y-4"></div>
                    <div id="admin-no-users" class="text-center py-16 hidden">
                        <div class="text-6xl mb-4">👥</div>
                        <h3 class="font-bold mb-2">No Users</h3>
                        <p>User registrations will appear here.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Job Modal -->
    <div id="job-modal" class="modal">
        <div class="modal-content">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h2 id="job-modal-title" class="font-bold">Add New Job</h2><button id="close-job-modal"
                        class="text-2xl leading-none hover:opacity-70">×</button>
                </div>
            </div>
            <form id="job-form" class="p-6">
                <div class="space-y-4">
                    <div><label for="job-title" class="block font-medium mb-1">Job Title</label> <input type="text"
                            id="job-title" required
                            class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                            placeholder="e.g., Software Engineer"></div>
                    <div><label for="company-name" class="block font-medium mb-1">Company Name</label> <input
                            type="text" id="company-name" required
                            class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                            placeholder="e.g., Tech Corp"></div>
                    <div class="grid grid-cols-2 gap-4">
                        <div><label for="location" class="block font-medium mb-1">Location</label> <input type="text"
                                id="location" required
                                class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="e.g., Remote"></div>
                        <div><label for="job-type" class="block font-medium mb-1">Job Type</label> <select id="job-type"
                                required class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2">
                                <option value="">Select type</option>
                                <option value="Full-time">Full-time</option>
                                <option value="Part-time">Part-time</option>
                                <option value="Internship">Internship</option>
                                <option value="Contract">Contract</option>
                            </select></div>
                    </div>
                    <div><label for="salary-range" class="block font-medium mb-1">Salary Range</label> <input
                            type="text" id="salary-range" required
                            class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                            placeholder="e.g., $60,000 - $80,000"></div>
                    <div><label for="description" class="block font-medium mb-1">Job Description</label> <textarea
                            id="description" required rows="4"
                            class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                            placeholder="Describe the role and responsibilities..."></textarea></div>
                    <div><label for="requirements" class="block font-medium mb-1">Requirements</label> <textarea
                            id="requirements" required rows="3"
                            class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                            placeholder="List required skills and qualifications..."></textarea></div>
                </div>
                <div class="flex gap-3 mt-6"><button type="submit" id="submit-job-btn"
                        class="flex-1 px-6 py-3 rounded-lg font-medium transition-colors"> Save Job </button> <button
                        type="button" id="cancel-job-btn"
                        class="px-6 py-3 rounded-lg font-medium transition-colors border-2"> Cancel </button></div>
            </form>
        </div>
    </div>

    <script src="assets/js/data_sdk.js"></script>
    <script src="assets/js/element_sdk.js"></script>
    <script src="assets/js/auth.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>