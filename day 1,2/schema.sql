CREATE DATABASE IF NOT EXISTS task_management;

USE task_management;

-- Create users table
CREATE TABLE users ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(100) NOT NULL, 
    email VARCHAR(150) NOT NULL UNIQUE, 
    password VARCHAR(255) NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
); 

-- Create projects table
CREATE TABLE projects ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    user_id INT NOT NULL, 
    title VARCHAR(150) NOT NULL, 
    description TEXT, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE 
); 

-- Create tasks table
CREATE TABLE tasks ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    project_id INT NOT NULL, 
    title VARCHAR(150) NOT NULL, 
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending', 
    deadline DATE, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE 
); 

-- Insert users
INSERT INTO users (name, email, password) 
VALUES 
('Meto', 'meto@gmail.com', '123456'), 
('Arben', 'arben@gmail.com', '123456'), 
('John', 'john@gmail.com', '123456'); 

-- Show all users
SELECT * FROM users; 

-- Show only name and email
SELECT name, email 
FROM users; 

-- Find user by ID
SELECT * 
FROM users 
WHERE id = 1; 

-- Find user by email
SELECT * 
FROM users 
WHERE email = 'meto@gmail.com'; 

-- Insert projects
INSERT INTO projects (user_id, title, description) 
VALUES 
(1, 'Task Management System', 'System for managing projects and tasks'),
(1, 'University Project', 'Software engineering university project'),
(2, 'Portfolio Website', 'Personal portfolio website'); 

-- Show all projects
SELECT * FROM projects; 

-- Show project title and description
SELECT title, description 
FROM projects; 

-- Show projects belonging to user 1
SELECT * 
FROM projects 
WHERE user_id = 1; 

-- Insert tasks
INSERT INTO tasks (project_id, title, status, deadline) 
VALUES 
(1, 'Design database', 'completed', '2026-09-20'),
(1, 'Build Laravel API', 'in_progress', '2026-09-25'),
(1, 'Create Vue frontend', 'pending', '2026-10-01'),
(2, 'Write documentation', 'pending', '2026-09-30'),
(3, 'Create homepage', 'in_progress', '2026-09-28'); 

-- Show all tasks
SELECT * FROM tasks; 

-- Show pending tasks
SELECT * 
FROM tasks 
WHERE status = 'pending'; 

-- Show completed tasks
SELECT * 
FROM tasks 
WHERE status = 'completed'; 

-- Show tasks belonging to project 1
SELECT * 
FROM tasks 
WHERE project_id = 1; 

-- Find pending tasks with deadline after September 20
SELECT * 
FROM tasks 
WHERE status = 'pending' 
AND deadline > '2026-09-20'; 

-- Show newest tasks first
SELECT * 
FROM tasks 
ORDER BY created_at DESC; 

-- Show tasks by earliest deadline
SELECT * 
FROM tasks 
ORDER BY deadline ASC; 

-- Update task status
UPDATE tasks 
SET status = 'completed' 
WHERE id = 2; 

-- Check updated task
SELECT * 
FROM tasks 
WHERE id = 2; 

-- Update task deadline
UPDATE tasks 
SET deadline = '2026-10-05' 
WHERE id = 2; 

-- Update task status and deadline
UPDATE tasks 
SET 
    status = 'completed', 
    deadline = '2026-10-05' 
WHERE id = 2; 

-- Update project title
UPDATE projects 
SET title = 'Advanced Task Management System' 
WHERE id = 1; 

-- Check updated project
SELECT * 
FROM projects 
WHERE id = 1; 

-- Delete task
DELETE FROM tasks 
WHERE id = 5; 

-- Check remaining tasks
SELECT * FROM tasks; 

-- Join users and projects
SELECT 
    users.name AS user_name, 
    projects.title AS project_title 
FROM users 
JOIN projects 
    ON users.id = projects.user_id; 

-- Join projects and tasks
SELECT 
    projects.title AS project_title, 
    tasks.title AS task_title, 
    tasks.status 
FROM projects 
JOIN tasks 
    ON projects.id = tasks.project_id; 

-- Join users, projects and tasks
SELECT 
    users.name AS user_name, 
    projects.title AS project_title, 
    tasks.title AS task_title, 
    tasks.status, 
    tasks.deadline 
FROM users 
JOIN projects 
    ON users.id = projects.user_id 
JOIN tasks 
    ON projects.id = tasks.project_id; 

-- Show only tasks belonging to user 1
SELECT 
    users.name AS user_name, 
    projects.title AS project_title, 
    tasks.title AS task_title, 
    tasks.status, 
    tasks.deadline 
FROM users 
JOIN projects 
    ON users.id = projects.user_id 
JOIN tasks 
    ON projects.id = tasks.project_id 
WHERE users.id = 1; 

-- Show completed tasks and their owners
SELECT 
    users.name AS user_name, 
    projects.title AS project_title, 
    tasks.title AS task_title, 
    tasks.status 
FROM users 
JOIN projects 
    ON users.id = projects.user_id 
JOIN tasks 
    ON projects.id = tasks.project_id 
WHERE tasks.status = 'completed'; 

-- Count total users
SELECT COUNT(*) AS total_users 
FROM users; 

-- Count total projects
SELECT COUNT(*) AS total_projects 
FROM projects; 

-- Count total tasks
SELECT COUNT(*) AS total_tasks 
FROM tasks; 

-- Count completed tasks
SELECT COUNT(*) AS completed_tasks 
FROM tasks 
WHERE status = 'completed'; 

-- Count pending tasks
SELECT COUNT(*) AS pending_tasks 
FROM tasks 
WHERE status = 'pending'; 

-- Count tasks for each project
SELECT 
    project_id, 
    COUNT(*) AS total_tasks 
FROM tasks 
GROUP BY project_id; 

-- Count tasks for each project with project name
SELECT 
    projects.title AS project_title, 
    COUNT(tasks.id) AS total_tasks 
FROM projects 
LEFT JOIN tasks 
    ON projects.id = tasks.project_id 
GROUP BY projects.id, projects.title; 

-- Find users whose email contains gmail
SELECT * 
FROM users 
WHERE email LIKE '%gmail%';