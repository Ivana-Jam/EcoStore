CREATE TABLE ratings (
  ratingID int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  idUsers int(11) NOT NULL,
  productID int(3) NOT NULL,
  Rating int(1) NOT NULL,
  comment VARCHAR(100),
  FOREIGN KEY(productID) REFERENCES inventory(productID)
  ON DELETE CASCADE,
  FOREIGN KEY(idUsers) REFERENCES users(idUsers)
  ON DELETE CASCADE
);
