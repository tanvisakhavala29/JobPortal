# JobPortal – Campus Career Connect

A web-based job portal and recruitment management system for automated job posting and application management.

## Features

✅ **User Registration & Login** – Secure authentication with role-based access  
✅ **Job Posting & Management** – Admins can create, edit, and delete job listings  
✅ **Job Search & Filtering** – Users can browse and filter jobs by type  
✅ **Application Submission** – Candidates can apply online with resume links  
✅ **Admin Dashboard** – View statistics, manage jobs, applications, and users  
✅ **Responsive Design** – Mobile-friendly UI with Tailwind CSS

## Project Structure

```
JobPortal/
├── index.php              # Entry point (redirects based on user role)
├── login.php              # Login & signup page
├── client.php             # Job listings page for users
├── admin_view.php         # Admin dashboard
├── admin.php              # Admin redirect
├── logout.php             # Logout handler
├── job.php                # Standalone job page (full UI)
├── assets/
│   ├── css/
│   │   └── style.css      # Shared styles
│   └── js/
│       ├── auth.js        # Authentication logic
│       ├── data_sdk.js    # Data storage (localStorage)
│       ├── element_sdk.js # Theme & config manager
│       └── app.js         # Main app logic
├── SYSTEM ANALYSIS & DIAGRAMS.txt  # Project documentation
├── ERdiagram.png          # Database schema diagram
├── DFDdiagram.png         # Data flow diagram
├── UMLdiagram.png         # UML diagram
└── README.md              # This file
```

## Setup & Installation

### Requirements

- **PHP 7.0+** (via XAMPP or similar)
- **Modern Web Browser** (Chrome, Firefox, Safari, Edge)
- **Local Server** (XAMPP, WAMP, or similar)

### Installation Steps

1. **Clone the repository:**

   ```bash
   git clone https://github.com/tanvisakhavala29/JobPortal.git
   cd JobPortal
   ```

2. **Place in web root:**

   - Copy the `JobPortal` folder to `C:\xampp\htdocs\` (Windows) or `/var/www/html/` (Linux)

3. **Start PHP Server:**

   ```bash
   php -S localhost:8000
   ```

   Or use XAMPP/WAMP built-in server.

4. **Access the application:**
   - Open `http://localhost/JobPortal/` or `http://localhost:8000/`

## Usage

### For Users

1. **Sign Up** – Create a new account with email and password
2. **Login** – Sign in with credentials
3. **Browse Jobs** – View available positions and filter by job type
4. **Apply** – Submit applications with resume links

### For Admins

**Login Credentials:**

- Email: `tanvisakhaval@gmail.com`
- Password: `2809`

**Admin Capabilities:**

- View dashboard statistics (jobs, applications, users)
- Create, edit, and delete job postings
- Review all applications
- View registered users

## Data Storage

This application uses **browser localStorage** for data persistence (no database required):

- User accounts
- Job postings
- Applications
- Admin credentials

Data is stored locally on each browser and persists across sessions.

## Technologies Used

| Technology           | Purpose                              |
| -------------------- | ------------------------------------ |
| **PHP**              | Server-side routing & redirect logic |
| **HTML5**            | Semantic markup                      |
| **CSS3**             | Styling & layout                     |
| **JavaScript (ES6)** | Client-side logic & interactivity    |
| **Tailwind CSS**     | Utility-first CSS framework          |
| **localStorage API** | Client-side data persistence         |

## File Descriptions

| File                       | Description                                     |
| -------------------------- | ----------------------------------------------- |
| `index.php`                | Entry point; redirects users based on role      |
| `login.php`                | Styled login & signup page with toggle UI       |
| `client.php`               | User dashboard with job listings                |
| `admin_view.php`           | Admin dashboard with management tabs            |
| `admin.php`                | Admin redirect (checks role)                    |
| `logout.php`               | Clears session & redirects                      |
| `job.php`                  | Standalone full-featured job portal UI (legacy) |
| `assets/js/auth.js`        | Authentication (login, signup, logout)          |
| `assets/js/data_sdk.js`    | CRUD operations on localStorage                 |
| `assets/js/element_sdk.js` | Theme configuration manager                     |
| `assets/js/app.js`         | Main app logic (modals, filtering, stats)       |
| `assets/css/style.css`     | Shared component styles                         |

## Default Admin Account

- **Name:** Tanvi Sakhavala
- **Email:** tanvisakhaval@gmail.com
- **Password:** 2809

## Architecture

```
┌─────────────────────────────────────────┐
│         User Browser (Client)           │
├─────────────────────────────────────────┤
│  ├─ login.php        (auth UI)         │
│  ├─ client.php       (job listings)    │
│  ├─ admin_view.php   (admin dashboard) │
│  └─ assets/js/       (logic & styles)  │
├─────────────────────────────────────────┤
│  localStorage (data persistence)        │
└─────────────────────────────────────────┘
```

## Features Breakdown

### Authentication (`auth.js`)

- Signup with email/password validation
- Login with credential verification
- Hardcoded admin account
- Session management via localStorage
- Logout functionality

### Data Management (`data_sdk.js`)

- Create, Read, Update, Delete (CRUD) operations
- In-memory record storage with localStorage backup
- Automatic ID generation
- Change notifications for real-time updates

### Job Management (`app.js`)

- Post new jobs (admin only)
- Edit existing jobs
- Delete jobs
- Filter jobs by type
- View job details

### Application Management (`app.js`)

- Submit job applications
- Track applicant information
- View all applications (admin)
- Manage applicant status

## Future Enhancements

- [ ] Database integration (MySQL/PostgreSQL)
- [ ] Email notifications
- [ ] Advanced job filtering (salary, experience level)
- [ ] User profile pages
- [ ] Application status tracking
- [ ] Resume upload functionality
- [ ] Admin-side applicant rating system
- [ ] Pagination for large datasets

## Troubleshooting

### "Page redirects to login.php"

- Check that you're logged in (check browser console: `JSON.parse(localStorage.getItem('jobportal_current_user'))`)
- Clear browser cache and localStorage: `localStorage.clear()`

### "Applications not saving"

- Check browser developer tools → Application → localStorage
- Ensure localStorage is enabled in browser settings

### "Admin login fails"

- Verify credentials: email `tanvisakhaval@gmail.com`, password `2809`
- Check browser console for error messages

### "Styles not loading"

- Verify `assets/css/style.css` exists
- Check browser console for 404 errors
- Clear browser cache (Ctrl+Shift+Delete)

## License

This project is open source and available under the MIT License.

## Author

**Tanvi Sakhavala**  
GitHub: [@tanvisakhavala29](https://github.com/tanvisakhavala29)

## Support

For issues, feature requests, or contributions, please open an issue on GitHub:  
[GitHub Issues](https://github.com/tanvisakhavala29/JobPortal/issues)

---

**Last Updated:** January 2026  
**Version:** 1.0.0
