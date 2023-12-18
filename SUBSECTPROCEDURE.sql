DELIMITER //
CREATE PROCEDURE subsect(IN pid_super_sect INT)
BEGIN

DECLARE acabar, localid INT;
DECLARE cursect CURSOR FOR SELECT id_sect FROM sector WHERE id_super_sector=pid_super_sect;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET acabar=true;

SET @@SESSION.max_sp_recursion_depth=25;
SET acabar=false;
OPEN cursect;

a:LOOP
	FETCH cursect INTO localid;
    IF acabar THEN
    	INSERT INTO temp_log VALUES (pid_super_sect);
    	LEAVE a;
		end if;
    CALL subsect(localid);
	
end LOOP;
CLOSE cursect;
END