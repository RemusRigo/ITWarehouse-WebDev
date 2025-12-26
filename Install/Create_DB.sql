-- Create Database --------------------------------------------------------------------------------

CREATE DATABASE it_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE it_db;

-- Create Users table -----------------------------------------------------------------------------

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users VALUES (1, 'admin', '$2y$10$lSPDIca/R4P056Jp2KJxLe0JXmtLCZpsmQ2f2cBfbTEq/BBAtHBmG');

-- Create Devices table ---------------------------------------------------------------------------

CREATE TABLE devices (
   id INT AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(100) NOT NULL,
   device VARCHAR(100) NULL,
   manufacturer VARCHAR(100),
   model VARCHAR(100),
   category_id INT NULL,
   inventory VARCHAR(50) NULL,
   ip VARCHAR(15) NULL CHECK (ip = '' OR ip IS NULL OR ip REGEXP '^[0-9]{1,3}(\\.[0-9]{1,3}){3}$'),
   mac VARCHAR(17) CHECK (mac = '' OR mac IS NULL OR mac REGEXP '^[A-Fa-f0-9]{2}(:[A-Fa-f0-9]{2}){5}$'),
   bt VARCHAR(50),
   sn VARCHAR(100),
   pn VARCHAR(100),
   firmware VARCHAR(100),
   location1 VARCHAR(100),
   location2 VARCHAR(100),
   status_id INT DEFAULT 0,
   purchased DATE,
   disposed DATE,
   notes TEXT
);

-- Create Category table --------------------------------------------------------------------------

CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL UNIQUE
);

INSERT INTO category (name) VALUES
('Access Point'),
('Camera'),
('Mobile Computer'),
('Mobile Printer'),
('Printer'),
('Projector'),
('Scanner'),
('Thermal Printers'),
('UPS');

-- Create Status table --------------------------------------------------------------------------

CREATE TABLE status (
    id INT,
    name VARCHAR(30) NOT NULL UNIQUE
);

INSERT INTO status VALUES
(0, 'Active'),
(1, 'Inactive'),
(2, 'Maintenance'),
(3, 'Warehouse'),
(4, 'Disposed');


