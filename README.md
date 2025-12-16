# Task Manager (CodeIgniter 3)

A simple **Task Management System** built with **CodeIgniter 3**.  
Users can log in, create, edit, delete, and filter tasks. Designed for clean code, proper MVC structure, and optimized database queries.

---

## Features

- **User Authentication**
  - Login with email and password
  - Session-based authentication
  - Passwords stored securely using bcrypt
- **Task Management**
  - Add, edit, delete tasks
  - Search tasks by title
  - Filter tasks by status (`pending`, `in_progress`, `completed`)
  - Priority color-coding (`low`=green, `medium`=yellow, `high`=red)
  - Display due date
- **Frontend**
  - Responsive design using Bootstrap 5
  - Flash messages for success/error
  - Sticky form values for better UX
  - CSRF protection enabled
- **Database**
  - Tables: `users`, `tasks`
  - Indexed columns: `user_id`, `status` for optimized queries
- **Clean Code**
  - Proper MVC separation
  - All database queries handled in Models
  - Input validation and sanitization

---

## Project Structure

task-manager/
├─ application/
│ ├─ controllers/
│ ├─ models/
│ ├─ views/
│ └─ config/
├─ system/
├─ database.sql
├─ index.php
├─ .gitignore
├─ README.md



---

## Setup Instructions

1. **Clone Repository**

```bash
git clone https://github.com/masimarif88/TaskManager-CI3.git
cd TaskManager-CI3


2. **Import Database**


Open phpMyAdmin, SQLYog, or MySQL Workbench
Create a new database, e.g., task_manager
Import database.sql located in the project root

3. **Configure Database**

Open application/config/database.php
Update with your database credentials:

$db['default'] = array(
    'dsn'      => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'task_manager',
    'dbdriver' => 'mysqli',
    ...
);

4. **Set Base URL**

Open application/config/config.php
Update
$config['base_url'] = 'http://localhost/task-manager/';

5. **Start Server**
Using XAMPP / Laragon / WAMP, start Apache and MySQL
Open browser: http://localhost/task-manager/index.php/auth/login

6. **Default Login Credentials**
user1@test.com / password123
user2@test.com/ password123

Passwords are stored hashed using bcrypt.


Notes

All database queries are in Models
Form validation ensures required fields and proper input
Flash messages show success or error after actions
CSRF protection enabled for all forms
Optimized database design with indexes on user_id and status


