CREATE TABLE customer (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    forename VARCHAR(64),
    surname VARCHAR(64),
    email VARCHAR(128),
    student_number VARCHAR(8),
    house VARCHAR(64),
    street VARCHAR(64),
    town VARCHAR(64),
    postcode VARCHAR(12),
    password VARCHAR(256)
);

CREATE TABLE category (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(32)
);

CREATE TABLE product (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64),
    description VARCHAR(1024),
    price DEC(7,2),
    category_id INT(11),
    stock INT(11),
    FOREIGN KEY (category_id) REFERENCES category(category_id)
);

CREATE TABLE customer_order (
    order_id INT PRIMARY KEY NOT NULL,
    customer_id INT(8),
    order_date DATE,
    order_time TIME,
    shipped BOOL,
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id)
);

CREATE TABLE order_product (
    order_id INT NOT NULL PRIMARY KEY,
    product_id INT NOT NULL,
    quantity INT(4) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES product(product_id),
    FOREIGN KEY (order_id) REFERENCES customer_order(order_id)
);
