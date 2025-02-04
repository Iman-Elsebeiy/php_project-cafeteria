-- users [#user_id,name,email,password,room_no,ext,image,role,image,reg_date]
-- product [#product_id,name,image,avilability,price,quantity ,category_id(fk)]
-- category [#category_id,name]
-- order [#order_id,status, date,user_id(fk)]
-- order_products[#order_id(fk),#product_id(fk),quantity]

CREATE Database cafe;
USE cafe;
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    room_no VARCHAR(255) NOT NULL,
    ext VARCHAR(50),
    image VARCHAR(255),
    role ENUM('admin', 'user') NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE product (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    availability BOOLEAN DEFAULT TRUE,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    category_id INT,
    CONSTRAINT product_category_id_fk FOREIGN KEY (category_id) REFERENCES category(category_id) ON DELETE SET NULL
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    status ENUM('pending', 'completed', 'canceled') DEFAULT 'pending',
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
   CONSTRAINT orders_user_id_fk FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
);

CREATE TABLE order_products (
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    PRIMARY KEY (order_id, product_id),
    CONSTRAINT order_products_order_id_fk FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    CONSTRAINT order_products_product_id_fk FOREIGN KEY (product_id) REFERENCES product(product_id) ON DELETE CASCADE
);

