/*******************************************************************************
   Create Tables
********************************************************************************/


/* Creating the 3 types of user, (Owner, Customer and Driver) */


DROP TABLE IF EXISTS User;
CREATE TABLE User (
    UserId      INTEGER      PRIMARY KEY,
    Password    VARCHAR (32) NOT NULL,
    Email       VARCHAR (50) NOT NULL
                             UNIQUE,
    FirstName   VARCHAR (30) NOT NULL,
    LastName    VARCHAR (30) NOT NULL,
    Mobile      VARCHAR (15) NOT NULL
                             UNIQUE,
    AddressC    VARCHAR (70),
    City        VARCHAR (40),
    State       VARCHAR (40),
    Country     VARCHAR (40),
    Gender      VARCHAR (10) CONSTRAINT genderUser CHECK (Gender IN ('Male', 'Female', 'Other') ),
    DateOfBirth VARCHAR (40) 
);

DROP TABLE IF EXISTS Owner;
CREATE TABLE Owner(
	OwnerId REFERENCES User ON DELETE SET NULL ON UPDATE CASCADE,
	RestarauntId REFERENCES Restaurant ON DELETE SET NULL ON UPDATE CASCADE,
	PRIMARY KEY(OwnerId)
);

DROP TABLE IF EXISTS Customer;
CREATE TABLE Customer (
    CustomerId REFERENCES User ON DELETE SET NULL
                               ON UPDATE CASCADE,
    PRIMARY KEY (
        CustomerId
    )
);


DROP TABLE IF EXISTS Driver;
CREATE TABLE Driver (
    IdDriver      REFERENCES User ON DELETE SET NULL
                                  ON UPDATE CASCADE,
    IdRestaurant  REFERENCES Restaurant ON DELETE SET NULL
                                        ON UPDATE CASCADE,
    PRIMARY KEY (
        IdDriver
    )
);


DROP TABLE IF EXISTS Restaurant;
CREATE TABLE Restaurant (
    RestaurantId   INTEGER      PRIMARY KEY,
    RestaurantName VARCHAR (50),
    Street         VARCHAR (50),
    City           VARCHAR (50),
    Province       VARCHAR (50),
    Country        VARCHAR (50),
    Review         REAL         CONSTRAINT outOfReview CHECK (review > 0 AND 
                                                              review <= 5),
    Price          VARCHAR (3),
    OwnerId,
    CategoryId     INT          REFERENCES Category (CategoryId) ON DELETE SET NULL
                                                                 ON UPDATE CASCADE
);


DROP TABLE IF EXISTS Category;
CREATE TABLE Category (
    CategoryId INT  PRIMARY KEY,
    name       TEXT NOT NULL
);

DROP TABLE IF EXISTS Menu;
CREATE TABLE Menu (
    MenuId       INTEGER      PRIMARY KEY,
    RestaurantId              REFERENCES Restaurant ON DELETE SET NULL
                                                    ON UPDATE CASCADE,
    MenuName     VARCHAR (75) 
);


DROP TABLE IF EXISTS Dish;
CREATE TABLE Dish (
    MenuId              REFERENCES Menu ON DELETE SET NULL
                                        ON UPDATE CASCADE,
    CategoryId          REFERENCES Category ON DELETE SET NULL
                                            ON UPDATE CASCADE,
    Name        VARCHAR,
    Price       REAL,
    Ingredients TEXT,
    Vegan       BOOLEAN,
    PRIMARY KEY (
        MenuId,
        CategoryId
    )
);

/* finished creating users db */

DROP TABLE IF EXISTS _Order;
CREATE TABLE _Order (
    OrderId      INT           PRIMARY KEY,
    CustomerId                 REFERENCES Customer ON DELETE SET NULL
                                                   ON UPDATE CASCADE,
    RestaurantId               REFERENCES Restaurant ON DELETE SET NULL
                                                     ON UPDATE CASCADE,
    TotalPrice   FLOAT,
    TimeToArrive FLOAT,
    StatusOrder  VARCHAR (20)  CONSTRAINT statusFood CHECK (StatusOrder IN ('Received Order', 'Preparing', 'Delivering', 'Delivered') ),
    Price        FLOAT,
    IsPaid       BOOLEAN,
    Note         VARCHAR (500) 
);


DROP TABLE IF EXISTS ReviewRestaurant;
CREATE TABLE ReviewRestaurant (
    ReviewId     INT           PRIMARY KEY
                               NOT NULL,
    CustomerId                 REFERENCES Customer ON DELETE SET NULL
                                                   ON UPDATE CASCADE,
    RestaurantId               REFERENCES Restaurant ON DELETE SET NULL
                                                     ON UPDATE CASCADE,
    Comment      VARCHAR (500),
    Stars        VARCHAR (5) 
);


DROP TABLE IF EXISTS ReviewDish;
CREATE TABLE ReviewDish (
    ReviewId   INT           PRIMARY KEY
                             NOT NULL,
    CustomerId               REFERENCES Customer ON DELETE SET NULL
                                                 ON UPDATE CASCADE,
    DishId                   REFERENCES Dish ON DELETE SET NULL
                                             ON UPDATE CASCADE,
    Comment    VARCHAR (500),
    Stars      VARCHAR (5) 
);

DROP TABLE IF EXISTS Favorite;
CREATE TABLE Favorite{
    CustomerId INT PRIMARY KEY,
    RetaurantId REFERENCES Restaurant,
    DishId REFERENCES Dish
}