CREATE DATABASE magazin_hardware;
USE magazin_hardware;

CREATE TABLE Categories (
	ID INT PRIMARY KEY,
	Name VARCHAR(10) UNIQUE NOT NULL
);

INSERT INTO Categories VALUES
	(0, 'cpu'),
	(1, 'gpu'),
	(2, 'ram');
	(3, 'hdd'),
	(4, 'mb'),
	(5, 'mouse'),
	(6, 'kb'),
	(7, 'cam'),
	(8, 'pc'),
	(9, 'laptop');

CREATE TABLE Products (
	ID INT PRIMARY KEY AUTO_INCREMENT,
	Vendor VARCHAR(32) NOT NULL,
	Name VARCHAR(100) NOT NULL,
	Price INT NOT NULL,
	Category INT NOT NULL,
	FOREIGN KEY (Category) REFERENCES Categories(ID)
);

CREATE TABLE Transactions (
	ID INT PRIMARY KEY AUTO_INCREMENT,
	ProductID INT,
	Quantity INT NOT NULL,
	Date DATETIME NOT NULL,
	FOREIGN KEY (ProductID) REFERENCES Products(ID) ON DELETE CASCADE
);

CREATE TABLE Purchasers (
	ID INT PRIMARY KEY AUTO_INCREMENT,
	Name VARCHAR(32) NOT NULL,
	Phone CHAR(9) NOT NULL,
	Email VARCHAR(64) NOT NULL,
	Address VARCHAR(200) NOT NULL,
	Comments VARCHAR(1024)
);

CREATE TABLE ProcessedPurchasers (
	PID INT PRIMARY KEY,
	FOREIGN KEY (PID) REFERENCES Purchasers(ID)
);

CREATE TABLE Purchases (
	ID INT PRIMARY KEY AUTO_INCREMENT,
	TransactionID INT,
	PurchaserID INT,
	FOREIGN KEY (TransactionID) REFERENCES Transactions(ID) ON DELETE CASCADE,
	FOREIGN KEY (PurchaserID) REFERENCES Purchasers(ID) ON DELETE CASCADE
);

CREATE TABLE EndUsers (
	Name VARCHAR(16) PRIMARY KEY,
	Password CHAR(40) NOT NULL,
	Privilege INT NOT NULL,
	JSON BLOB
);

DELIMITER $$
CREATE PROCEDURE add_update_enduser(user VARCHAR(32), pwd CHAR(40), priv INT)
BEGIN
	DECLARE n INT;
	SELECT COUNT(*) INTO n FROM EndUsers WHERE Name = user;

	IF n > 0 THEN
		UPDATE EndUsers SET Password = COALESCE(pwd, Password), Privilege = priv WHERE Name = user;
	ELSEIF pwd IS NOT NULL THEN
		INSERT INTO EndUsers VALUES (user, pwd, priv, NULL);
	END IF;
END$$
DELIMITER ;

CREATE VIEW ProductsView AS
	SELECT A.ID id, Vendor vendor, A.Name name, Price price, B.Name category
	FROM Products A INNER JOIN Categories B ON Category = B.ID
	ORDER BY id;