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

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    category_id INT,
    CONSTRAINT product_category_id_fk FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL
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
    CONSTRAINT order_products_product_id_fk FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);
INSERT INTO categories (name) VALUES 
('Coffee'),
('Ice Cream'),
('Pastries'),
('Sandwiches'),
('Cold Beverages'),
('Hot Drinks');
INSERT INTO products (product_name, image, price, quantity, category_id) 
VALUES 
    ('Espresso', 'espresso.png', 30.00, 1, 1), 
    ('Cappuccino', 'cappuccino.png', 40.00, 1, 1), 
    ('Latte', 'latte.png', 45.00, 1, 1), 
    ('Green Tea', 'green_tea.png', 25.00, 1, 6), 
    ('Chocolate Ice Cream', 'chocolate_ice_cream.png', 25.00, 1, 2), 
    ('Vanilla Ice Cream', 'vanilla_ice_cream.png', 22.00, 1, 2), 
    ('Strawberry Ice Cream', 'strawberry_ice_cream.png', 28.00, 1, 2), 
    ('Cheesecake', 'cheesecake.png', 50.00, 1, 3), 
    ('Chocolate Cake', 'chocolate_cake.png', 55.00, 1, 3), 
    ('Mocha', 'mocha.png', 42.00, 25, 1),
    ('Milkshake Chocolate', 'milkshake_chocolate.png', 42.00, 1, 1)
    ;
create or replace view product_with_category
    as select product_id, product_name, image, price, quantity, name as category_name ,products.category_id
    from products, categories
    where categories.category_id= products.category_id;
    select * from product_with_category;
    




