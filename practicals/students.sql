-- Run this in phpMyAdmin after selecting the shopping_cart database.
CREATE TABLE IF NOT EXISTS students (
  roll_no INT NOT NULL PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  course VARCHAR(100) NOT NULL
);
