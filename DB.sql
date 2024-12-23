-- Create the database
CREATE DATABASE system;

-- Select the database to use
USE system;

-- Create the users table
CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    age INT(3) NOT NULL,
    county VARCHAR(50) NOT NULL
);
