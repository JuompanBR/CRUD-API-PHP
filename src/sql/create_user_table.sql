CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL
);

-- Generate sample user data 
INSERT INTO
  users (username, password, email)
VALUES
  ('user', 'user', 'user@user.com'),
  ('admin', 'admin', 'admin@admin.com');
