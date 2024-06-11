-- Group 30 - Ben Kahl
-- Function to count the number of times a book has been checked out
DELIMITER //

CREATE FUNCTION get_check_out_count(bookID INT) RETURNS INT
BEGIN
    DECLARE checkOutCount INT;
    SELECT COUNT(*) INTO checkOutCount
    FROM BORROWS
    WHERE book_id = bookID;
    RETURN checkOutCount;
END //

DELIMITER ;