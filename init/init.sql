DROP DATABASE IF EXISTS test;

CREATE DATABASE test;

USE test;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, created_at, updated_at) VALUES
    ('Иван', 'ivan@example.com', NOW(), NOW()),
    ('Мария', 'maria@example.com', NOW(), NOW()),
    ('Петр', 'petr@example.com', NOW(), NOW()),
    ('Petro', 'petro@example.com', NOW(), NOW()),
    ('Ivanko', 'ivanko@example.com', NOW(), NOW()),
    ('Fedir', 'fedir@example.com', NOW(), NOW());

CREATE TABLE user_groups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    is_ban TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
INSERT INTO user_groups (name, is_ban, created_at, updated_at) VALUES
    ('Admin', 0, NOW(), NOW()),
    ('Tester', 0, NOW(), NOW()),
    ('Ban', 1, NOW(), NOW()),
    ('User', 0, NOW(), NOW());

CREATE TABLE user_user_groups (
    user_id INT,
    group_id INT,
    PRIMARY KEY (user_id, group_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (group_id) REFERENCES user_groups(id) ON DELETE CASCADE
);
INSERT INTO user_user_groups (user_id, group_id) VALUES
    (1, 1),
    (2, 2),
    (3, 4),
    (4, 4),
    (4, 3),
    (5, 4),
    (6, 4);

CREATE TABLE permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

INSERT INTO permissions (name) VALUES
    ('read_messages'),
    ('send_messages'),
    ('reply_messages'),
    ('edit_messages'),
    ('delete_messages'),
    ('service_api'),
    ('debug');

CREATE TABLE user_group_permissions (
    group_id INT,
    permission_id INT,
    PRIMARY KEY (group_id, permission_id),
    FOREIGN KEY (group_id) REFERENCES user_groups(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE
);

INSERT INTO user_group_permissions (group_id, permission_id) VALUES
    (1, 1),
    (1, 2),
    (1, 3),
    (1, 4),
    (1, 5),
    (1, 6),
    (1, 7),
    (2, 1),
    (2, 2),
    (2, 3),
    (2, 6),
    (3, 2),
    (3, 3),
    (4, 1),
    (4, 2),
    (4, 3);

