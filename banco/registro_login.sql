CREATE DATABASE registro_login;
USE registro_login;

CREATE TABLE logins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL
);