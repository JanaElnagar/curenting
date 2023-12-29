CREATE DATABASE curenting;

USE curenting;

CREATE TABLE car(
    car_id INT AUTO_INCREMENT NOT NULL,
    plate_id VARCHAR(10) NOT NULL,
    model VARCHAR(255) NOT NULL,
    `year` INT, 
    color VARCHAR(20),
    `status` ENUM('active', 'out_of_service', 'rented'),
    price_per_day FLOAT NOT NULL,
    office_id INT NOT NULL,
    PRIMARY KEY (car_id),
    FOREIGN KEY (office_id) REFERENCES office (office_id)
);

CREATE TABLE customer(
    customer_id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(25),
    customer_pass VARCHAR(50),
    ssn INT NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    driving_license VARCHAR(20) NOT NULL,
    age INT NOT NULL,
    phone VARCHAR(12),  
    PRIMARY KEY (customer_id)
);

CREATE TABLE office(
    office_id INT AUTO_INCREMENT NOT NULL,
    office_location VARCHAR(255),
    office_phone VARCHAR(12),
    PRIMARY KEY (office_id)
);

CREATE TABLE reservation(
    reservation_id INT AUTO_INCREMENT NOT NULL,
    customer_id INT NOT NULL,
    car_id INT NOT NULL,
    office_id INT NOT NULL,
    reservation_date DATE NOT NULL,
    return_date DATE DEFAULT NULL,
    payment_date DATE DEFAULT NULL,
    reservation_status ENUM('rented', 'returned'),
    total_price FLOAT DEFAULT NULL,
    payment_status ENUM('payed', 'pending'),
    PRIMARY KEY (reservation_id),
    FOREIGN KEY(customer_id) REFERENCES customer (customer_id),
    FOREIGN KEY (car_id) REFERENCES car (car_id)
);

CREATE TABLE admin(
    admin_id INT AUTO_INCREMENT NOT NULL,
    admin_email VARCHAR(25),
    admin_password VARCHAR(50),
    office_id INT NOT NULL,

    PRIMARY KEY (admin_id),
    FOREIGN KEY (office_id) REFERENCES office (office_id)
)
