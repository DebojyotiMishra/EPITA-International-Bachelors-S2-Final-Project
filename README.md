# EPITA Grade Management System

This project is a web-based application designed for managing student grades, courses, and populations at EPITA. It provides functionalities for adding, editing, and deleting student records, managing course details, and analyzing population data.

## Project Structure

The project is organized into several directories, each serving a specific purpose:

- `images/`: Contains image files used in the project.
- `pages/`: Contains PHP files for different pages of the application, such as grades, populations, and welcome page.
- `php_actions/`: Includes PHP scripts for handling actions like adding courses, editing students, login/logout functionalities, and more.
- `scripts/`: Contains JavaScript files for dynamic interaction on the client side, including AJAX calls for form submissions.
- `sql/`: Holds SQL files for database setup and initial data seeding.
- `styles/`: Contains CSS files for styling the web pages, including general styles, login page, and specific styles for grades and populations pages.

## Key Features

- **Student Management**: Add, edit, and delete student records.
- **Course Management**: Add courses and update grades for students.
- **Population Analysis**: View and analyze population data.
- **Authentication**: Login and logout functionality for system access control.

## Setup

To set up the project, follow these steps:

1. Clone the repository to your local machine.
2. Import the SQL file `sql/s2.sql` into your database to set up the schema and initial data.
3. Configure the database connection in `php_actions/db_conn.php` with your database credentials.
4. Serve the project using a PHP server (e.g., Apache or PHP's built-in server).

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Styling**: Custom CSS and system fonts

