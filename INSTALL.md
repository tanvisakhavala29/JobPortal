# Installation Guide

## Quick Start (Windows with XAMPP)

### Step 1: Clone Repository

```bash
cd C:\xampp\htdocs
git clone https://github.com/tanvisakhavala29/JobPortal.git
cd JobPortal
```

### Step 2: Start XAMPP

1. Open XAMPP Control Panel
2. Click **Start** for Apache
3. Verify status: Green indicator next to Apache

### Step 3: Access Application

- Open browser and navigate to: **http://localhost/JobPortal/**

### Step 4: Test Login

**Admin Account:**

- Email: `tanvisakhaval@gmail.com`
- Password: `2809`
- After login, you'll see the Admin Dashboard

**User Account:**

- Click "Sign up" on login page
- Create a test account with any email/password
- After signup, you'll see the Job Listings

---

## Setup for Linux/Mac

### Step 1: Clone Repository

```bash
cd /var/www/html
git clone https://github.com/tanvisakhavala29/JobPortal.git
cd JobPortal
```

### Step 2: Start PHP Server

```bash
php -S localhost:8000
```

### Step 3: Access Application

- Open browser and navigate to: **http://localhost:8000/**

---

## Troubleshooting

### Issue: "ERR_EMPTY_RESPONSE" when accessing localhost

- ✅ Ensure Apache (or PHP) server is running
- ✅ Check firewall isn't blocking port 80 or 8000

### Issue: "Cannot find module" in console

- ✅ Ensure all files in `assets/js/` and `assets/css/` exist
- ✅ Check file paths are correct (case-sensitive on Linux)

### Issue: "Local storage not saving"

- ✅ Ensure cookies/storage not disabled in browser
- ✅ Try different browser (Chrome, Firefox, Safari)

### Issue: "Login fails for admin"

- ✅ Verify email: `tanvisakhaval@gmail.com` (exact spelling)
- ✅ Verify password: `2809` (no extra spaces)
- ✅ Check browser console for errors (F12)

---

## Features to Test

1. **Login Page:**

   - ✅ Sign up with new email
   - ✅ Login with existing account
   - ✅ Switch between Login/Signup tabs

2. **Admin Dashboard:**

   - ✅ View job statistics
   - ✅ Create new job posting
   - ✅ Edit existing job
   - ✅ Delete job
   - ✅ View applications
   - ✅ View registered users

3. **User Dashboard:**

   - ✅ Browse all jobs
   - ✅ Filter jobs by type
   - ✅ Apply for job
   - ✅ View profile

4. **General:**
   - ✅ Logout functionality
   - ✅ Role-based redirects
   - ✅ Responsive on mobile

---

## Default Credentials

| Role  | Email                   | Password            |
| ----- | ----------------------- | ------------------- |
| Admin | tanvisakhaval@gmail.com | 2809                |
| User  | (Create via signup)     | (Create via signup) |

---

## Browser Requirements

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

All modern browsers with ES6 and localStorage support.

---

## Server Requirements

- PHP 7.0 or higher
- No database required (uses browser localStorage)
- No additional PHP extensions required

---

## File Structure After Clone

```
JobPortal/
├── README.md
├── INSTALL.md
├── .gitignore
├── login.php
├── index.php
├── client.php
├── admin.php
├── admin_view.php
├── logout.php
├── job.php
├── assets/
│   ├── css/style.css
│   └── js/
│       ├── auth.js
│       ├── data_sdk.js
│       ├── element_sdk.js
│       └── app.js
└── [diagrams and documentation files]
```

---

## Support

If you encounter issues:

1. Check browser console: **F12 → Console tab**
2. Check localStorage: **F12 → Application → localStorage**
3. Open an issue: [GitHub Issues](https://github.com/tanvisakhavala29/JobPortal/issues)

---

**Last Updated:** January 2026
