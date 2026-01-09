<!doctype html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Career Connect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="h-full overflow-auto">
    <div id="app" class="w-full min-h-full"><!-- Login Page -->
        <div id="login-page" class="w-full min-h-full flex items-center justify-center p-4">
            <div class="w-full max-w-md">
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="text-center mb-8">
                        <div class="text-5xl mb-4">
                            🎓
                        </div>
                        <h1 id="login-title" class="font-bold mb-2">Welcome Back</h1>
                        <p id="login-subtitle" class="opacity-70">Sign in to access the job portal</p>
                    </div>
                    <form id="login-form" class="space-y-4">
                        <div><label for="login-username" class="block font-medium mb-2">Username</label> <input
                                type="text" id="login-username" required
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="Enter your username">
                        </div>
                        <div><label for="login-email" class="block font-medium mb-2">Email</label> <input type="email"
                                id="login-email" required
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="Enter your email">
                        </div>
                        <div><label for="login-password" class="block font-medium mb-2">Password</label> <input
                                type="password" id="login-password" required
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="Enter your password">
                        </div><button type="submit" id="login-btn"
                            class="w-full py-3 rounded-lg font-semibold transition-colors shadow-lg"> Sign In </button>
                    </form>
                </div>
            </div>
        </div><!-- Admin Dashboard -->
        <div id="admin-page" class="w-full min-h-full hidden">
            <header id="admin-header" class="w-full shadow-md">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 id="admin-welcome" class="font-bold">Admin Dashboard</h1>
                            <p id="admin-subtitle" class="text-sm opacity-70">Manage your job portal</p>
                        </div><button id="admin-logout-btn" class="px-4 py-2 rounded-lg font-medium transition-colors">
                            Logout </button>
                    </div>
                </div>
            </header>
            <main class="w-full">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"><!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="stat-card bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm opacity-70 mb-1">Total Jobs</p>
                                    <p id="stat-jobs" class="text-3xl font-bold">0</p>
                                </div>
                                <div class="text-4xl">
                                    💼
                                </div>
                            </div>
                        </div>
                        <div class="stat-card bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm opacity-70 mb-1">Applications</p>
                                    <p id="stat-applications" class="text-3xl font-bold">0</p>
                                </div>
                                <div class="text-4xl">
                                    📋
                                </div>
                            </div>
                        </div>
                        <div class="stat-card bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm opacity-70 mb-1">Registered Users</p>
                                    <p id="stat-users" class="text-3xl font-bold">0</p>
                                </div>
                                <div class="text-4xl">
                                    👥
                                </div>
                            </div>
                        </div>
                    </div><!-- Tabs -->
                    <div class="bg-white rounded-lg shadow-md mb-6">
                        <div class="flex border-b" id="admin-tabs"><button class="tab-button active"
                                data-tab="jobs">Jobs</button> <button class="tab-button"
                                data-tab="applications">Applications</button> <button class="tab-button"
                                data-tab="users">Users</button>
                        </div>
                    </div><!-- Jobs Tab -->
                    <div id="admin-jobs-tab" class="tab-content">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold">Manage Jobs</h2><button id="admin-add-job-btn"
                                class="px-6 py-2.5 rounded-lg font-medium transition-colors shadow-sm"> + Add Job
                            </button>
                        </div>
                        <div id="admin-jobs-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        </div>
                        <div id="admin-no-jobs" class="text-center py-16 hidden">
                            <div class="text-6xl mb-4">
                                💼
                            </div>
                            <h3 class="font-bold mb-2">No Jobs Posted</h3>
                            <p>Click "Add Job" to create your first job posting.</p>
                        </div>
                    </div><!-- Applications Tab -->
                    <div id="admin-applications-tab" class="tab-content hidden">
                        <h2 class="text-2xl font-bold mb-6">All Applications</h2>
                        <div id="admin-applications-container" class="space-y-4"></div>
                        <div id="admin-no-applications" class="text-center py-16 hidden">
                            <div class="text-6xl mb-4">
                                📋
                            </div>
                            <h3 class="font-bold mb-2">No Applications</h3>
                            <p>Applications will appear here once candidates apply.</p>
                        </div>
                    </div><!-- Users Tab -->
                    <div id="admin-users-tab" class="tab-content hidden">
                        <h2 class="text-2xl font-bold mb-6">Registered Users</h2>
                        <div id="admin-users-container" class="space-y-4"></div>
                        <div id="admin-no-users" class="text-center py-16 hidden">
                            <div class="text-6xl mb-4">
                                👥
                            </div>
                            <h3 class="font-bold mb-2">No Users</h3>
                            <p>User registrations will appear here.</p>
                        </div>
                    </div>
                </div>
            </main>
        </div><!-- Client Page -->
        <div id="client-page" class="w-full min-h-full hidden">
            <header id="client-header" class="w-full shadow-md">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-center sm:text-left">
                            <h1 id="portal-title" class="font-bold mb-1">Campus Career Connect</h1>
                            <p id="portal-tagline" class="opacity-80">Your Gateway to Career Opportunities</p>
                        </div><button id="client-logout-btn"
                            class="px-6 py-2.5 rounded-lg font-medium transition-colors"> Logout </button>
                    </div>
                </div>
            </header>
            <main class="w-full">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 id="jobs-heading" class="font-bold">Available Positions</h2><select id="client-job-filter"
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
                        <div class="text-6xl mb-4">
                            💼
                        </div>
                        <h3 class="font-bold mb-2">No Jobs Available</h3>
                        <p>Check back later for new opportunities!</p>
                    </div>
                </div>
            </main>
        </div><!-- Post/Edit Job Modal -->
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
                                placeholder="e.g., Software Engineer">
                        </div>
                        <div><label for="company-name" class="block font-medium mb-1">Company Name</label> <input
                                type="text" id="company-name" required
                                class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="e.g., Tech Corp">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div><label for="location" class="block font-medium mb-1">Location</label> <input
                                    type="text" id="location" required
                                    class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                                    placeholder="e.g., Remote">
                            </div>
                            <div><label for="job-type" class="block font-medium mb-1">Job Type</label> <select
                                    id="job-type" required
                                    class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2">
                                    <option value="">Select type</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Internship">Internship</option>
                                    <option value="Contract">Contract</option>
                                </select>
                            </div>
                        </div>
                        <div><label for="salary-range" class="block font-medium mb-1">Salary Range</label> <input
                                type="text" id="salary-range" required
                                class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="e.g., $60,000 - $80,000">
                        </div>
                        <div><label for="description" class="block font-medium mb-1">Job Description</label> <textarea
                                id="description" required rows="4"
                                class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="Describe the role and responsibilities..."></textarea>
                        </div>
                        <div><label for="requirements" class="block font-medium mb-1">Requirements</label> <textarea
                                id="requirements" required rows="3"
                                class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="List required skills and qualifications..."></textarea>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-6"><button type="submit" id="submit-job-btn"
                            class="flex-1 px-6 py-3 rounded-lg font-medium transition-colors"> Save Job </button>
                        <button type="button" id="cancel-job-btn"
                            class="px-6 py-3 rounded-lg font-medium transition-colors border-2"> Cancel </button>
                    </div>
                </form>
            </div>
        </div><!-- Apply Modal -->
        <div id="apply-modal" class="modal">
            <div class="modal-content">
                <div class="p-6 border-b">
                    <div class="flex justify-between items-center">
                        <h2 class="font-bold">Apply for Position</h2><button id="close-apply-modal"
                            class="text-2xl leading-none hover:opacity-70">×</button>
                    </div>
                    <p id="apply-job-title" class="mt-2 opacity-70"></p>
                </div>
                <form id="apply-form" class="p-6">
                    <div class="space-y-4">
                        <div><label for="applicant-name" class="block font-medium mb-1">Full Name</label> <input
                                type="text" id="applicant-name" required
                                class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="John Doe">
                        </div>
                        <div><label for="applicant-email" class="block font-medium mb-1">Email Address</label> <input
                                type="email" id="applicant-email" required
                                class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="john@example.com">
                        </div>
                        <div><label for="applicant-phone" class="block font-medium mb-1">Phone Number</label> <input
                                type="tel" id="applicant-phone" required
                                class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="+1 (555) 000-0000">
                        </div>
                        <div><label for="applicant-resume" class="block font-medium mb-1">Resume/CV Link</label> <input
                                type="url" id="applicant-resume" required
                                class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="https://linkedin.com/in/yourprofile">
                        </div>
                    </div>
                    <div class="flex gap-3 mt-6"><button type="submit" id="submit-application-btn"
                            class="flex-1 px-6 py-3 rounded-lg font-medium transition-colors"> Submit Application
                        </button> <button type="button" id="cancel-apply-btn"
                            class="px-6 py-3 rounded-lg font-medium transition-colors border-2"> Cancel </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const defaultConfig = {
            background_color: "#f0f4f8",
            header_color: "#ffffff",
            primary_action_color: "#3b82f6",
            secondary_action_color: "#ffffff",
            text_color: "#1f2937",
            font_family: "Inter",
            font_size: 16,
            portal_title: "Campus Career Connect",
            portal_tagline: "Your Gateway to Career Opportunities",
            login_title: "Welcome Back",
            admin_welcome: "Admin Dashboard"
        };

        let allJobs = [];
        let allApplications = [];
        let allUsers = [];
        let currentJobId = null;
        let currentUser = null;
        let isAdmin = false;
        let recordCount = 0;
        let editingJob = null;

        const ADMIN_CREDENTIALS = {
            username: "Tanvi Sakhavala",
            email: "tanvisakhaval@gmail.com",
            password: "2809"
        };

        const dataHandler = {
            onDataChanged(data) {
                recordCount = data.length;

                allJobs = data.filter(record => record.job_title && !record.applicant_name && !record.user_email);
                allApplications = data.filter(record => record.applicant_name && record.job_id);
                allUsers = data.filter(record => record.user_email && record.user_name && !record.job_title);

                if (isAdmin) {
                    updateAdminStats();
                    renderAdminJobs();
                    renderAdminApplications();
                    renderAdminUsers();
                } else {
                    renderClientJobs();
                }
            }
        };

        async function initializeApp() {
            const dataResult = await window.dataSdk.init(dataHandler);
            if (!dataResult.isOk) {
                showToast('Failed to initialize data storage', 'error');
                return;
            }

            if (window.elementSdk) {
                window.elementSdk.init({
                    defaultConfig,
                    onConfigChange: async (config) => {
                        applyStyles(config);
                    },
                    mapToCapabilities: (config) => ({
                        recolorables: [
                            {
                                get: () => config.background_color || defaultConfig.background_color,
                                set: (value) => {
                                    if (window.elementSdk && window.elementSdk.config) {
                                        window.elementSdk.config.background_color = value;
                                        window.elementSdk.setConfig({ background_color: value });
                                    }
                                }
                            },
                            {
                                get: () => config.header_color || defaultConfig.header_color,
                                set: (value) => {
                                    if (window.elementSdk && window.elementSdk.config) {
                                        window.elementSdk.config.header_color = value;
                                        window.elementSdk.setConfig({ header_color: value });
                                    }
                                }
                            },
                            {
                                get: () => config.text_color || defaultConfig.text_color,
                                set: (value) => {
                                    if (window.elementSdk && window.elementSdk.config) {
                                        window.elementSdk.config.text_color = value;
                                        window.elementSdk.setConfig({ text_color: value });
                                    }
                                }
                            },
                            {
                                get: () => config.primary_action_color || defaultConfig.primary_action_color,
                                set: (value) => {
                                    if (window.elementSdk && window.elementSdk.config) {
                                        window.elementSdk.config.primary_action_color = value;
                                        window.elementSdk.setConfig({ primary_action_color: value });
                                    }
                                }
                            },
                            {
                                get: () => config.secondary_action_color || defaultConfig.secondary_action_color,
                                set: (value) => {
                                    if (window.elementSdk && window.elementSdk.config) {
                                        window.elementSdk.config.secondary_action_color = value;
                                        window.elementSdk.setConfig({ secondary_action_color: value });
                                    }
                                }
                            }
                        ],
                        borderables: [],
                        fontEditable: {
                            get: () => config.font_family || defaultConfig.font_family,
                            set: (value) => {
                                if (window.elementSdk && window.elementSdk.config) {
                                    window.elementSdk.config.font_family = value;
                                    window.elementSdk.setConfig({ font_family: value });
                                }
                            }
                        },
                        fontSizeable: {
                            get: () => config.font_size || defaultConfig.font_size,
                            set: (value) => {
                                if (window.elementSdk && window.elementSdk.config) {
                                    window.elementSdk.config.font_size = value;
                                    window.elementSdk.setConfig({ font_size: value });
                                }
                            }
                        }
                    }),
                    mapToEditPanelValues: (config) => new Map([
                        ["portal_title", config.portal_title || defaultConfig.portal_title],
                        ["portal_tagline", config.portal_tagline || defaultConfig.portal_tagline],
                        ["login_title", config.login_title || defaultConfig.login_title],
                        ["admin_welcome", config.admin_welcome || defaultConfig.admin_welcome]
                    ])
                });
            }
        }

        function applyStyles(config) {
            const customFont = config.font_family || defaultConfig.font_family;
            const baseFontStack = 'system-ui, -apple-system, sans-serif';
            const baseSize = config.font_size || defaultConfig.font_size;
            const bgColor = config.background_color || defaultConfig.background_color;
            const headerColor = config.header_color || defaultConfig.header_color;
            const textColor = config.text_color || defaultConfig.text_color;
            const primaryColor = config.primary_action_color || defaultConfig.primary_action_color;
            const secondaryColor = config.secondary_action_color || defaultConfig.secondary_action_color;

            document.body.style.fontFamily = `${customFont}, ${baseFontStack}`;
            document.body.style.fontSize = `${baseSize}px`;
            document.body.style.backgroundColor = bgColor;
            document.body.style.color = textColor;

            ['admin-header', 'client-header'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.backgroundColor = headerColor;
            });

            document.getElementById('login-title').textContent = config.login_title || defaultConfig.login_title;
            document.getElementById('login-title').style.fontSize = `${baseSize * 1.75}px`;
            document.getElementById('login-title').style.color = textColor;

            document.getElementById('portal-title').textContent = config.portal_title || defaultConfig.portal_title;
            document.getElementById('portal-title').style.fontSize = `${baseSize * 1.75}px`;
            document.getElementById('portal-title').style.color = textColor;

            document.getElementById('portal-tagline').textContent = config.portal_tagline || defaultConfig.portal_tagline;
            document.getElementById('portal-tagline').style.color = textColor;

            document.getElementById('admin-welcome').textContent = config.admin_welcome || defaultConfig.admin_welcome;
            document.getElementById('admin-welcome').style.fontSize = `${baseSize * 1.5}px`;
            document.getElementById('admin-welcome').style.color = textColor;

            ['login-btn', 'submit-job-btn', 'submit-application-btn', 'admin-add-job-btn'].forEach(id => {
                const btn = document.getElementById(id);
                if (btn) {
                    btn.style.backgroundColor = primaryColor;
                    btn.style.color = '#ffffff';
                }
            });

            ['admin-logout-btn', 'client-logout-btn'].forEach(id => {
                const btn = document.getElementById(id);
                if (btn) {
                    btn.style.backgroundColor = secondaryColor;
                    btn.style.borderColor = primaryColor;
                    btn.style.color = primaryColor;
                    btn.style.border = `2px solid ${primaryColor}`;
                }
            });

            document.querySelectorAll('.tab-button').forEach(tab => {
                tab.style.color = textColor;
                if (tab.classList.contains('active')) {
                    tab.style.color = primaryColor;
                }
            });

            if (isAdmin) {
                renderAdminJobs();
                renderAdminApplications();
                renderAdminUsers();
            } else if (currentUser) {
                renderClientJobs();
            }
        }

        async function handleLogin(e) {
            e.preventDefault();

            const username = document.getElementById('login-username').value;
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;

            if (username === ADMIN_CREDENTIALS.username &&
                email === ADMIN_CREDENTIALS.email &&
                password === ADMIN_CREDENTIALS.password) {
                isAdmin = true;
                currentUser = { username, email, isAdmin: true };
                showAdminPage();
                showToast('Welcome Admin!', 'success');
            } else {
                isAdmin = false;
                currentUser = { username, email, isAdmin: false };

                const existingUser = allUsers.find(u => u.user_email === email);
                if (!existingUser && recordCount < 999) {
                    await window.dataSdk.create({
                        user_email: email,
                        user_name: username,
                        registration_date: new Date().toISOString(),
                        job_title: "",
                        company_name: "",
                        location: "",
                        job_type: "",
                        salary_range: "",
                        description: "",
                        requirements: "",
                        posted_date: "",
                        applicant_name: "",
                        applicant_email: "",
                        applicant_phone: "",
                        applicant_resume: "",
                        application_date: "",
                        job_id: ""
                    });
                }

                showClientPage();
                showToast(`Welcome, ${username}!`, 'success');
            }

            document.getElementById('login-form').reset();
        }

        function showAdminPage() {
            document.getElementById('login-page').classList.add('hidden');
            document.getElementById('client-page').classList.add('hidden');
            document.getElementById('admin-page').classList.remove('hidden');
            updateAdminStats();
        }

        function showClientPage() {
            document.getElementById('login-page').classList.add('hidden');
            document.getElementById('admin-page').classList.add('hidden');
            document.getElementById('client-page').classList.remove('hidden');
        }

        function showLoginPage() {
            document.getElementById('admin-page').classList.add('hidden');
            document.getElementById('client-page').classList.add('hidden');
            document.getElementById('login-page').classList.remove('hidden');
            currentUser = null;
            isAdmin = false;
        }

        function updateAdminStats() {
            document.getElementById('stat-jobs').textContent = allJobs.length;
            document.getElementById('stat-applications').textContent = allApplications.length;
            document.getElementById('stat-users').textContent = allUsers.length;
        }

        function renderAdminJobs() {
            const container = document.getElementById('admin-jobs-container');
            const noJobsDiv = document.getElementById('admin-no-jobs');

            if (allJobs.length === 0) {
                container.innerHTML = '';
                noJobsDiv.classList.remove('hidden');
                return;
            }

            noJobsDiv.classList.add('hidden');
            container.innerHTML = allJobs.map(job => createAdminJobCard(job)).join('');

            allJobs.forEach(job => {
                document.getElementById(`edit-${job.__backendId}`).addEventListener('click', () => openEditJobModal(job));
                document.getElementById(`delete-${job.__backendId}`).addEventListener('click', () => deleteJob(job));
            });
        }

        function createAdminJobCard(job) {
            const config = window.elementSdk?.config || defaultConfig;
            const baseSize = config.font_size || defaultConfig.font_size;
            const textColor = config.text_color || defaultConfig.text_color;
            const primaryColor = config.primary_action_color || defaultConfig.primary_action_color;

            return `
        <div class="job-card bg-white rounded-lg shadow-md p-6 border-2">
          <div class="flex justify-between items-start mb-3">
            <h3 class="font-bold" style="font-size: ${baseSize * 1.15}px; color: ${textColor};">${job.job_title}</h3>
            <span class="px-3 py-1 rounded-full text-xs font-medium" style="background-color: ${primaryColor}20; color: ${primaryColor};">${job.job_type}</span>
          </div>
          <p class="font-semibold mb-2" style="font-size: ${baseSize * 0.95}px; color: ${textColor};">${job.company_name}</p>
          <div class="flex items-center gap-3 mb-3 text-sm" style="color: ${textColor};">
            <span>📍 ${job.location}</span>
            <span>💰 ${job.salary_range}</span>
          </div>
          <div class="flex gap-2 mt-4">
            <button id="edit-${job.__backendId}" class="flex-1 px-4 py-2 rounded-lg font-medium transition-colors" style="background-color: ${primaryColor}; color: #ffffff;">
              Edit
            </button>
            <button id="delete-${job.__backendId}" class="px-4 py-2 rounded-lg font-medium transition-colors" style="background-color: #fee; color: #ef4444;">
              Delete
            </button>
          </div>
        </div>
      `;
        }

        function renderAdminApplications() {
            const container = document.getElementById('admin-applications-container');
            const noAppsDiv = document.getElementById('admin-no-applications');

            if (allApplications.length === 0) {
                container.innerHTML = '';
                noAppsDiv.classList.remove('hidden');
                return;
            }

            noAppsDiv.classList.add('hidden');
            container.innerHTML = allApplications.map(app => createAdminApplicationCard(app)).join('');

            allApplications.forEach(app => {
                document.getElementById(`delete-app-${app.__backendId}`).addEventListener('click', () => deleteApplication(app));
            });
        }

        function createAdminApplicationCard(app) {
            const job = allJobs.find(j => j.__backendId === app.job_id);
            const config = window.elementSdk?.config || defaultConfig;
            const baseSize = config.font_size || defaultConfig.font_size;
            const textColor = config.text_color || defaultConfig.text_color;
            const primaryColor = config.primary_action_color || defaultConfig.primary_action_color;

            return `
        <div class="bg-white rounded-lg shadow-md p-6 border-2">
          <div class="flex justify-between items-start mb-4">
            <div>
              <h3 class="font-bold mb-1" style="font-size: ${baseSize * 1.15}px; color: ${textColor};">${app.applicant_name}</h3>
              <p class="font-medium" style="color: ${textColor};">Applied for: ${job ? job.job_title : 'Deleted Position'}</p>
            </div>
            <button id="delete-app-${app.__backendId}" class="px-3 py-1 rounded-lg text-sm font-medium" style="background-color: #fee; color: #ef4444;">
              Delete
            </button>
          </div>
          <div class="space-y-2 text-sm" style="color: ${textColor};">
            <p>📧 ${app.applicant_email}</p>
            <p>📱 ${app.applicant_phone}</p>
            <p>📄 <a href="${app.applicant_resume}" target="_blank" rel="noopener noreferrer" class="underline" style="color: ${primaryColor};">View Resume</a></p>
            <p class="opacity-60">Applied: ${new Date(app.application_date).toLocaleDateString()}</p>
          </div>
        </div>
      `;
        }

        function renderAdminUsers() {
            const container = document.getElementById('admin-users-container');
            const noUsersDiv = document.getElementById('admin-no-users');

            if (allUsers.length === 0) {
                container.innerHTML = '';
                noUsersDiv.classList.remove('hidden');
                return;
            }

            noUsersDiv.classList.add('hidden');
            const config = window.elementSdk?.config || defaultConfig;
            const baseSize = config.font_size || defaultConfig.font_size;
            const textColor = config.text_color || defaultConfig.text_color;

            container.innerHTML = allUsers.map(user => `
        <div class="bg-white rounded-lg shadow-md p-6 border-2">
          <h3 class="font-bold mb-2" style="font-size: ${baseSize * 1.1}px; color: ${textColor};">👤 ${user.user_name}</h3>
          <p style="color: ${textColor};">📧 ${user.user_email}</p>
          <p class="text-sm opacity-60 mt-2" style="color: ${textColor};">Registered: ${new Date(user.registration_date).toLocaleDateString()}</p>
        </div>
      `).join('');
        }

        function renderClientJobs() {
            const container = document.getElementById('client-jobs-container');
            const noJobsDiv = document.getElementById('client-no-jobs');
            const filter = document.getElementById('client-job-filter').value;

            const filteredJobs = filter === 'all' ? allJobs : allJobs.filter(job => job.job_type === filter);

            if (filteredJobs.length === 0) {
                container.innerHTML = '';
                noJobsDiv.classList.remove('hidden');
                return;
            }

            noJobsDiv.classList.add('hidden');
            container.innerHTML = filteredJobs.map(job => createClientJobCard(job)).join('');

            filteredJobs.forEach(job => {
                document.getElementById(`apply-${job.__backendId}`).addEventListener('click', () => openApplyModal(job));
            });
        }

        function createClientJobCard(job) {
            const config = window.elementSdk?.config || defaultConfig;
            const baseSize = config.font_size || defaultConfig.font_size;
            const textColor = config.text_color || defaultConfig.text_color;
            const primaryColor = config.primary_action_color || defaultConfig.primary_action_color;

            return `
        <div class="job-card bg-white rounded-lg shadow-md p-6 border-2 border-transparent hover:border-blue-200">
          <div class="flex justify-between items-start mb-3">
            <h3 class="font-bold" style="font-size: ${baseSize * 1.25}px; color: ${textColor};">${job.job_title}</h3>
            <span class="px-3 py-1 rounded-full text-xs font-medium" style="background-color: ${primaryColor}20; color: ${primaryColor};">${job.job_type}</span>
          </div>
          <p class="font-semibold mb-2" style="font-size: ${baseSize * 0.95}px; color: ${textColor};">${job.company_name}</p>
          <div class="flex items-center gap-4 mb-3" style="font-size: ${baseSize * 0.85}px; color: ${textColor};">
            <span>📍 ${job.location}</span>
            <span>💰 ${job.salary_range}</span>
          </div>
          <p class="mb-4" style="font-size: ${baseSize * 0.85}px; color: ${textColor};">${job.description}</p>
          <button id="apply-${job.__backendId}" class="w-full px-4 py-2 rounded-lg font-medium transition-colors" style="background-color: ${primaryColor}; color: #ffffff; font-size: ${baseSize * 0.9}px;">
            Apply Now
          </button>
        </div>
      `;
        }

        function openAddJobModal() {
            editingJob = null;
            document.getElementById('job-modal-title').textContent = 'Add New Job';
            document.getElementById('job-form').reset();
            document.getElementById('job-modal').classList.add('active');
        }

        function openEditJobModal(job) {
            editingJob = job;
            document.getElementById('job-modal-title').textContent = 'Edit Job';
            document.getElementById('job-title').value = job.job_title;
            document.getElementById('company-name').value = job.company_name;
            document.getElementById('location').value = job.location;
            document.getElementById('job-type').value = job.job_type;
            document.getElementById('salary-range').value = job.salary_range;
            document.getElementById('description').value = job.description;
            document.getElementById('requirements').value = job.requirements;
            document.getElementById('job-modal').classList.add('active');
        }

        function closeJobModal() {
            document.getElementById('job-modal').classList.remove('active');
            editingJob = null;
        }

        async function handleJobForm(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submit-job-btn');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="loading-spinner"></span>Saving...';

            const jobData = {
                job_title: document.getElementById('job-title').value,
                company_name: document.getElementById('company-name').value,
                location: document.getElementById('location').value,
                job_type: document.getElementById('job-type').value,
                salary_range: document.getElementById('salary-range').value,
                description: document.getElementById('description').value,
                requirements: document.getElementById('requirements').value,
                posted_date: editingJob ? editingJob.posted_date : new Date().toISOString(),
                applicant_name: "",
                applicant_email: "",
                applicant_phone: "",
                applicant_resume: "",
                application_date: "",
                job_id: "",
                user_email: "",
                user_name: "",
                registration_date: ""
            };

            let result;
            if (editingJob) {
                result = await window.dataSdk.update({ ...jobData, __backendId: editingJob.__backendId });
            } else {
                if (recordCount >= 999) {
                    showToast('Maximum limit of 999 records reached', 'error');
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                    return;
                }
                result = await window.dataSdk.create(jobData);
            }

            submitBtn.disabled = false;
            submitBtn.textContent = originalText;

            if (result.isOk) {
                showToast(editingJob ? 'Job updated successfully!' : 'Job posted successfully!', 'success');
                closeJobModal();
            } else {
                showToast('Failed to save job', 'error');
            }
        }

        function openApplyModal(job) {
            currentJobId = job.__backendId;
            document.getElementById('apply-job-title').textContent = `${job.job_title} at ${job.company_name}`;
            document.getElementById('apply-modal').classList.add('active');
            document.getElementById('apply-form').reset();
        }

        function closeApplyModal() {
            document.getElementById('apply-modal').classList.remove('active');
            currentJobId = null;
        }

        async function submitApplication(e) {
            e.preventDefault();

            if (recordCount >= 999) {
                showToast('Maximum limit reached', 'error');
                return;
            }

            const submitBtn = document.getElementById('submit-application-btn');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="loading-spinner"></span>Submitting...';

            const appData = {
                job_title: "",
                company_name: "",
                location: "",
                job_type: "",
                salary_range: "",
                description: "",
                requirements: "",
                posted_date: "",
                applicant_name: document.getElementById('applicant-name').value,
                applicant_email: document.getElementById('applicant-email').value,
                applicant_phone: document.getElementById('applicant-phone').value,
                applicant_resume: document.getElementById('applicant-resume').value,
                application_date: new Date().toISOString(),
                job_id: currentJobId,
                user_email: "",
                user_name: "",
                registration_date: ""
            };

            const result = await window.dataSdk.create(appData);

            submitBtn.disabled = false;
            submitBtn.textContent = originalText;

            if (result.isOk) {
                showToast('Application submitted successfully!', 'success');
                closeApplyModal();
            } else {
                showToast('Failed to submit application', 'error');
            }
        }

        async function deleteJob(job) {
            const result = await window.dataSdk.delete(job);
            if (result.isOk) {
                showToast('Job deleted successfully', 'success');
            } else {
                showToast('Failed to delete job', 'error');
            }
        }

        async function deleteApplication(app) {
            const result = await window.dataSdk.delete(app);
            if (result.isOk) {
                showToast('Application deleted', 'success');
            } else {
                showToast('Failed to delete application', 'error');
            }
        }

        function showToast(message, type) {
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.textContent = message;
            toast.style.backgroundColor = type === 'success' ? '#10b981' : '#ef4444';
            toast.style.color = '#ffffff';
            document.body.appendChild(toast);

            setTimeout(() => toast.remove(), 3000);
        }

        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
                btn.style.color = (window.elementSdk?.config || defaultConfig).text_color || defaultConfig.text_color;
            });

            const activeTab = document.querySelector(`[data-tab="${tabName}"]`);
            activeTab.classList.add('active');
            activeTab.style.color = (window.elementSdk?.config || defaultConfig).primary_action_color || defaultConfig.primary_action_color;

            document.getElementById(`admin-${tabName}-tab`).classList.remove('hidden');
        }

        document.getElementById('login-form').addEventListener('submit', handleLogin);
        document.getElementById('admin-logout-btn').addEventListener('click', showLoginPage);
        document.getElementById('client-logout-btn').addEventListener('click', showLoginPage);
        document.getElementById('admin-add-job-btn').addEventListener('click', openAddJobModal);
        document.getElementById('close-job-modal').addEventListener('click', closeJobModal);
        document.getElementById('cancel-job-btn').addEventListener('click', closeJobModal);
        document.getElementById('job-form').addEventListener('submit', handleJobForm);
        document.getElementById('close-apply-modal').addEventListener('click', closeApplyModal);
        document.getElementById('cancel-apply-btn').addEventListener('click', closeApplyModal);
        document.getElementById('apply-form').addEventListener('submit', submitApplication);
        document.getElementById('client-job-filter').addEventListener('change', renderClientJobs);

        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.addEventListener('click', () => switchTab(btn.dataset.tab));
        });

        initializeApp();
        <script src="assets/js/data_sdk.js"></script>
    <script src="assets/js/element_sdk.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
      // Inline bridge (no-op) kept to avoid unexpected globals
    </script>