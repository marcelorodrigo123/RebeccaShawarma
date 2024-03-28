-- Create Orders database if not exists
IF NOT EXISTS (SELECT 1 FROM sys.databases WHERE name = 'Orders')
    CREATE DATABASE Orders;

-- Use Orders database
USE Orders;

-- Check if the orders table exists
IF NOT EXISTS (SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'orders')
BEGIN
    -- Create orders table
    CREATE TABLE orders (
        id INT IDENTITY(1,1) PRIMARY KEY,
        customer_name VARCHAR(255) NOT NULL,
        order_item VARCHAR(255) NOT NULL,
        location VARCHAR(255) NOT NULL,
        total_amount DECIMAL(10, 2) NOT NULL
    );
END;

-- Insert sample data into the orders table
INSERT INTO orders (customer_name, order_item, location, total_amount) VALUES
('John Doe', 'Shawarma Wrap', 'New York', 10.50),
('Alice Smith', 'Chicken Shawarma Plate', 'Los Angeles', 15.75),
('Bob Johnson', 'Falafel Wrap', 'Chicago', 8.99);

-- Display the tables in the Orders database
SELECT TABLE_NAME
FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA = 'Orders';
