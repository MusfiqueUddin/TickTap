SET FOREIGN_KEY_CHECKS = 0;
CREATE TABLE role (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(50) UNIQUE NOT NULL
);
CREATE TABLE user (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES role(role_id)
);
CREATE TABLE customer (
    customer_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE NOT NULL,
    phone VARCHAR(20),
    address VARCHAR(255),
    date_of_birth DATE,
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);
CREATE TABLE transport_authority (
    authority_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE NOT NULL,
    authority_name VARCHAR(150) NOT NULL,
    contact_info VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);
CREATE TABLE vehicle (
    vehicle_id INT PRIMARY KEY AUTO_INCREMENT,
    authority_id INT NOT NULL,
    vehicle_type ENUM('BUS','TRAIN','FLIGHT') NOT NULL,
    vehicle_name VARCHAR(100),
    total_seats INT NOT NULL,
    FOREIGN KEY (authority_id) REFERENCES transport_authority(authority_id)
);
CREATE TABLE station (
    station_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL
);

CREATE TABLE route (
    route_id INT PRIMARY KEY AUTO_INCREMENT,
    source_station_id INT NOT NULL,
    destination_station_id INT NOT NULL,
    distance_km DECIMAL(6,2),
    FOREIGN KEY (source_station_id) REFERENCES station(station_id),
    FOREIGN KEY (destination_station_id) REFERENCES station(station_id)
);

CREATE TABLE schedule (
    schedule_id INT PRIMARY KEY AUTO_INCREMENT,
    vehicle_id INT NOT NULL,
    route_id INT NOT NULL,
    departure_time DATETIME NOT NULL,
    arrival_time DATETIME NOT NULL,
    schedule_date DATE NOT NULL,
    FOREIGN KEY (vehicle_id) REFERENCES vehicle(vehicle_id),
    FOREIGN KEY (route_id) REFERENCES route(route_id)
);

CREATE TABLE seat (
    seat_id INT PRIMARY KEY AUTO_INCREMENT,
    vehicle_id INT NOT NULL,
    seat_number VARCHAR(10) NOT NULL,
    seat_class ENUM('ECONOMY','BUSINESS','FIRST') DEFAULT 'ECONOMY',
    UNIQUE (vehicle_id, seat_number),
    FOREIGN KEY (vehicle_id) REFERENCES vehicle(vehicle_id)
);

CREATE TABLE booking (
    booking_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT NOT NULL,
    schedule_id INT NOT NULL,
    booking_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('PENDING','CONFIRMED','CANCELLED') DEFAULT 'PENDING',
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
    FOREIGN KEY (schedule_id) REFERENCES schedule(schedule_id)
);

CREATE TABLE ticket (
    ticket_id INT PRIMARY KEY AUTO_INCREMENT,
    booking_id INT NOT NULL,
    seat_id INT NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    status ENUM('BOOKED','CANCELLED') DEFAULT 'BOOKED',
    FOREIGN KEY (booking_id) REFERENCES booking(booking_id),
    FOREIGN KEY (seat_id) REFERENCES seat(seat_id),
    UNIQUE (seat_id, booking_id)
);

CREATE TABLE payment (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    booking_id INT UNIQUE NOT NULL,
    amount DECIMAL(8,2) NOT NULL,
    method ENUM('CARD','MOBILE','BANK') NOT NULL,
    status ENUM('SUCCESS','FAILED','REFUNDED') DEFAULT 'SUCCESS',
    payment_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES booking(booking_id)
);

CREATE TABLE refund (
    refund_id INT PRIMARY KEY AUTO_INCREMENT,
    payment_id INT UNIQUE NOT NULL,
    amount DECIMAL(8,2) NOT NULL,
    refund_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    reason VARCHAR(255),
    FOREIGN KEY (payment_id) REFERENCES payment(payment_id)
);

CREATE TABLE waitlist (
    waitlist_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT NOT NULL,
    schedule_id INT NOT NULL,
    request_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
    FOREIGN KEY (schedule_id) REFERENCES schedule(schedule_id)
);

CREATE TABLE audit_log (
    log_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    action VARCHAR(255),
    log_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);

SET FOREIGN_KEY_CHECKS = 1;
