// Main app logic (moved from job.php). Runs after DOMContentLoaded.
document.addEventListener("DOMContentLoaded", () => {
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
    admin_welcome: "Admin Dashboard",
  };

  let allJobs = [];
  let allApplications = [];
  let allUsers = [];
  let currentJobId = null;
  let currentUser = null;
  let isAdmin = false;
  let recordCount = 0;
  let editingJob = null;

  // hydrate auth state from localStorage (login.php sets this)
  try {
    const saved =
      window.auth && typeof window.auth.getCurrentUser === "function"
        ? window.auth.getCurrentUser()
        : JSON.parse(localStorage.getItem("jobportal_current_user") || "null");
    if (saved) {
      currentUser = saved;
      isAdmin = !!saved.isAdmin;
    }
  } catch (e) {}

  const ADMIN_CREDENTIALS = {
    username: "Tanvi Sakhavala",
    email: "tanvisakhaval@gmail.com",
    password: "2809",
  };

  const dataHandler = {
    onDataChanged(data) {
      recordCount = data.length;
      allJobs = data.filter(
        (record) =>
          record.job_title && !record.applicant_name && !record.user_email
      );
      allApplications = data.filter(
        (record) => record.applicant_name && record.job_id
      );
      allUsers = data.filter(
        (record) => record.user_email && record.user_name && !record.job_title
      );
      if (isAdmin) {
        updateAdminStats();
        renderAdminJobs();
        renderAdminApplications();
        renderAdminUsers();
      } else {
        renderClientJobs();
      }
    },
  };

  async function initializeApp() {
    const dataResult = await window.dataSdk.init(dataHandler);
    if (!dataResult.isOk) {
      showToast("Failed to initialize data storage", "error");
      return;
    }

    if (window.elementSdk) {
      window.elementSdk.init({
        defaultConfig,
        onConfigChange: async (config) => {
          applyStyles(config);
        },
        mapToCapabilities: (config) => ({
          recolorables: [],
          borderables: [],
          fontEditable: {},
          fontSizeable: {},
        }),
        mapToEditPanelValues: (config) =>
          new Map([
            ["portal_title", config.portal_title || defaultConfig.portal_title],
            [
              "portal_tagline",
              config.portal_tagline || defaultConfig.portal_tagline,
            ],
            ["login_title", config.login_title || defaultConfig.login_title],
            [
              "admin_welcome",
              config.admin_welcome || defaultConfig.admin_welcome,
            ],
          ]),
      });
    }
  }

  function applyStyles(config) {
    const customFont = config.font_family || defaultConfig.font_family;
    const baseFontStack = "system-ui, -apple-system, sans-serif";
    const baseSize = config.font_size || defaultConfig.font_size;
    const bgColor = config.background_color || defaultConfig.background_color;
    const headerColor = config.header_color || defaultConfig.header_color;
    const textColor = config.text_color || defaultConfig.text_color;
    const primaryColor =
      config.primary_action_color || defaultConfig.primary_action_color;
    const secondaryColor =
      config.secondary_action_color || defaultConfig.secondary_action_color;

    document.body.style.fontFamily = `${customFont}, ${baseFontStack}`;
    document.body.style.fontSize = `${baseSize}px`;
    document.body.style.backgroundColor = bgColor;
    document.body.style.color = textColor;

    ["admin-header", "client-header"].forEach((id) => {
      const el = document.getElementById(id);
      if (el) el.style.backgroundColor = headerColor;
    });

    const loginTitleEl = document.getElementById("login-title");
    if (loginTitleEl) {
      loginTitleEl.textContent =
        config.login_title || defaultConfig.login_title;
      loginTitleEl.style.fontSize = `${baseSize * 1.75}px`;
      loginTitleEl.style.color = textColor;
    }

    const portalTitleEl = document.getElementById("portal-title");
    if (portalTitleEl) {
      portalTitleEl.textContent =
        config.portal_title || defaultConfig.portal_title;
      portalTitleEl.style.fontSize = `${baseSize * 1.75}px`;
      portalTitleEl.style.color = textColor;
    }

    const portalTaglineEl = document.getElementById("portal-tagline");
    if (portalTaglineEl) portalTaglineEl.style.color = textColor;

    const adminWelcomeEl = document.getElementById("admin-welcome");
    if (adminWelcomeEl) {
      adminWelcomeEl.textContent =
        config.admin_welcome || defaultConfig.admin_welcome;
      adminWelcomeEl.style.fontSize = `${baseSize * 1.5}px`;
      adminWelcomeEl.style.color = textColor;
    }

    [
      "login-btn",
      "submit-job-btn",
      "submit-application-btn",
      "admin-add-job-btn",
    ].forEach((id) => {
      const btn = document.getElementById(id);
      if (btn) {
        btn.style.backgroundColor = primaryColor;
        btn.style.color = "#ffffff";
      }
    });

    ["admin-logout-btn", "client-logout-btn"].forEach((id) => {
      const btn = document.getElementById(id);
      if (btn) {
        btn.style.backgroundColor = secondaryColor;
        btn.style.borderColor = primaryColor;
        btn.style.color = primaryColor;
        btn.style.border = `2px solid ${primaryColor}`;
      }
    });

    document.querySelectorAll(".tab-button").forEach((tab) => {
      tab.style.color = textColor;
      if (tab.classList.contains("active")) tab.style.color = primaryColor;
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
    const username = document.getElementById("login-username").value;
    const email = document.getElementById("login-email").value;
    const password = document.getElementById("login-password").value;

    if (
      username === ADMIN_CREDENTIALS.username &&
      email === ADMIN_CREDENTIALS.email &&
      password === ADMIN_CREDENTIALS.password
    ) {
      isAdmin = true;
      currentUser = { username, email, isAdmin: true };
      showAdminPage();
      showToast("Welcome Admin!", "success");
    } else {
      isAdmin = false;
      currentUser = { username, email, isAdmin: false };
      const existingUser = allUsers.find((u) => u.user_email === email);
      if (!existingUser && recordCount < 999) {
        await window.dataSdk.create({
          user_email: email,
          user_name: username,
          registration_date: new Date().toISOString(),
        });
      }
      showClientPage();
      showToast(`Welcome, ${username}!`, "success");
    }
    document.getElementById("login-form").reset();
  }

  function showAdminPage() {
    document.getElementById("login-page").classList.add("hidden");
    document.getElementById("client-page").classList.add("hidden");
    document.getElementById("admin-page").classList.remove("hidden");
    updateAdminStats();
  }
  function showClientPage() {
    document.getElementById("login-page").classList.add("hidden");
    document.getElementById("admin-page").classList.add("hidden");
    document.getElementById("client-page").classList.remove("hidden");
  }
  function showLoginPage() {
    document.getElementById("admin-page").classList.add("hidden");
    document.getElementById("client-page").classList.add("hidden");
    document.getElementById("login-page").classList.remove("hidden");
    currentUser = null;
    isAdmin = false;
  }

  function updateAdminStats() {
    const sj = document.getElementById("stat-jobs");
    if (sj) sj.textContent = allJobs.length;
    const sa = document.getElementById("stat-applications");
    if (sa) sa.textContent = allApplications.length;
    const su = document.getElementById("stat-users");
    if (su) su.textContent = allUsers.length;
  }

  function renderAdminJobs() {
    const container = document.getElementById("admin-jobs-container");
    const noJobsDiv = document.getElementById("admin-no-jobs");
    if (!container) return;
    if (allJobs.length === 0) {
      container.innerHTML = "";
      if (noJobsDiv) noJobsDiv.classList.remove("hidden");
      return;
    }
    if (noJobsDiv) noJobsDiv.classList.add("hidden");
    container.innerHTML = allJobs
      .map((job) => createAdminJobCard(job))
      .join("");
    allJobs.forEach((job) => {
      const e = document.getElementById(`edit-${job.__backendId}`);
      const d = document.getElementById(`delete-${job.__backendId}`);
      if (e) e.addEventListener("click", () => openEditJobModal(job));
      if (d) d.addEventListener("click", () => deleteJob(job));
    });
  }

  function createAdminJobCard(job) {
    const config = window.elementSdk?.config || defaultConfig;
    const baseSize = config.font_size || defaultConfig.font_size;
    const textColor = config.text_color || defaultConfig.text_color;
    const primaryColor =
      config.primary_action_color || defaultConfig.primary_action_color;
    return `
      <div class="job-card bg-white rounded-lg shadow-md p-6 border-2">
        <div class="flex justify-between items-start mb-3">
          <h3 class="font-bold" style="font-size: ${
            baseSize * 1.15
          }px; color: ${textColor};">${job.job_title}</h3>
          <span class="px-3 py-1 rounded-full text-xs font-medium" style="background-color: ${primaryColor}20; color: ${primaryColor};">${
      job.job_type
    }</span>
        </div>
        <p class="font-semibold mb-2" style="font-size: ${
          baseSize * 0.95
        }px; color: ${textColor};">${job.company_name}</p>
        <div class="flex items-center gap-3 mb-3 text-sm" style="color: ${textColor};">
          <span>📍 ${job.location}</span>
          <span>💰 ${job.salary_range}</span>
        </div>
        <div class="flex gap-2 mt-4">
          <button id="edit-${
            job.__backendId
          }" class="flex-1 px-4 py-2 rounded-lg font-medium transition-colors" style="background-color: ${primaryColor}; color: #ffffff;">Edit</button>
          <button id="delete-${
            job.__backendId
          }" class="px-4 py-2 rounded-lg font-medium transition-colors" style="background-color: #fee; color: #ef4444;">Delete</button>
        </div>
      </div>
    `;
  }

  function renderAdminApplications() {
    const container = document.getElementById("admin-applications-container");
    const noAppsDiv = document.getElementById("admin-no-applications");
    if (!container) return;
    if (allApplications.length === 0) {
      container.innerHTML = "";
      if (noAppsDiv) noAppsDiv.classList.remove("hidden");
      return;
    }
    if (noAppsDiv) noAppsDiv.classList.add("hidden");
    container.innerHTML = allApplications
      .map((app) => createAdminApplicationCard(app))
      .join("");
    allApplications.forEach((app) => {
      const d = document.getElementById(`delete-app-${app.__backendId}`);
      if (d) d.addEventListener("click", () => deleteApplication(app));
    });
  }

  function createAdminApplicationCard(app) {
    const job = allJobs.find((j) => j.__backendId === app.job_id);
    const config = window.elementSdk?.config || defaultConfig;
    const baseSize = config.font_size || defaultConfig.font_size;
    const textColor = config.text_color || defaultConfig.text_color;
    const primaryColor =
      config.primary_action_color || defaultConfig.primary_action_color;
    return `
      <div class="bg-white rounded-lg shadow-md p-6 border-2">
        <div class="flex justify-between items-start mb-4">
          <div>
            <h3 class="font-bold mb-1" style="font-size: ${
              baseSize * 1.15
            }px; color: ${textColor};">${app.applicant_name}</h3>
            <p class="font-medium" style="color: ${textColor};">Applied for: ${
      job ? job.job_title : "Deleted Position"
    }</p>
          </div>
          <button id="delete-app-${
            app.__backendId
          }" class="px-3 py-1 rounded-lg text-sm font-medium" style="background-color: #fee; color: #ef4444;">Delete</button>
        </div>
        <div class="space-y-2 text-sm" style="color: ${textColor};">
          <p>📧 ${app.applicant_email}</p>
          <p>📱 ${app.applicant_phone}</p>
          <p>📄 <a href="${
            app.applicant_resume
          }" target="_blank" rel="noopener noreferrer" class="underline" style="color: ${primaryColor};">View Resume</a></p>
          <p class="opacity-60">Applied: ${new Date(
            app.application_date
          ).toLocaleDateString()}</p>
        </div>
      </div>
    `;
  }

  function renderAdminUsers() {
    const container = document.getElementById("admin-users-container");
    const noUsersDiv = document.getElementById("admin-no-users");
    if (!container) return;
    if (allUsers.length === 0) {
      container.innerHTML = "";
      if (noUsersDiv) noUsersDiv.classList.remove("hidden");
      return;
    }
    if (noUsersDiv) noUsersDiv.classList.add("hidden");
    const config = window.elementSdk?.config || defaultConfig;
    const baseSize = config.font_size || defaultConfig.font_size;
    const textColor = config.text_color || defaultConfig.text_color;
    container.innerHTML = allUsers
      .map(
        (user) =>
          `<div class="bg-white rounded-lg shadow-md p-6 border-2"><h3 class="font-bold mb-2" style="font-size: ${
            baseSize * 1.1
          }px; color: ${textColor};">👤 ${
            user.user_name
          }</h3><p style="color: ${textColor};">📧 ${
            user.user_email
          }</p><p class="text-sm opacity-60 mt-2" style="color: ${textColor};">Registered: ${new Date(
            user.registration_date
          ).toLocaleDateString()}</p></div>`
      )
      .join("");
  }

  function renderClientJobs() {
    const container = document.getElementById("client-jobs-container");
    const noJobsDiv = document.getElementById("client-no-jobs");
    const filterEl = document.getElementById("client-job-filter");
    const filter = filterEl ? filterEl.value : "all";
    if (!container) return;
    const filteredJobs =
      filter === "all"
        ? allJobs
        : allJobs.filter((job) => job.job_type === filter);
    if (filteredJobs.length === 0) {
      container.innerHTML = "";
      if (noJobsDiv) noJobsDiv.classList.remove("hidden");
      return;
    }
    if (noJobsDiv) noJobsDiv.classList.add("hidden");
    container.innerHTML = filteredJobs
      .map((job) => createClientJobCard(job))
      .join("");
    filteredJobs.forEach((job) => {
      const a = document.getElementById(`apply-${job.__backendId}`);
      if (a) a.addEventListener("click", () => openApplyModal(job));
    });
  }

  function createClientJobCard(job) {
    const config = window.elementSdk?.config || defaultConfig;
    const baseSize = config.font_size || defaultConfig.font_size;
    const textColor = config.text_color || defaultConfig.text_color;
    const primaryColor =
      config.primary_action_color || defaultConfig.primary_action_color;
    return `
    <div class="job-card bg-white rounded-lg shadow-md p-6 border-2 border-transparent hover:border-blue-200">
      <div class="flex justify-between items-start mb-3">
        <h3 class="font-bold" style="font-size: ${
          baseSize * 1.25
        }px; color: ${textColor};">${job.job_title}</h3>
        <span class="px-3 py-1 rounded-full text-xs font-medium" style="background-color: ${primaryColor}20; color: ${primaryColor};">${
      job.job_type
    }</span>
      </div>
      <p class="font-semibold mb-2" style="font-size: ${
        baseSize * 0.95
      }px; color: ${textColor};">${job.company_name}</p>
      <div class="flex items-center gap-4 mb-3" style="font-size: ${
        baseSize * 0.85
      }px; color: ${textColor};">
        <span>📍 ${job.location}</span>
        <span>💰 ${job.salary_range}</span>
      </div>
      <p class="mb-4" style="font-size: ${
        baseSize * 0.85
      }px; color: ${textColor};">${job.description}</p>
      <button id="apply-${
        job.__backendId
      }" class="w-full px-4 py-2 rounded-lg font-medium transition-colors" style="background-color: ${primaryColor}; color: #ffffff; font-size: ${
      baseSize * 0.9
    }px;">Apply Now</button>
    </div>
  `;
  }

  function openAddJobModal() {
    editingJob = null;
    const t = document.getElementById("job-modal-title");
    if (t) t.textContent = "Add New Job";
    const f = document.getElementById("job-form");
    if (f) f.reset();
    document.getElementById("job-modal").classList.add("active");
  }
  function openEditJobModal(job) {
    editingJob = job;
    const t = document.getElementById("job-modal-title");
    if (t) t.textContent = "Edit Job";
    document.getElementById("job-title").value = job.job_title || "";
    document.getElementById("company-name").value = job.company_name || "";
    document.getElementById("location").value = job.location || "";
    document.getElementById("job-type").value = job.job_type || "";
    document.getElementById("salary-range").value = job.salary_range || "";
    document.getElementById("description").value = job.description || "";
    document.getElementById("requirements").value = job.requirements || "";
    document.getElementById("job-modal").classList.add("active");
  }
  function closeJobModal() {
    document.getElementById("job-modal").classList.remove("active");
    editingJob = null;
  }

  async function handleJobForm(e) {
    e.preventDefault();
    const submitBtn = document.getElementById("submit-job-btn");
    const originalText = submitBtn ? submitBtn.textContent : "Save";
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="loading-spinner"></span>Saving...';
    }
    const jobData = {
      job_title: document.getElementById("job-title").value,
      company_name: document.getElementById("company-name").value,
      location: document.getElementById("location").value,
      job_type: document.getElementById("job-type").value,
      salary_range: document.getElementById("salary-range").value,
      description: document.getElementById("description").value,
      requirements: document.getElementById("requirements").value,
      posted_date: editingJob
        ? editingJob.posted_date
        : new Date().toISOString(),
      applicant_name: "",
      applicant_email: "",
      applicant_phone: "",
      applicant_resume: "",
      application_date: "",
      job_id: "",
      user_email: "",
      user_name: "",
      registration_date: "",
    };
    let result;
    if (editingJob) {
      result = await window.dataSdk.update({
        ...jobData,
        __backendId: editingJob.__backendId,
      });
    } else {
      if (recordCount >= 999) {
        showToast("Maximum limit of 999 records reached", "error");
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.textContent = originalText;
        }
        return;
      }
      result = await window.dataSdk.create(jobData);
    }
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
    }
    if (result.isOk) {
      showToast(
        editingJob ? "Job updated successfully!" : "Job posted successfully!",
        "success"
      );
      closeJobModal();
    } else {
      showToast("Failed to save job", "error");
    }
  }

  function openApplyModal(job) {
    currentJobId = job.__backendId;
    const t = document.getElementById("apply-job-title");
    if (t) t.textContent = `${job.job_title} at ${job.company_name}`;
    document.getElementById("apply-modal").classList.add("active");
    const f = document.getElementById("apply-form");
    if (f) f.reset();
  }
  function closeApplyModal() {
    document.getElementById("apply-modal").classList.remove("active");
    currentJobId = null;
  }

  async function submitApplication(e) {
    e.preventDefault();
    if (recordCount >= 999) {
      showToast("Maximum limit reached", "error");
      return;
    }
    const submitBtn = document.getElementById("submit-application-btn");
    const originalText = submitBtn ? submitBtn.textContent : "Submit";
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.innerHTML =
        '<span class="loading-spinner"></span>Submitting...';
    }
    const appData = {
      job_title: "",
      company_name: "",
      location: "",
      job_type: "",
      salary_range: "",
      description: "",
      requirements: "",
      posted_date: "",
      applicant_name: document.getElementById("applicant-name").value,
      applicant_email: document.getElementById("applicant-email").value,
      applicant_phone: document.getElementById("applicant-phone").value,
      applicant_resume: document.getElementById("applicant-resume").value,
      application_date: new Date().toISOString(),
      job_id: currentJobId,
      user_email: "",
      user_name: "",
      registration_date: "",
    };
    const result = await window.dataSdk.create(appData);
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
    }
    if (result.isOk) {
      showToast("Application submitted successfully!", "success");
      closeApplyModal();
    } else {
      showToast("Failed to submit application", "error");
    }
  }

  async function deleteJob(job) {
    const result = await window.dataSdk.delete(job);
    if (result.isOk) showToast("Job deleted successfully", "success");
    else showToast("Failed to delete job", "error");
  }
  async function deleteApplication(app) {
    const result = await window.dataSdk.delete(app);
    if (result.isOk) showToast("Application deleted", "success");
    else showToast("Failed to delete application", "error");
  }

  function showToast(message, type) {
    const toast = document.createElement("div");
    toast.className = "toast";
    toast.textContent = message;
    toast.style.backgroundColor = type === "success" ? "#10b981" : "#ef4444";
    toast.style.color = "#ffffff";
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
  }

  function switchTab(tabName) {
    document
      .querySelectorAll(".tab-content")
      .forEach((tab) => tab.classList.add("hidden"));
    document.querySelectorAll(".tab-button").forEach((btn) => {
      btn.classList.remove("active");
      btn.style.color =
        (window.elementSdk?.config || defaultConfig).text_color ||
        defaultConfig.text_color;
    });
    const activeTabBtn = document.querySelector(`[data-tab="${tabName}"]`);
    if (activeTabBtn) {
      activeTabBtn.classList.add("active");
      activeTabBtn.style.color =
        (window.elementSdk?.config || defaultConfig).primary_action_color ||
        defaultConfig.primary_action_color;
    }
    const content = document.getElementById(`admin-${tabName}-tab`);
    if (content) content.classList.remove("hidden");
  }

  // wire DOM events
  const loginForm = document.getElementById("login-form");
  if (loginForm) loginForm.addEventListener("submit", handleLogin);
  const adminLogout = document.getElementById("admin-logout-btn");
  if (adminLogout)
    adminLogout.addEventListener("click", () => {
      if (window.auth && typeof window.auth.logout === "function")
        window.auth.logout();
      else localStorage.removeItem("jobportal_current_user");
      window.location = "login.php";
    });
  const clientLogout = document.getElementById("client-logout-btn");
  if (clientLogout)
    clientLogout.addEventListener("click", () => {
      if (window.auth && typeof window.auth.logout === "function")
        window.auth.logout();
      else localStorage.removeItem("jobportal_current_user");
      window.location = "login.php";
    });
  const addJobBtn = document.getElementById("admin-add-job-btn");
  if (addJobBtn) addJobBtn.addEventListener("click", openAddJobModal);
  const closeJobBtn = document.getElementById("close-job-modal");
  if (closeJobBtn) closeJobBtn.addEventListener("click", closeJobModal);
  const cancelJobBtn = document.getElementById("cancel-job-btn");
  if (cancelJobBtn) cancelJobBtn.addEventListener("click", closeJobModal);
  const jobForm = document.getElementById("job-form");
  if (jobForm) jobForm.addEventListener("submit", handleJobForm);
  const closeApplyBtn = document.getElementById("close-apply-modal");
  if (closeApplyBtn) closeApplyBtn.addEventListener("click", closeApplyModal);
  const cancelApplyBtn = document.getElementById("cancel-apply-btn");
  if (cancelApplyBtn) cancelApplyBtn.addEventListener("click", closeApplyModal);
  const applyForm = document.getElementById("apply-form");
  if (applyForm) applyForm.addEventListener("submit", submitApplication);
  const filterEl = document.getElementById("client-job-filter");
  if (filterEl) filterEl.addEventListener("change", renderClientJobs);
  document
    .querySelectorAll(".tab-button")
    .forEach((btn) =>
      btn.addEventListener("click", () => switchTab(btn.dataset.tab))
    );

  // initialize
  initializeApp();
});
