// Simple auth helper using dataSdk and localStorage
(function () {
  function getCurrentUser() {
    try {
      return JSON.parse(
        localStorage.getItem("jobportal_current_user") || "null"
      );
    } catch (e) {
      return null;
    }
  }

  function setCurrentUser(user) {
    localStorage.setItem("jobportal_current_user", JSON.stringify(user));
  }

  async function signup(username, email, password) {
    const res = await window.dataSdk.list();
    const records = res.records || [];
    const existing = records.find((r) => r.user_email === email);
    if (existing) return { ok: false, message: "Email already registered" };
    const result = await window.dataSdk.create({
      user_email: email,
      user_name: username,
      password: password,
      registration_date: new Date().toISOString(),
    });
    if (result.isOk) {
      setCurrentUser({ username, email, isAdmin: false });
      return { ok: true };
    }
    return { ok: false, message: "Failed to create user" };
  }

  async function login(email, password) {
    // check admin hardcoded
    const ADMIN = {
      username: "Tanvi Sakhavala",
      email: "tanvisakhaval@gmail.com",
      password: "2809",
    };
    if (email === ADMIN.email && password === ADMIN.password) {
      setCurrentUser({
        username: ADMIN.username,
        email: ADMIN.email,
        isAdmin: true,
      });
      return { ok: true, isAdmin: true };
    }

    const res = await window.dataSdk.list();
    const records = res.records || [];
    const user = records.find(
      (r) => r.user_email === email && r.password === password
    );
    if (user) {
      setCurrentUser({
        username: user.user_name || email.split("@")[0],
        email: user.user_email,
        isAdmin: false,
      });
      return { ok: true, isAdmin: false };
    }
    return { ok: false, message: "Invalid credentials" };
  }

  function logout() {
    localStorage.removeItem("jobportal_current_user");
  }

  window.auth = { signup, login, logout, getCurrentUser };
})();
