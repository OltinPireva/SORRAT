CREATE DATABASE task_management;

USE task_management;

-- Tabela për përdoruesit
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'employee') NOT NULL
);

-- Tabela për detyrat
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(255) NOT NULL,
    description TEXT,
    deadline DATE NOT NULL,
    assigned_to INT,
    FOREIGN KEY (assigned_to) REFERENCES users(id)
);
