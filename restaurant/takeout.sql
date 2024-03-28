CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    order_item VARCHAR(100) NOT NULL,
    location VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    date_ordered DATE NOT NULL,
    time_ordered TIME NOT NULL
);
