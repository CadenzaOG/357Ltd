CREATE TABLE customer (
                          customer_id int AUTO_INCREMENT PRIMARY KEY,
                          forename varchar(64),
                          surname varchar(64),
                          email varchar(128),
                          student_number varchar(8),
                          house varchar(64),
                          street varchar(64),
                          town varchar(64),
                          postcode varchar(12),
                          password varchar(256)
);

CREATE TABLE category (
                          category_id int AUTO_INCREMENT PRIMARY KEY,
                          description varchar(32)
);

CREATE TABLE product (
                         product_id int AUTO_INCREMENT PRIMARY KEY,
                         name varchar(64),
                         description varchar(1024),
                         price DEC(7,2),
                         category_id int(11),
                         FOREIGN KEY (category_id) REFERENCES category(category_id)
);

CREATE TABLE customer_order (
                                order_id int PRIMARY KEY NOT NULL,
                                customer_id int(8),
                                order_date date,
                                order_time time,
                                FOREIGN KEY (customer_id) REFERENCES customer(customer_id)
);

CREATE TABLE order_product (
                               order_id int NOT NULL PRIMARY KEY,
                               product_id int NOT NULL,
                               quantity int(4) NOT NULL,
                               FOREIGN KEY (product_id) REFERENCES product(product_id),
                               FOREIGN KEY (order_id) REFERENCES customer_order(order_id)
);




