CREATE DATABASE DynamicProject;

USE DynamicProject;

CREATE TABLE Admins (
	admin_id int NOT NULL AUTO_INCREMENT,
	title char(30) NOT NULL,
	forename varchar(30) NOT NULL,
	surname varchar(30) NOT NULL,
	email varchar(40) NOT NULL,
	password char(32) NOT NULL,
	PRIMARY KEY (admin_id)
);

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

CREATE TABLE Manangers (
	manager_id int NOT NULL AUTO_INCREMENT,
	title char(30) NOT NULL,
	forename varchar(30) NOT NULL,
	surname varchar(30) NOT NULL,
	email varchar(40) NOT NULL,
	password char(32) NOT NULL,
	telephone varchar(20),
	PRIMARY KEY (manager_id)
);

CREATE TABLE Venues (
	venue_id int NOT NULL AUTO_INCREMENT,
	name varchar(60) NOT NULL,
	address varchar(120) NOT NULL,
	description varchar(255) NOT NULL,
	latitude FLOAT( 10, 6 ) NOT NULL,
	longitude FLOAT( 10, 6 ) NOT NULL,
	PRIMARY KEY (venue_id)
);
