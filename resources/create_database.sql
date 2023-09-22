create database bugtracker;
use bugtracker;
CREATE TABLE bugs (     id INT AUTO_INCREMENT PRIMARY KEY,
     titulo VARCHAR(255),   
     descricao TEXT,
     status ENUM('Aberto', 'Fechado', 'Em Andamento'), 
     data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP );
