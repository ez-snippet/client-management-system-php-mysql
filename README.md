# Client Management System

A PHP and MySQL based Client Management System developed to digitize a manual, paper-based client record management process.

## 📌 Overview

This project was developed for a real-world client requirement where client records, services, payments, and remaining amounts were previously managed manually on paper.

The system provides a centralized digital solution for managing client information and financial records, making the workflow more organized, efficient, and easier to maintain.

## ✨ Features

* 🔐 Admin Login & Authentication
* 📊 Admin Dashboard
* 👤 Add and Manage Clients
* 📝 Record Client Services
* 💰 Manage Total & Advance Payments
* 🧮 Track Remaining Amounts
* 📅 Record Transaction Dates
* ✏️ Edit Client Records
* 🗑️ Delete Client Records
* 📋 View Client Records in a Structured Table
* 🗄️ MySQL Database Integration
* 📱 Responsive User Interface

## 🛠️ Technologies Used

### Frontend

* HTML5
* CSS3
* Bootstrap
* JavaScript

### Backend

* PHP

### Database

* MySQL

### Development Environment

* XAMPP
* phpMyAdmin
* Visual Studio Code
* Git & GitHub

## 🔄 Workflow

The system follows a simple workflow:

```text
Admin Login
     ↓
Dashboard
     ↓
Add Client
     ↓
Enter Service & Payment Details
     ↓
Save Client Record
     ↓
View / Edit / Delete Records
     ↓
Track Remaining Amount
```

## 🎯 Project Purpose

The main purpose of this project is to replace a manual paper-based workflow with a digital client management system.

Previously, client information was recorded and maintained manually. This software provides a structured way to store and manage those records digitally.

## 🗃️ Database

The application uses **MySQL** to store client and authentication-related data.

The database structure can be imported through the included SQL file.

## ⚙️ Installation & Setup

### 1. Clone the repository

```bash
git clone https://github.com/ez-snippet/client-management-system-php-mysql.git
```

### 2. Move the project

Place the project inside the XAMPP `htdocs` directory.

```text
C:\xampp\htdocs\
```

### 3. Start XAMPP

Start:

* Apache
* MySQL

### 4. Create the database

Open phpMyAdmin and create the required database.

Import the project's SQL file into the database.

### 5. Configure the database connection

Update the database connection settings according to your local MySQL configuration.

### 6. Run the project

Open the project through:

```text
http://localhost/client-management-system-php-mysql/
```

## 🔒 Security Note

This repository is intended for development and demonstration purposes.

Do not upload:

* Real client information
* Database passwords
* API keys
* Private credentials
* Production configuration files


## 📚 What I Learned

Through this project, I practiced:

* PHP backend development
* MySQL database integration
* CRUD operations
* Authentication
* Form handling and validation
* Database-driven application development
* Debugging and problem solving
* Converting real-world requirements into software functionality

## 🚀 Future Improvements

Possible future improvements include:

* Search and filtering
* Advanced reports
* PDF invoice generation
* Role-based access control
* Improved validation and security
* Backup and restore functionality
* Deployment to a production server

## 👨‍💻 Author

**Ali**

Programmer & Software Developer

GitHub: https://github.com/ez-snippet

---

## 📄 License

This project is created for educational, portfolio, and demonstration purposes.
