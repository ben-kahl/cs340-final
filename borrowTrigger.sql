-- Group 30 Ben Kahl
CREATE TRIGGER after_borrow_insert
AFTER INSERT ON BORROWS
FOR EACH ROW
BEGIN
    UPDATE BOOK
    SET available = 0
    WHERE book_id = NEW.book_id;
END;