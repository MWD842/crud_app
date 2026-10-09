# CRUD Application in PHP

A small web app for managing a list of students. You can **C**reate, **R**ead, **U**pdate and **D**elete student records stored in a MySQL database.

It's built with plain PHP (no framework), MySQL through `mysqli`, and Bootstrap 5 for styling. It's a learning project for practicing the basics of PHP and databases.

## Features

- **View** all students in a table (ID, first name, last name, age).
- **Add** a student from a pop-up form (Bootstrap modal). The first name is required.
- **Update** a student on a separate page, with the form already filled in with their current data.
- **Delete** a student with one click.
- A message appears after each action, green for success and red for errors or deletions.

## Requirements

- [XAMPP](https://www.apachefriends.org/), or any setup with Apache, PHP 8+ and MySQL/MariaDB
- A web browser with internet access, because Bootstrap loads from a CDN

## Setup

1. **Copy the project** into XAMPP's web folder:
   ```
   C:\xampp\htdocs\crud_app
   ```

2. **Start Apache and MySQL** from the XAMPP Control Panel.

3. **Create the database and table.** Open [phpMyAdmin](http://localhost/phpmyadmin), go to the **SQL** tab and run:
   ```sql
   CREATE DATABASE crud_operations;

   USE crud_operations;

   CREATE TABLE `students` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `firstName` varchar(255) NOT NULL,
     `lastName` varchar(255) NOT NULL,
     `age` int(3) NOT NULL,
     PRIMARY KEY (`id`)
   );
   ```

4. **Check the database login** in `dbconnection.php`. The defaults match a fresh XAMPP install (user `root`, no password):
   ```php
   define("HOSTNAME","localhost");
   define("USERNAME","root");
   define("PASSWORD","");
   define("DATABASE","crud_operations");
   ```

5. **Open the app** at <http://localhost/crud_app/>.

## Project structure

| File | What it does |
|---|---|
| `index.php` | Main page. Lists all students, has the **ADD STUDENT** pop-up form, and shows success/error messages. |
| `insert_data.php` | Receives the add form, checks that a first name was entered, inserts the student, then redirects back to `index.php`. |
| `update.php` | Shows a form filled with one student's data. On submit, saves the changes and redirects back to `index.php`. |
| `delete.php` | Deletes the student whose id is in the URL, then redirects back to `index.php`. |
| `dbconnection.php` | Connects to MySQL. Every page that uses the database includes it. It creates the `$connection` variable. |
| `header.php` | Top of every page: loads Bootstrap and `style.css`, shows the title bar and icon, and opens the page container. |
| `footer.php` | Bottom of every page: closes the container and loads Bootstrap's JavaScript, which the pop-up form needs. |
| `style.css` | Custom styles (title bar, layout, icon size, message colors). |
| `public/icon.png` | Logo in the title bar. Clicking it goes back to the home page. |

## How it works

Every action follows the same pattern: a page sends data to a PHP file, the PHP file runs a SQL query, then it **redirects** back to `index.php` with a message in the URL.

```
Add:     index.php (pop-up form) ──POST──▶ insert_data.php ──INSERT──▶ index.php?insert_msg=...
Update:  index.php ──"Update" link──▶ update.php?id=5 ──POST──▶ UPDATE ──▶ index.php?update_msg=...
Delete:  index.php ──"Delete" link──▶ delete.php?id=5 ──DELETE──▶ index.php?delete_msg=...
```

`index.php` checks the URL for these message names and displays them:

| URL parameter | Shown as | Color |
|---|---|---|
| `message` | Validation error (e.g. missing first name) | Red (`h6`) |
| `insert_msg` | Student added | Green (`h5`) |
| `update_msg` | Student updated | Green (`h5`) |
| `delete_msg` | Student deleted | Red (`h6`) |

## Known issues

This is a practice project, and some parts aren't safe or finished yet:

- **SQL injection.** User input goes straight into SQL queries in `insert_data.php`, `update.php` and `delete.php`. A name containing `'` (like `O'Brien`) makes the query fail, and a malicious user could change or erase data. The fix is prepared statements (`mysqli_prepare`).
- **Unescaped output.** Messages from the URL and data from the database are printed without `htmlspecialchars()`, so someone could inject HTML or JavaScript into the page.
- **Delete doesn't redirect.** `delete.php` includes `header.php` (which sends HTML) before calling `header('location:...')`, so the redirect fails with a "headers already sent" warning and you stay on a blank page. Moving the delete code above `include('header.php')` fixes it, the same way `update.php` already does.
- **No confirmation before deleting.** One click on **Delete** removes the record immediately.
- **Limited validation.** Only the first name is checked. Age accepts any text.
