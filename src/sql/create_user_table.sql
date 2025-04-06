CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Auto-incrementing ID, unique and not null
    username VARCHAR(255) NOT NULL,     -- Username column, not null
    password VARCHAR(255) NOT NULL,     -- Password column, not null
    email VARCHAR(255) NOT NULL,        -- Email column, not null
    UNIQUE (email)                     -- Ensures email is unique across the table
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);
