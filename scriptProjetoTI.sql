CREATE DATABASE IF NOT EXISTS ProjetoTI CHARACTER SET utf8 COLLATE UTF8_general_ci;

use ProjetoTI;

CREATE TABLE if not exists admin(
	id int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username varchar(50) NOT NULL,
	pass varchar(500) NOT NULL);
	
CREATE TABLE if not exists utilizadores(
	id int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username varchar(50) NOT NULL,
	pass varchar(500) NOT NULL
	); 
    
CREATE TABLE if not exists guardas(
	id int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username varchar(50) NOT NULL,
	pass varchar(500) NOT NULL
	); 
    
INSERT INTO admin (username ,pass) VALUES
	('admin', '1234');
    
INSERT INTO utilizadores (username ,pass) VALUES
	('user', '4321');
    
INSERT INTO guardas (username ,pass) VALUES
	('guarda', 'agua');
