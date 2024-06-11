-- Group 30 - Ben Kahl
--function uploaded to phpMyAdmin
DELIMITER //

CREATE FUNCTION get_average_rating(bookID INT) RETURNS DECIMAL(3, 2)
BEGIN
    DECLARE avgRating DECIMAL(3, 2);
    SELECT AVG(rating) INTO avgRating
    FROM RATINGS
    WHERE book_id = bookID;
    RETURN avgRating;
END //

DELIMITER ;