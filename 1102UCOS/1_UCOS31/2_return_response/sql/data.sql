CREATE TABLE user_accounts (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255),
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	password TEXT,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

-- CREATE TABLE branches (
-- 	branch_id INT AUTO_INCREMENT PRIMARY KEY,
-- 	address VARCHAR(255),
-- 	head_manager VARCHAR(255),
-- 	contact_number VARCHAR(255),
-- 	added_by VARCHAR (255),
-- 	last_updated TIMESTAMP,
-- 	last_updated_by VARCHAR (255)
-- );