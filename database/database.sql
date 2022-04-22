/*******************************************************************************
   Denver Database - Version 1.4
   Script: denver_Sqlite.sql
   Description: Creates and populates the Denver Deliever database.
   DB Server: Sqlite
   Author: Luis Rocha
   License: http://www.codeplex.com/ChinookDatabase/license
********************************************************************************/




DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Menu;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS Customer;
DROP TABLE IF EXISTS Oder;

/*******************************************************************************
   Create Tables
********************************************************************************/


CREATE TABLE Restaurant(
	RestaurantId INTEGER PRIMARY KEY,
	logo BLOB,
	city VARCHAR(50),
	province VARCHAR(50),
	country VARCHAR(50),
	
	
);

CREATE TABLE Menu(
	IdMenu INTEGER,
	RestaurantId REFERENCES Restaurant ON DELETE SET NULL ON UPDATE CASCADE,
	name VARCHAR(75),
	summary TEXT,
	createdAt DATE,
	updatedAt DATE,
	content TEXT,
	PRIMARY KEY(RestaurantId, IdMenu)
	
);

CREATE TABLE Dish(
	DishId INTEGER PRIMARY KEY,
	price REAL,
	ingredients TEXT,
	
	
);

CREATE TABLE Customer(
    CustomerId INTEGER NOT NULL,
    Password VARCHAR(32) NOT NULL,
    Email VARCHAR(50) NOT NULL, 
    FirstName VARCHAR(30) NOT NULL,
    LastName VARCHAR(30) NOT NULL,
    Mobile VARCHAR(15) NOT NULL,
    Address VARCHAR(70),
    City VARCHAR(40),
    State VARCHAR(40),
    Country VARCHAR(40),
    Gender VARCHAR(10) CONSTRAINT genderUser CHECK(Gender in ('Male', 'Female', 'Other'), 
    DateOfBirth DATE,
    profile TEXT
    CONSTRAINT  Pk_Customer PRIMARY KEY (CustomerId),
    CONSTRAINT tooYoung CHECK (DATE('now') - DateOfBirth < 16)
);

CREATE TABLE Oder(
	meal_id INT PRIMARY KEY,
	total FLOAT,
	status VARCHAR(20),
);

