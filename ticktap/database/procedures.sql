DELIMITER $$

CREATE PROCEDURE book_ticket (
    IN p_customer_id INT,
    IN p_schedule_id INT,
    IN p_seat_id INT,
    IN p_price DECIMAL(8,2),
    IN p_payment_method ENUM('CARD','MOBILE','BANK')
)
BEGIN
    DECLARE v_booking_id INT;

    START TRANSACTION;

    
    INSERT INTO booking (customer_id, schedule_id)
    VALUES (p_customer_id, p_schedule_id);

    SET v_booking_id = LAST_INSERT_ID();

    
    INSERT INTO ticket (booking_id, seat_id, price)
    VALUES (v_booking_id, p_seat_id, p_price);


    INSERT INTO payment (booking_id, amount, method)
    VALUES (v_booking_id, p_price, p_payment_method);

    COMMIT;
END$$


CREATE PROCEDURE cancel_ticket (
    IN p_booking_id INT,
    IN p_reason VARCHAR(255)
)
BEGIN
    DECLARE v_payment_id INT;
    DECLARE v_amount DECIMAL(8,2);

    START TRANSACTION;

    
    UPDATE ticket
    SET status = 'CANCELLED'
    WHERE booking_id = p_booking_id;


    UPDATE booking
    SET status = 'CANCELLED'
    WHERE booking_id = p_booking_id;

   
    SELECT payment_id, amount
    INTO v_payment_id, v_amount
    FROM payment
    WHERE booking_id = p_booking_id;

    
    INSERT INTO refund (payment_id, amount, reason)
    VALUES (v_payment_id, v_amount, p_reason);


    UPDATE payment
    SET status = 'REFUNDED'
    WHERE payment_id = v_payment_id;

    COMMIT;
END$$

DELIMITER ;
