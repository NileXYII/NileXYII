-- Disable the automatic assignment of values to AUTO_INCREMENT columns
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

-- Start a transaction
START TRANSACTION;

-- Set the timezone
SET time_zone = "+00:00";

-- Create the 'tbl_user' table
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add a primary key to the 'tbl_user' table
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

-- Modify the 'id' column to AUTO_INCREMENT
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

-- Commit the transaction
COMMIT;

-- Start a new transaction for the 'tbl_admin' table
START TRANSACTION;

-- Create the 'tbl_admin' table
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default data into the 'tbl_admin' table
INSERT INTO `tbl_admin` (`id`, `name`, `username`, `password`) 
VALUES (12, 'Yvan', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- Add a primary key to the 'tbl_admin' table
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

-- Modify the 'id' column to AUTO_INCREMENT
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

-- Commit the transaction
COMMIT;

-- Create the 'products' table
CREATE TABLE IF NOT EXISTS `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `stocks` INT NOT NULL,
  `image` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id VARCHAR(50) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    cart_items TEXT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
