/*******************************************************************************
   Create Tables
********************************************************************************/

DROP TABLE IF EXISTS _Order;
CREATE TABLE _Order (
    OrderId      INTEGER       PRIMARY KEY AUTOINCREMENT,
    CustomerId                 REFERENCES User (Email) ON DELETE SET NULL
                                                       ON UPDATE CASCADE
                               NOT NULL,
    RestaurantId               REFERENCES Restaurant ON DELETE SET NULL
                                                     ON UPDATE CASCADE
                               NOT NULL,
    TotalPrice   FLOAT         NOT NULL,
    DateTime     VARCHAR (100) NOT NULL,
    Status       VARCHAR (40)  NOT NULL,
    Note         VARCHAR (500),
    AddressId    INTEGER       REFERENCES Address (AddressId) ON DELETE SET NULL
                                                              ON UPDATE CASCADE
);

DROP TABLE IF EXISTS Address;
CREATE TABLE Address (
    AddressId      INTEGER      PRIMARY KEY AUTOINCREMENT,
    AddressLineOne VARCHAR (50) NOT NULL,
    AddressLineTwo VARCHAR (50),
    City           VARCHAR (30) NOT NULL,
    Country        VARCHAR (30) CONSTRAINT contryNotFilled NOT NULL,
    postalcode     VARCHAR (30) 
);

DROP TABLE IF EXISTS Category;
CREATE TABLE Category (
    CategoryId INTEGER      PRIMARY KEY,
    name       VARCHAR (50) NOT NULL,
    ImageId    INTEGER      REFERENCES Image (imageID) ON DELETE SET NULL
                                                       ON UPDATE CASCADE
);


DROP TABLE IF EXISTS Dish;
CREATE TABLE Dish (
    DishId       INTEGER PRIMARY KEY AUTOINCREMENT,
    Name         VARCHAR,
    Price        REAL,
    Ingredients  TEXT,
    Vegan        BOOLEAN,
    CategoryId   INTEGER REFERENCES Category (CategoryId) ON DELETE SET NULL
                                                          ON UPDATE CASCADE,
    RestaurantId INTEGER REFERENCES Restaurant (RestaurantId) ON DELETE SET NULL
                                                              ON UPDATE CASCADE
                         NOT NULL,
    ImageId      INTEGER REFERENCES Image (imageID) ON DELETE SET NULL
                                                    ON UPDATE CASCADE
);

DROP TABLE IF EXISTS FavoriteDish;
CREATE TABLE FavoriteDish (
    CustomerId VARCHAR (50) REFERENCES User (Email) ON DELETE SET NULL
                                                    ON UPDATE CASCADE,
    DishId     INTEGER      REFERENCES Dish (DishId) ON DELETE SET NULL
                                                     ON UPDATE CASCADE,
    PRIMARY KEY (
        CustomerId,
        DishId
    )
);

DROP TABLE IF EXISTS FavoriteRestaurant;
CREATE TABLE FavoriteRestaurant (
    CustomerId   VARCHAR (50) REFERENCES Customer (CustomerId) ON DELETE SET NULL
                                                               ON UPDATE CASCADE,
    RestaurantId INTEGER      REFERENCES Restaurant (RestaurantId) ON DELETE SET NULL
                                                                   ON UPDATE CASCADE,
    PRIMARY KEY (
        CustomerId,
        RestaurantId
    )
);

DROP TABLE IF EXISTS Image;
CREATE TABLE Image (
    imageID INTEGER      PRIMARY KEY AUTOINCREMENT,
    title   VARCHAR (50) 
);

DROP TABLE IF EXISTS Menu;
CREATE TABLE Menu (
    MenuId       INTEGER      PRIMARY KEY AUTOINCREMENT,
    RestaurantId              REFERENCES Restaurant ON DELETE SET NULL
                                                    ON UPDATE CASCADE,
    MenuName     VARCHAR (75) 
);


DROP TABLE IF EXISTS OrderedDish;
CREATE TABLE OrderedDish (
    OrderId  INTEGER REFERENCES _Order (OrderId) ON DELETE SET NULL
                                                 ON UPDATE CASCADE,
    DishId   INTEGER REFERENCES Dish (DishId) ON DELETE SET NULL
                                              ON UPDATE CASCADE,
    quantity INTEGER,
    PRIMARY KEY (
        OrderId,
        DishId
    )
);

DROP TABLE IF EXISTS Restaurant;
CREATE TABLE Restaurant (
    RestaurantId   INTEGER      PRIMARY KEY AUTOINCREMENT,
    RestaurantName VARCHAR (50),
    Price          VARCHAR (3),
    CategoryId     INTEGER      REFERENCES Category (CategoryId) ON DELETE SET NULL
                                                                 ON UPDATE CASCADE,
    ImageId        INTEGER      REFERENCES Image (imageID) ON DELETE SET NULL
                                                           ON UPDATE CASCADE
);

DROP TABLE IF EXISTS RestaurantAddress;
CREATE TABLE RestaurantAddress (
    RestaurantId INTEGER REFERENCES Restaurant (RestaurantId) ON DELETE SET NULL
                                                              ON UPDATE CASCADE,
    AddressId    INTEGER REFERENCES Address (AddressId) ON DELETE SET NULL
                                                        ON UPDATE CASCADE,
    PRIMARY KEY (
        RestaurantId,
        AddressId
    )
);

DROP TABLE IF EXISTS RestaurantOwner;
CREATE TABLE RestaurantOwner (
    OwnerId       REFERENCES User ON DELETE SET NULL
                                  ON UPDATE CASCADE,
    RestaurantId  REFERENCES Restaurant ON DELETE SET NULL
                                        ON UPDATE CASCADE,
    PRIMARY KEY (
        RestaurantId
    )
);

DROP TABLE IF EXISTS Review;
CREATE TABLE Review (
    ReviewId     INTEGER       PRIMARY KEY AUTOINCREMENT,
    CustomerId                 REFERENCES Customer ON DELETE SET NULL
                                                   ON UPDATE CASCADE,
    RestaurantId               REFERENCES Restaurant ON DELETE SET NULL
                                                     ON UPDATE CASCADE,
    Comment      VARCHAR (500),
    Stars        VARCHAR (5) 
);


DROP TABLE IF EXISTS User;
CREATE TABLE User (
    Email       VARCHAR (50) PRIMARY KEY,
    Password    VARCHAR (32) NOT NULL,
    FirstName   VARCHAR (30) NOT NULL,
    LastName    VARCHAR (30) NOT NULL,
    Mobile      VARCHAR (15) NOT NULL
                             UNIQUE,
    IsOwner     BOOLEAN,
    HaveAddress BOOLEAN      DEFAULT (false) 
);


DROP TABLE IF EXISTS UserAddress;
CREATE TABLE UserAddress (
    UserId    VARCHAR (50) REFERENCES User (Email) ON DELETE SET NULL
                                                   ON UPDATE CASCADE,
    AddressId INTEGER      REFERENCES Address (AddressId) ON DELETE SET NULL
                                                          ON UPDATE CASCADE,
    PRIMARY KEY (
        UserId,
        AddressId
    )
);

