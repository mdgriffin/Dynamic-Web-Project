CREATE DATABASE DynamicProject;

USE DynamicProject;

CREATE TABLE Users (
	user_id int AUTO_INCREMENT,
	forename varchar(30),
	surname varchar(30),
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
