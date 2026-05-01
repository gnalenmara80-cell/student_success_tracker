#  Student Success Tracker

## Features
- Add and manage student records  
- Track attendance across multiple dates  
- Record and view student grades  
- Generate visual analytics using **Chart.js**  
- Clean, simple, and beginner‑friendly PHP structure  
- MySQL database integration (XAMPP‑ready)

---

## Application Pages
The Student Success Tracker includes:

- **index.php** — Home page showing all students  
- **add_student.php** — Add new students to the database  
- **attendance.php** — View attendance records  
- **grades.php** — View student grades  
- **analytics.php** — Visual charts and insights (Chart.js)

---

##  Installation
1. Clone or download the project  
2. Move it into your XAMPP `htdocs` folder  
3. Import the SQL file into phpMyAdmin  
4. Update `db.php` with your database credentials  
5. Start Apache + MySQL  
6. Visit:  
   ```
   http://localhost/student-success-tracker/
   ```

---

## Technologies Used
- **PHP** (Core application logic)  
- **MySQL** (Database)  
- **HTML/CSS** (UI layout and styling)  
- **Chart.js** (Analytics visualizations)  
- **XAMPP** (Local development environment)

---

## Analytics (Chart.js)
This page provides visual insights such as:

- Attendance trends over time  
- Grade distribution charts  
- Student performance comparisons  
- Dynamic, responsive charts powered by Chart.js  

---

## Project Structure
```
/student-success-tracker
│
├── index.php
├── add_student.php
├── attendance.php
├── grades.php
├── analytics.php
│
├── /assets
│   ├── styles.css
│   └── script.js
│
├── /includes
│   ├── db.php
│   └── header.php
│
└── README.md
```

