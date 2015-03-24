CREATE cuisine_service_db;

CREATE TABLE categories
(
  ID INT,
  name VARCHAR (30) NOT NULL,
  parent_ID INT references categories (ID),
  PRIMARY KEY (ID)
);

CREATE TABLE dishes
(
  ID INT,
  name  VARCHAR (40) NOT NULL,
  price DOUBLE NOT NULL,
  category_ID INT references categories (ID),
  active BOOLEAN,
  description VARCHAR (300),
  PRIMARY KEY (ID)
);
CREATE TABLE orders
(
  ID INT,
  status INT,
  contact_number VARCHAR (10) NOT NULL,
  adress VARCHAR (100) NOT NUL,
  checksum INT,
  checkdate INT,
  comments VARCHAR (200),
  PRIMARY KEY (ID)
);

CREATE TABLE orders_dishes
(  
  order_ID INT references orders (ID) NOT NULL,
  dishes_ID INT references dishes (ID) NOT NULL,
  amount INT NOT NULL
);

INSERT INTO categories VALUES (1, 'European', null);
INSERT INTO categories VALUES (2, 'East asian', null);
INSERT INTO categories VALUES (3, 'Central asian', null);
