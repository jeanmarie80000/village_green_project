CREATE TABLE supplier(
   sup_id INT AUTO_INCREMENT,
   adress VARCHAR(50) ,
   surName VARCHAR(30)  NOT NULL,
   firstName VARCHAR(30)  NOT NULL,
   phone VARCHAR(20) ,
   email VARCHAR(50)  NOT NULL,
   PRIMARY KEY(sup_id)
);

CREATE TABLE Rubrique(
   r_id INT AUTO_INCREMENT,
   name VARCHAR(50)  NOT NULL,
   PRIMARY KEY(r_id)
);

CREATE TABLE Employee(
   emp_id INT AUTO_INCREMENT,
   team VARCHAR(15) ,
   surName VARCHAR(30)  NOT NULL,
   adress VARCHAR(255)  NOT NULL,
   postCode VARCHAR(6)  NOT NULL,
   firstName VARCHAR(30)  NOT NULL,
   sup_id INT NOT NULL,
   emp_id_1 INT,
   PRIMARY KEY(emp_id),
   FOREIGN KEY(sup_id) REFERENCES supplier(sup_id),
   FOREIGN KEY(emp_id_1) REFERENCES Employee(emp_id)
);

CREATE TABLE Users(
   user_id INT AUTO_INCREMENT,
   statut BOOLEAN NOT NULL,
   surName VARCHAR(30)  NOT NULL,
   firstName VARCHAR(30)  NOT NULL,
   billingAdress VARCHAR(255)  NOT NULL,
   billingPostCode VARCHAR(6)  NOT NULL,
   deliveryAdress VARCHAR(255) ,
   deliveryPostCode VARCHAR(6) ,
   email VARCHAR(50)  NOT NULL,
   password VARCHAR(50)  NOT NULL,
   archive VARCHAR(50) ,
   emp_id INT NOT NULL,
   PRIMARY KEY(user_id),
   FOREIGN KEY(emp_id) REFERENCES Employee(emp_id)
);

CREATE TABLE Commande(
   com_id INT AUTO_INCREMENT,
   dateCom DATETIME NOT NULL,
   numDeliveryCode VARCHAR(15)  NOT NULL,
   dateDelivery DATETIME NOT NULL,
   coefCli SMALLINT NOT NULL,
   billPrice DECIMAL(5,2)   NOT NULL,
   user_id INT NOT NULL,
   emp_id INT NOT NULL,
   PRIMARY KEY(com_id),
   FOREIGN KEY(user_id) REFERENCES Users(user_id),
   FOREIGN KEY(emp_id) REFERENCES Employee(emp_id)
);

CREATE TABLE sousRubrique(
   sr_id INT AUTO_INCREMENT,
   name VARCHAR(50)  NOT NULL,
   r_id INT NOT NULL,
   PRIMARY KEY(sr_id),
   FOREIGN KEY(r_id) REFERENCES Rubrique(r_id)
);

CREATE TABLE Product(
   prod_id INT AUTO_INCREMENT,
   name VARCHAR(30)  NOT NULL,
   label VARCHAR(50)  NOT NULL,
   descri TEXT NOT NULL,
   dateCreate DATETIME NOT NULL,
   price DECIMAL(5,2)   NOT NULL,
   sup_id INT NOT NULL,
   sr_id INT NOT NULL,
   PRIMARY KEY(prod_id),
   FOREIGN KEY(sup_id) REFERENCES supplier(sup_id),
   FOREIGN KEY(sr_id) REFERENCES sousRubrique(sr_id)
);

CREATE TABLE banquePhoto(
   pho_id INT AUTO_INCREMENT,
   photo VARCHAR(255) ,
   r_id INT NOT NULL,
   sr_id INT NOT NULL,
   prod_id INT NOT NULL,
   PRIMARY KEY(pho_id),
   UNIQUE(r_id),
   UNIQUE(sr_id),
   FOREIGN KEY(r_id) REFERENCES Rubrique(r_id),
   FOREIGN KEY(sr_id) REFERENCES sousRubrique(sr_id),
   FOREIGN KEY(prod_id) REFERENCES Product(prod_id)
);

CREATE TABLE controle(
   com_id INT,
   prod_id INT,
   PRIMARY KEY(com_id, prod_id),
   FOREIGN KEY(com_id) REFERENCES Commande(com_id),
   FOREIGN KEY(prod_id) REFERENCES Product(prod_id)
);

CREATE TABLE achete(
   user_id INT,
   prod_id INT,
   PRIMARY KEY(user_id, prod_id),
   FOREIGN KEY(user_id) REFERENCES Users(user_id),
   FOREIGN KEY(prod_id) REFERENCES Product(prod_id)
);
