-- -----------------------------------------
-- Database: task_manager
-- -----------------------------------------
CREATE DATABASE IF NOT EXISTS task_manager;
USE task_manager;

-- -----------------------------------------
-- Users Table
-- -----------------------------------------
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- -----------------------------------------
-- Tasks Table
-- -----------------------------------------
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('pending','in_progress','completed') NOT NULL DEFAULT 'pending',
    priority ENUM('low','medium','high') NOT NULL DEFAULT 'medium',
    due_date DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_user_id (user_id),
    INDEX idx_status (status),

    CONSTRAINT fk_tasks_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);

-- -----------------------------------------
-- Sample Users (password: password123)
-- -----------------------------------------
INSERT INTO users (email, password) VALUES
('user1@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('user2@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- -----------------------------------------
-- Sample Tasks (10 records)
-- -----------------------------------------
INSERT INTO tasks (user_id, title, description, status, priority, due_date) VALUES
(1,'Prepare report','Monthly sales report','pending','high','2025-12-20'),
(1,'Fix bugs','Resolve critical bugs','in_progress','medium','2025-12-22'),
(1,'Client call','Discussion with client','completed','low','2025-12-15'),
(1,'Code review','Review team PRs','pending','medium','2025-12-25'),
(1,'Backup DB','Database backup','completed','high','2025-12-10'),

(2,'Deploy app','Production deployment','pending','high','2025-12-28'),
(2,'UI changes','Improve dashboard UI','in_progress','medium','2025-12-26'),
(2,'Write docs','API documentation','completed','low','2025-12-18'),
(2,'Performance test','Load testing','pending','medium','2025-12-30'),
(2,'Security audit','Audit application','pending','high','2025-12-29');
