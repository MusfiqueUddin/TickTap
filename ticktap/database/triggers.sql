DELIMITER $$

CREATE TRIGGER trg_prevent_double_seat_booking
BEFORE INSERT ON ticket
FOR EACH ROW
BEGIN
    IF EXISTS (
        SELECT 1
        FROM ticket t
        JOIN booking b ON t.booking_id = b.booking_id
        WHERE t.seat_id = NEW.seat_id
          AND b.schedule_id = (
              SELECT schedule_id
              FROM booking
              WHERE booking_id = NEW.booking_id
          )
          AND t.status = 'BOOKED'
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Seat already booked for this schedule';
    END IF;
END$$

CREATE TRIGGER trg_confirm_booking_after_payment
AFTER INSERT ON payment
FOR EACH ROW
BEGIN
    UPDATE booking
    SET status = 'CONFIRMED'
    WHERE booking_id = NEW.booking_id
      AND NEW.status = 'SUCCESS';
END$$

CREATE TRIGGER trg_audit_after_booking
AFTER INSERT ON booking
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (user_id, action)
    VALUES (
        (SELECT user_id FROM customer WHERE customer_id = NEW.customer_id),
        CONCAT('New booking created. Booking ID: ', NEW.booking_id)
    );
END$$

DELIMITER ;
