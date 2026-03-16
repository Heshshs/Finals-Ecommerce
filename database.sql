CREATE DATABASE IF NOT EXISTS angat_tv;
USE angat_tv;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(120) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    subscription_status ENUM('inactive', 'active') NOT NULL DEFAULT 'inactive',
    subscription_plan VARCHAR(20) DEFAULT NULL,
    subscription_started_at DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
