CREATE DATABASE IF NOT EXISTS casaforma_pos
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE casaforma_pos;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS ci_sessions;
DROP TABLE IF EXISTS sales;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS users;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'Staff',
    avatar VARCHAR(255) NULL,
    created_at DATETIME NOT NULL,
    deleted_at DATETIME NULL,
    INDEX idx_users_deleted_at (deleted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE customers (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NULL,
    created_at DATETIME NOT NULL,
    deleted_at DATETIME NULL,
    INDEX idx_customers_name (full_name),
    INDEX idx_customers_deleted_at (deleted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock_quantity INT UNSIGNED NOT NULL DEFAULT 0,
    image VARCHAR(255) NULL,
    created_at DATETIME NOT NULL,
    deleted_at DATETIME NULL,
    INDEX idx_products_name (name),
    INDEX idx_products_stock (stock_quantity),
    INDEX idx_products_deleted_at (deleted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE sales (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id INT UNSIGNED NOT NULL,
    customer_id INT UNSIGNED NULL,
    sold_by INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    created_at DATETIME NOT NULL,
    CONSTRAINT fk_sales_product
        FOREIGN KEY (product_id) REFERENCES products(id),
    CONSTRAINT fk_sales_customer
        FOREIGN KEY (customer_id) REFERENCES customers(id),
    CONSTRAINT fk_sales_user
        FOREIGN KEY (sold_by) REFERENCES users(id),
    INDEX idx_sales_created_at (created_at),
    INDEX idx_sales_product (product_id),
    INDEX idx_sales_customer (customer_id),
    INDEX idx_sales_user (sold_by)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ci_sessions (
    id VARCHAR(128) NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    data BLOB NOT NULL,
    KEY idx_ci_sessions_timestamp (timestamp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users
    (username, full_name, password, role, avatar, created_at)
VALUES
    (
        'admin01',
        'Joby Mae M. Miranda',
        '$2y$10$az4PGZcm6QV5wSL.kyYP6OGdrcI/rbjLoNChMk8A1j7DNxB7kmuNy',
        'Administrator',
        NULL,
        NOW()
    ),
    (
        'professor',
        'Faculty Reviewer',
        '$2y$10$lImGbjkt7C4A5gg3O3TpxeRfF5SRJsmGNE.F/QEAhDzIMsqUBX2ae',
        'Reviewer',
        NULL,
        NOW()
    ),
    (
        'cashier01',
        'Mika Santos',
        '$2y$10$az4PGZcm6QV5wSL.kyYP6OGdrcI/rbjLoNChMk8A1j7DNxB7kmuNy',
        'Cashier',
        NULL,
        NOW()
    );

INSERT INTO customers
    (full_name, email, phone, created_at)
VALUES
    ('Andrea Santos', 'andrea.santos@example.com', '0917-321-4401', NOW()),
    ('Miguel Reyes', 'miguel.reyes@example.com', '0918-520-3388', NOW()),
    ('Sofia Garcia', 'sofia.garcia@example.com', '0919-704-1132', NOW()),
    ('Daniel Cruz', 'daniel.cruz@example.com', '0920-881-2210', NOW()),
    ('Isabella Mendoza', 'isabella.mendoza@example.com', '0921-447-0928', NOW()),
    ('Noah Villanueva', 'noah.villanueva@example.com', '0922-115-6830', NOW());

INSERT INTO products
    (name, price, stock_quantity, image, created_at)
VALUES
    ('Arden Three-Seat Sofa', 34990.00, 8, NULL, NOW()),
    ('Luna Lounge Chair', 16990.00, 5, NULL, NOW()),
    ('Solace Coffee Table', 12990.00, 10, NULL, NOW()),
    ('Haven Queen Bed Frame', 28990.00, 4, NULL, NOW()),
    ('Forma Dining Chair', 6990.00, 18, NULL, NOW()),
    ('Oslo Dining Table', 24990.00, 6, NULL, NOW()),
    ('Halo Floor Lamp', 7990.00, 3, NULL, NOW()),
    ('Celine Sideboard', 21990.00, 7, NULL, NOW()),
    ('Noma Bookshelf', 14990.00, 9, NULL, NOW()),
    ('Terra Bedside Table', 8990.00, 12, NULL, NOW()),
    ('Sienna Accent Chair', 13990.00, 2, NULL, NOW()),
    ('Elara Console Table', 17990.00, 0, NULL, NOW());

INSERT INTO sales
    (product_id, customer_id, sold_by, quantity, total_price, created_at)
VALUES
    (3, 1, 1, 1, 12990.00, NOW()),
    (5, NULL, 3, 2, 13980.00, NOW()),
    (7, 2, 1, 1, 7990.00, DATE_SUB(NOW(), INTERVAL 1 DAY)),
    (10, 3, 3, 1, 8990.00, DATE_SUB(NOW(), INTERVAL 2 DAY));