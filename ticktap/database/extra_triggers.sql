USE ticktap;

DELIMITER $$

CREATE TRIGGER trg_waitlist_promotion
AFTER UPDATE ON ticket
FOR EACH ROW
BEGIN
    DECLARE v_customer_id INT;
    DECLARE v_schedule_id INT;

    IF OLD.status = 'BOOKED' AND NEW.status = 'CANCELLED' THEN
        SELECT customer_id, schedule_id
        INTO v_customer_id, v_schedule_id
        FROM waitlist
        WHERE schedule_id = (
            SELECT schedule_id FROM booking WHERE booking_id = OLD.booking_id
        )
        ORDER BY request_time
        LIMIT 1;

        IF v_customer_id IS NOT NULL THEN
            INSERT INTO booking (customer_id, schedule_id)
            VALUES (v_customer_id, v_schedule_id);

            DELETE FROM waitlist
            WHERE customer_id = v_customer_id
              AND schedule_id = v_schedule_id;
        END IF;
    END IF;
END$$


CREATE TRIGGER trg_expire_pending_booking
BEFORE UPDATE ON booking
FOR EACH ROW
BEGIN
    IF OLD.status = 'PENDING'
       AND TIMESTAMPDIFF(MINUTE, OLD.booking_time, NOW()) > 15 THEN
        SET NEW.status = 'CANCELLED';
    END IF;
END$$

DELIMITER ;
