CREATE DATABASE e_life_saver;

USE e_life_saver;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  address VARCHAR(255) NOT NULL,
  type ENUM('patient', 'donor', 'nurse', 'admin') NOT NULL,
  last_login DATETIME,
  UNIQUE KEY (username, type)
);

CREATE TABLE patients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  blood_group ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-') NOT NULL,
  health_facility VARCHAR(255) NOT NULL,
  appeal_status ENUM('active', 'fulfilled', 'expired') NOT NULL DEFAULT 'active',
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE donors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  blood_group ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-') NOT NULL,
  last_donation_date DATE,
  bts_number VARCHAR(255) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE nurses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  health_facility VARCHAR(255) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE health_facilities (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL,
  contact_info VARCHAR(255) NOT NULL
);

CREATE TABLE notifications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  message TEXT NOT NULL,
  recipient_type ENUM('patient', 'donor', 'nurse', 'admin') NOT NULL,
  recipient_id INT NOT NULL,
  timestamp DATETIME NOT NULL,
  FOREIGN KEY (recipient_id) REFERENCES users(id)
);

CREATE TABLE lab_results (
  id INT AUTO_INCREMENT PRIMARY KEY,
  donor_id INT NOT NULL,
  test_type VARCHAR(255) NOT NULL,
  result_value VARCHAR(255) NOT NULL,
  FOREIGN KEY (donor_id) REFERENCES donors(id)
);

CREATE TABLE blood_appeals (
  id INT AUTO_INCREMENT PRIMARY KEY,
  patient_id INT NOT NULL,
  donor_id INT NOT NULL,
  health_facility_id INT NOT NULL,
  status ENUM('active', 'fulfilled', 'expired') NOT NULL DEFAULT 'active',
  FOREIGN KEY (patient_id) REFERENCES patients(id),
  FOREIGN KEY (donor_id) REFERENCES donors(id),
  FOREIGN KEY (health_facility_id) REFERENCES health_facilities(id)
);

CREATE TABLE inventory (
  id INT AUTO_INCREMENT PRIMARY KEY,
  health_facility_id INT NOT NULL,
  item_name VARCHAR(255) NOT NULL,
  quantity INT NOT NULL,
  expiration_date DATE NOT NULL,
  FOREIGN KEY (health_facility_id) REFERENCES health_facilities(id)
);