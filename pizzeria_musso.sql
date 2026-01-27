DROP DATABASE IF EXISTS pizzeria_musso;

CREATE DATABASE pizzeria_musso;

USE pizzeria_musso;

CREATE TABLE clients (
	id_client INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(24) NOT NULL,
	address VARCHAR(64) NOT NULL,
	phone VARCHAR(16) NOT NULL,
	email VARCHAR(48) NOT NULL,
	birthdate DATE NOT NULL
);

CREATE TABLE users (
	id_user INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(16) NOT NULL,
	password CHAR(32) NOT NULL,
	id_client INT UNSIGNED NOT NULL,
	FOREIGN KEY (id_client) REFERENCES clients(id_client)
);


INSERT INTO clients (name, address, phone, email, birthdate)
VALUES ('administratore', 'Calle Falsa, 123', '666 666 666', 'admin@pizzeriamusso.it', '1883-07-29');

INSERT INTO users (username, password, id_client)
VALUES ('root', MD5('enti'), 1);




DROP USER IF EXISTS 'admin_db'@'localhost';

CREATE USER 'admin_db'@'localhost' IDENTIFIED BY 'enti';

GRANT ALL PRIVILEGES ON pizzeria_musso.* TO 'admin_db'@'localhost';
