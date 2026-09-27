# 🎓 Student Feedback System

A web-based Feedback Management System for B.Tech Computer Engineering students. Built using PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap. Designed to collect, manage, and visualize student feedback on college experience, department, teachers, syllabus completion, and open-ended comments.

---

## 🔧 Features

- ✅ Student feedback submission form
- 📊 Admin dashboard with charts and filters (year, semester, section, etc.)
- 📌 College, department, and syllabus-wise feedback
- ⭐ Best teacher selection and display
- 🗣️ Open-ended feedback storage
- 🔒 Admin authentication and session management
- 📁 Database integration with MySQL

---

## 💡 Technologies Used

- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap
- **Backend:** PHP 7+
- **Database:** MySQL
- **Charting Library:** Chart.js
- **Admin Panel:** Custom-built using PHP and Bootstrap

---

## 🗂️ Folder Structure

feedbackSys/
│
├── admin_dashboard.php
├── feedback.php
├── login/
├── includes/
├── assets/
├── db_connection.php
├── feedback.sql ← MySQL dump file
└── README.md

yaml
Copy
Edit

---

## 📥 Installation & Setup

1. **Clone the repository**
   - Download ZIP or use Git clone

2. **Move to XAMPP**
   - Place the folder inside `C:\xampp\htdocs\`

3. **Import the database**
   - Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - Create a new database (e.g., `feedback`)
   - Click **Import** → choose `feedback.sql` → Click **Go**

4. **Run the project**
   - Visit [http://localhost/feedbackSys](http://localhost/feedbackSys)

---

## 🔐 Admin Login

- **URL:** `http://localhost/feedbackSys/admin_login.php`
- **Credentials:** (Set in `admin_login.php` or DB manually)


---

Output:
<img width="1365" height="598" alt="image" src="https://github.com/user-attachments/assets/df149532-1b7a-4b64-a6c8-4273301f3e94" />
---

## 📃 License

This project is created for educational purposes. You are free to use or modify it.

---

## 🙋‍♀️ Author

**Soniya Yadav**  
Feel free to connect or raise issues if you'd like to contribute or suggest features.
