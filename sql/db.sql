CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL
);

CREATE TABLE certifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) UNIQUE NOT NULL,
    Title VARCHAR(30) NOT NULL,
    organisation VARCHAR(40) NOT NULL,
    description VARCHAR(250) NULL,
    image VARCHAR(255) NULL,
    url VARCHAR(255) NULL,
    issuer VARCHAR(100) NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) UNIQUE NOT NULL,
    Title VARCHAR(30) NOT NULL,
    description VARCHAR(250) NULL,
    TechnologiesUsed VARCHAR(100) NOT NULL,
    projectLinks VARCHAR(255) NOT NULL,
    image VARCHAR(255) NULL,
    url VARCHAR(255) NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE skills (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) UNIQUE NOT NULL,
    proficiencyLevel VARCHAR(20) NOT NULL,
    description VARCHAR(250) NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE profile (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NULL,
    last_name VARCHAR(100) NULL,
    bio TEXT NULL,
    image VARCHAR(255) NULL,
    phone VARCHAR(32) NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
