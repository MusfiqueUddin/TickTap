USE ticktap;

CREATE TABLE fare (
    fare_id INT PRIMARY KEY AUTO_INCREMENT,
    vehicle_type ENUM('BUS','TRAIN','FLIGHT') NOT NULL,
    seat_class ENUM('ECONOMY','BUSINESS','FIRST') NOT NULL,
    base_price DECIMAL(8,2) NOT NULL,
    UNIQUE (vehicle_type, seat_class)
);

INSERT INTO fare (vehicle_type, seat_class, base_price) VALUES
('BUS', 'ECONOMY', 800),
('BUS', 'BUSINESS', 1200),
('TRAIN', 'ECONOMY', 600),
('TRAIN', 'BUSINESS', 1000),
('FLIGHT', 'ECONOMY', 3500),
('FLIGHT', 'BUSINESS', 5500),
('FLIGHT', 'FIRST', 8000);
