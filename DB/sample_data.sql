INSERT INTO car (plate_id, model, year, color, status, price_per_day, office_id)
VALUES 
    ('ABC123', 'Toyota Camry', 2023, 'Silver', 'active', 50, 1),
    ('XYZ987', 'Honda Accord', 2022, 'Black', 'active', 45, 2),
    ('PQR456', 'Ford Mustang', 2021, 'Red', 'rented', 60, 1),
    ('MNO789', 'Tesla Model 3', 2023, 'White', 'active', 75, 2),
    ('UVW321', 'Hyundai Sonata', 2022, 'Blue', 'out_of_service', 40, 1);

INSERT INTO customer (email, customer_pass, ssn, first_name, last_name, driving_license, age, phone)
VALUES
    ('john.doe@example.com', 'password123', 123456789, 'John', 'Doe', 'ABC12345', 35, '555-1234'),
    ('jane.smith@example.com', 'secretpassword', 987654321, 'Jane', 'Smith', 'XYZ67890', 28, '555-5678'),
    ('bob.johnson@example.com', 'strongpassword', 555888111, 'Bob', 'Johnson', 'PQR90123', 42, NULL);

INSERT INTO office (office_location, office_phone)
VALUES
    ('Downtown, Main Street', '555-9876'),
    ('Airport, Terminal 2', '555-0123');

INSERT INTO reservation (customer_id, car_id, office_id, reservation_date, return_date, payment_date, reservation_status, total_price, payment_status)
VALUES
    (1, 2, 1, '2023-12-25', '2023-12-30', '2023-12-25', 'returned', 225, 'payed'),
    (2, 4, 2, '2023-12-28', '2024-01-02', '2023-12-28', 'rented', 300, 'payed'),
    (3, 1, 1, '2023-12-30', NULL, NULL, 'rented', NULL, 'pending');

INSERT INTO admin (admin_email, admin_password, office_id)
VALUES
    ('admin1@example.com', 'adminpassword', 1),
    ('admin2@example.com', 'supersecure', 2);
