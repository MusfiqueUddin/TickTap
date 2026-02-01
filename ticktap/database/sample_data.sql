USE ticktap;

-- ------------------------------
-- ROLES
-- ------------------------------
INSERT INTO role (role_name) VALUES
('ADMIN'),
('CUSTOMER'),
('AUTHORITY');

-- ------------------------------
-- USERS
-- ------------------------------
INSERT INTO user (name, email, password, role_id) VALUES
('Admin User', 'admin@ticktap.com', 'admin123', 1),
('Rahim', 'rahim@gmail.com', '1234', 2),
('BRTA Authority', 'brta@ticktap.com', '1234', 3);

-- ------------------------------
-- CUSTOMER
-- ------------------------------
INSERT INTO customer (user_id, phone, address, date_of_birth) VALUES
(2, '01700000000', 'Dhaka', '2000-01-01');

-- ------------------------------
-- TRANSPORT AUTHORITY
-- ------------------------------
INSERT INTO transport_authority (user_id, authority_name, contact_info) VALUES
(3, 'Bangladesh Transport Authority', 'Dhaka HQ');

-- ------------------------------
-- STATIONS
-- ------------------------------
INSERT INTO station (name, city) VALUES
('Dhaka', 'Dhaka'),
('Chittagong', 'Chittagong'),
('Rajshahi', 'Rajshahi'),
('Sylhet', 'Sylhet');

-- ------------------------------
-- ROUTES
-- ------------------------------
INSERT INTO route (source_station_id, destination_station_id, distance_km) VALUES
(1, 2, 245.5),
(1, 3, 250.0),
(1, 4, 240.0);

-- ------------------------------
-- VEHICLES (Bus, Train, Flight)
-- ------------------------------
INSERT INTO vehicle (authority_id, vehicle_type, vehicle_name, total_seats) VALUES
(1, 'BUS', 'Green Line Bus', 40),
(1, 'TRAIN', 'Sonar Bangla Express', 300),
(1, 'FLIGHT', 'Biman Bangladesh', 180);

-- ------------------------------
-- SCHEDULES
-- ------------------------------
INSERT INTO schedule (vehicle_id, route_id, departure_time, arrival_time, schedule_date) VALUES
(1, 1, '2026-02-10 08:00:00', '2026-02-10 14:00:00', '2026-02-10'),
(2, 2, '2026-02-10 07:00:00', '2026-02-10 15:00:00', '2026-02-10'),
(3, 3, '2026-02-10 09:00:00', '2026-02-10 10:30:00', '2026-02-10');

-- ------------------------------
-- SEATS
-- ------------------------------
-- Bus seats
INSERT INTO seat (vehicle_id, seat_number, seat_class) VALUES
(1, 'A1', 'ECONOMY'),
(1, 'A2', 'ECONOMY'),
(1, 'B1', 'ECONOMY'),
(1, 'B2', 'ECONOMY');

-- Train seats
INSERT INTO seat (vehicle_id, seat_number, seat_class) VALUES
(2, 'S1', 'ECONOMY'),
(2, 'S2', 'ECONOMY'),
(2, 'C1', 'BUSINESS');

-- Flight seats
INSERT INTO seat (vehicle_id, seat_number, seat_class) VALUES
(3, '1A', 'FIRST'),
(3, '2A', 'BUSINESS'),
(3, '10C', 'ECONOMY');
