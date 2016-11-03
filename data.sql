CREATE DATABASE DynamicProject;

USE DynamicProject;

CREATE TABLE Users (
	user_id int NOT NULL AUTO_INCREMENT,
	title char(30) NOT NULL,
	forename varchar(30) NOT NULL,
	surname varchar(30) NOT NULL,
	email varchar(40) NOT NULL,
	password char(32) NOT NULL,
	telephone varchar(20),
	PRIMARY KEY (user_id)
);

DESCRIBE Users;

SELECT * FROM Users;

INSERT INTO Users (forename, surname) VALUES('Michael', 'Griffin');
INSERT INTO Users (forename, surname) VALUES('Tom', 'Brien');
INSERT INTO Users (forename, surname) VALUES('Zygmunt', 'Wypych');
INSERT INTO Users (forename, surname) VALUES('Wayne', 'Rooney');
INSERT INTO Users (forename, surname) VALUES('Mary', 'Fleming');
INSERT INTO Users (forename, surname) VALUES('Anne', 'Anderson');
INSERT INTO Users (forename, surname) VALUES('Phillip', 'Reilly');

CREATE TABLE Hotel (
	hotel_id int NOT NULL AUTO_INCREMENT,
	name varchar(60) NOT NULL,
	address varchar(120) NOT NULL,
	description varchar(255) NOT NULL,
	latitude FLOAT( 10, 6 ) NOT NULL,
	longitude FLOAT( 10, 6 ) NOT NULL,
	PRIMARY KEY (hotel_id)
);
