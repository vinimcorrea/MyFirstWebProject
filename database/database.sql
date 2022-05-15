/*******************************************************************************
   Denver Database - Version 1.4
   Script: denver_Sqlite.sql
   Description: Creates and populates the Denver Deliever database.
   DB Server: Sqlite
   Author: Vinícius Corrêa
   License: http://www.codeplex.com/ChinookDatabase/license
********************************************************************************/

.bail on
.mode columns
.header on
.nullvalue NULL

PRAGMA foreign_keys = ON;


DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Menu;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS Customer;
DROP TABLE IF EXISTS Orders;

/*******************************************************************************
   Create Tables
********************************************************************************/


CREATE TABLE Restaurant(
	RestaurantId INTEGER PRIMARY KEY,
	RestaurantName VARCHAR(50),
	Street VARCHAR(50),
	City VARCHAR(50),
	Province VARCHAR(50),
	Country VARCHAR(50),
	Review REAL CONSTRAINT outOfReview CHECK (review > 0 and review <= 5),
	Price VARCHAR(3),
	OwnerId REFERENCES Owner ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE Menu(
	IdMenu INTEGER PRIMARY KEY,
	RestaurantId REFERENCES Restaurant ON DELETE SET NULL ON UPDATE CASCADE,
	MenuName VARCHAR(75),
	Summary TEXT,
	UpdatedAt DATE,
	Content TEXT,
	
);

CREATE TABLE Dish(
	MenuId REFERENCES Menu ON DELETE SET NULL ON UPDATE CASCADE,
	CategoryId REFERENCES Category ON DELETE SET NULL ON UPDATE CASCADE,
	Name VARCHAR,
	Photo TEXT,
	Price REAL,
	Ingredients TEXT,
	Vegan BOOLEAN,
	PRIMARY KEY(MenuId, CategoryId)
);


/* Creating the 3 types of user, (Owner, Customer and Driver) */

CREATE TABLE User(
	UserId INTEGER PRIMARY KEY NOT NULL,
	Password VARCHAR(32) NOT NULL,
    Email VARCHAR(50) NOT NULL UNIQUE, 
    FirstName VARCHAR(30) NOT NULL,
    LastName VARCHAR(30) NOT NULL,
    Mobile VARCHAR(15) NOT NULL UNIQUE,
    AddressC VARCHAR(70),
    City VARCHAR(40),
    State VARCHAR(40),
    Country VARCHAR(40),
    Gender VARCHAR(10) CONSTRAINT genderUser CHECK(Gender in ('Male', 'Female', 'Other'), 
    DateOfBirth DATE,
);


CREATE TABLE Owner(
	OwnerId REFERENCES User ON DELETE SET NULL ON UPDATE CASCADE,
	RestarauntId REFERENCES Restaurant ON DELETE SET NULL ON UPDATE CASCADE,
	PRIMARY KEY(OwnerId)
);

CREATE TABLE Customer(
    CustomerId REFERENCES User ON DELETE SET NULL ON UPDATE CASCADE,
	PRIMARY KEY(CustomerId);
);

CREATE TABLE Driver(
	IdDriver REFERENCES User ON DELETE SET NULL ON UPDATE CASCADE,
	IdRestaurant REFERENCES Restaurant ON DELETE SET NULL ON UPDATE CASCADE,
	PRIMARY KEY(IdDriver)
);

/* finished creating users db */

CREATE TABLE Order(
	OrderId INT PRIMARY KEY,
	CustomerId REFERENCES Customer ON DELETE SET NULL ON UPDATE CASCADE,
	RestaurantId REFERENCES Restaurant ON DELETE SET NULL ON UPDATE CASCADE,
	TotalPrice FLOAT,
	TimeToArrive FLOAT,
	StatusOrder VARCHAR(20) CONSTRAINT statusFood CHECK(StatusOrder in ('Received Order', 'Preparing', 'Delivering', 'Delivered')),	
	Price FLOAT,
	IsPaid BOOLEAN,
	Note VARCHAR(500)
);


CREATE TABLE Category(
	CategoryId INT PRIMARY KEY,
	name TEXT NOT NULL,
	Description VARCHAR(100) NOT NULL,
	
);

CREATE TABLE ReviewRestaurant(
	ReviewId INT PRIMARY KEY NOT NULL,
	CustomerId REFERENCES Customer ON DELETE SET NULL ON UPDATE CASCADE,
	RestaurantId REFERENCES Restaurant ON DELETE SET NULL ON UPDATE CASCADE,
	Comment VARCHAR(500),
	Stars VARCHAR(5)
);

CREATE TABLE ReviewDish(
	ReviewId INT PRIMARY KEY NOT NULL,
	CustomerId REFERENCES Customer ON DELETE SET NULL ON UPDATE CASCADE,
	DishId REFERENCES Dish ON DELETE SET NULL ON UPDATE CASCADE,
	Comment VARCHAR(500),
	Stars VARCHAR(5)
);

CREATEA TABLE Images(
	ImagesId REFERENCES Restaurant ON DELETE SET NULL ON UPDATE CASCADE,
	
)
