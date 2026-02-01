USE ticktap;

-- ------------------------------
-- VIEW: Seat Availability Per Schedule
-- ------------------------------
CREATE VIEW vw_seat_availability AS
SELECT
    s.schedule_id,
    v.vehicle_name,
    v.vehicle_type,
    COUNT(se.seat_id) AS total_seats,
    COUNT(t.ticket_id) AS booked_seats,
    (COUNT(se.seat_id) - COUNT(t.ticket_id)) AS available_seats
FROM schedule s
JOIN vehicle v ON s.vehicle_id = v.vehicle_id
JOIN seat se ON v.vehicle_id = se.vehicle_id
LEFT JOIN booking b ON s.schedule_id = b.schedule_id
LEFT JOIN ticket t ON b.booking_id = t.booking_id
    AND t.status = 'BOOKED'
GROUP BY s.schedule_id;

-- ------------------------------
-- VIEW: Daily Revenue Report
-- ------------------------------
CREATE VIEW vw_daily_revenue AS
SELECT
    DATE(payment_time) AS payment_date,
    SUM(amount) AS total_revenue
FROM payment
WHERE status = 'SUCCESS'
GROUP BY DATE(payment_time);

-- ------------------------------
-- VIEW: Popular Routes
-- ------------------------------
CREATE VIEW vw_popular_routes AS
SELECT
    r.route_id,
    st1.name AS source,
    st2.name AS destination,
    COUNT(b.booking_id) AS total_bookings
FROM booking b
JOIN schedule s ON b.schedule_id = s.schedule_id
JOIN route r ON s.route_id = r.route_id
JOIN station st1 ON r.source_station_id = st1.station_id
JOIN station st2 ON r.destination_station_id = st2.station_id
GROUP BY r.route_id;
