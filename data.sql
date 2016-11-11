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

CREATE TABLE Venue_Images (
	image_id int NOT NULL AUTO_INCREMENT,
	venue_id int NOT NULL,
	source varchar(64) NOT NULL,
	title varchar(64) NOT NULL,
	PRIMARY KEY (image_id),
	FOREIGN KEY (venue_id) REFERENCES Venues (venue_id)
);

CREATE TABLE Rooms (
	room_id int NOT NULL AUTO_INCREMENT,
	venue_id int NOT NULL,
	capacity int NOT NULL,
	facilites varchar(255) NOT NULL,
	PRIMARY KEY (room_id),
	FOREIGN KEY (venue_id) REFERENCES Venues (venue_id)
);

CREATE TABLE Packages (
	package_id int NOT NULL AUTO_INCREMENT,
	room_id int NOT NULL,
	description varchar(255),
	price_per_guest Decimal(10,2) NOT NULL,
	min_guests int(5) NOT NULL,
	max_guests int(5) NOT NULL,
	start_date date NOT NULL,
	end_date date NOT NULL,
	PRIMARY KEY (package_id),
	FOREIGN KEY (room_id) REFERENCES Rooms (room_id)
);

CREATE TABLE Bookings (
	booking_id int NOT NULL AUTO_INCREMENT,
	user_id int NOT NULL,
	package_id int NOT NULL,
	room_id int NOT NULL,
	num_guests int NOT NULL,
	booking_date date NOT NULL,
	total Decimal(10, 2) NOT NULL,
	PRIMARY KEY (booking_id),
	FOREIGN KEY (user_id) REFERENCES Users (user_id)
	FOREIGN KEY (package_id) REFERENCES Packages (package_id)
	FOREIGN KEY (room_id) REFERENCES Rooms (room_id)

);
