CREATE TABLE inventory (
  productID int(3) PRIMARY KEY NOT NULL,
  productName VARCHAR(25) NOT NULL UNIQUE
);

INSERT INTO inventory
VALUES(1, 'Boxed Water');

INSERT INTO inventory
VALUES (2, 'Wooden Cutlery');

INSERT INTO inventory
VALUES (3, 'Reuseable Coffee Capsules');

INSERT INTO inventory
VALUES (4, 'Eco Soap');
