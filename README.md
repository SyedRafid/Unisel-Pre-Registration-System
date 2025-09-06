# Unisel-Pre-Registration-System

## 📌 Project Overview
The **Unisel Pre-Registration System (UPRS)** is a web-based platform designed to streamline the pre-registration process for students and program coordinators at **Universiti Selangor (UNISEL)**.  
It simplifies course registration, improves transparency, and enhances administrative efficiency by replacing outdated semi-automated methods.

---

## 👥 User Roles

Admin (Program Coordinator): Manages semesters, courses, users, and events

Student: Registers for subjects and views history

---

## 🚀 Features
- **Authentication**
  - User registration & login (Students)
  - Admin login (Program Coordinators)
- **Semester & Course Management**
  - Admins can create, update, and delete semesters and courses
- **User Management**
  - Admins can manage student accounts
- **Pre-Registration Events**
  - Admins can initiate events with start/end dates
  - Students can select subjects for upcoming semesters
- **History Tracking**
  - Students can view their registration history
  - Admins can monitor all student records

---

## 🛠 Tech Stack
- **Frontend & Backend:** HTML, CSS, Bootstrap, JavaScript, PHP
- **Database:** MariaDB (via XAMPP)
- **Editor:** Visual Studio Code
- **Server:** Apache (XAMPP)

---

## 📂 System Scope
- **Login / Register:** Students register & login, Admins login only  
- **Semester & Course Management:** Admins create and update records  
- **User Management:** Admins handle user data and remove suspicious accounts  
- **Pre-Registration Form:** Students select desired courses  
- **Pre-Registration History:** Students & Admins can view past records  

---

## 🧩 Entity Relationship Diagram (ERD)
The system uses a **relational database model** to handle users, courses, and registration history.  
*(Refer to project documentation for the detailed ERD illustration.)*

---

## 🔄 Development Methodology
The project follows the **Waterfall Model** with these phases:
1. **Requirement Gathering** – Face-to-face consultation with supervisor  
2. **Design** – Logical and physical system design (ERD, UI)  
3. **Implementation** – Coding and integration  
4. **Testing** – Validation, debugging, and user acceptance tests  
5. **Maintenance** – Ongoing system support and updates  

---

## 🚀 Setup Instructions

### ✅ Requirements

- PHP 7.4+
- MySQL
- Apache Server (e.g., XAMPP, WAMP, LAMP)
- phpMyAdmin (for DB import)

### 📥 1. Clone the Project

```bash
git clone https://github.com/SyedRafid/Unisel-Pre-Registration-System.git
cd Unisel-Pre-Registration-System
```

### 📂 2. Importing the Database using phpMyAdmin

This project uses a MySQL database named **`db_prs`**. To set it up locally, follow these steps:

1. **Create the Database:**

   - Open **phpMyAdmin** in your browser (e.g., http://localhost/phpmyadmin).
   - Click on the **Databases** tab.
   - In the "Create database" field, enter the name:
     ```
     db_prs
     ```
   - Choose the collation (e.g., `utf8mb4_general_ci`) and click **Create**.

2. **Import the SQL File:**

   - Click on the newly created `db_prs` database in phpMyAdmin.
   - Go to the **Import** tab.
   - Click **Choose File** and browse to the project folder's `db` directory.
   - Select the SQL file (e.g., `db_prs.sql`).
   - Click **Go** at the bottom to start the import.
   - Wait for the success message confirming the import.

### 🗝️ Admin Login (Default)

- **Email:** syed.shuvon@gmail.com
- **Password:** syed.shuvon@gmail.com


> ⚠️ This is the default account. Please log in and change the password immediately after setup for security. Sign up for student account

---

## 🙏 Thank You!

Thank you for checking out the **Unisel Pre-Registration System (UPRS)**!  
If you find this project useful, please consider giving it a ⭐️ on GitHub.  

Feel free to open issues or submit pull requests — feedback and contributions are always welcome!  

Happy coding — and best of luck managing your **student course registration and academic events** efficiently! 🎓📚✨
