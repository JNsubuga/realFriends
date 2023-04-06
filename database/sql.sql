-- LOGIN --

mysql - u root - p -- SHOW USERS --
SELECT *
FROM mysql.user;

-- CREATE USER --

CREATE USER
    'RealFriendsAdmin' @'localhost' IDENTIFIED BY 'RF_1.@Mysql';

-- GRANT ALL PRIVILEGES ON ALL DATABASES TO A USER CREATED --

GRANT ALL PRIVILEGES ON *.* TO 'RealFriendsAdmin'@'localhost';

FLUSH PRIVILEGES;

-- SHOW GRANTS --

SHOW GRANTS FOR 'RealFriendsAdmin'@'localhost';

-- REMOVE GRANTS --

REVOKE ALL PRIVILEGES,
GRANT OPTION
FROM
    'RealFriendsAdmin' @'localhost';

-- DELETE USER --

DROP USER 'RealFriendsAdmin'@'localhost';

-- EXIT --

exit;

-- SHOW DATABASES --

SHOW DATABASES;

-- CREATE DATABASE --

CREATE DATABASE 'daco_db';

-- DELETE DATABASE --

DROP DATABASE 'databasename';

-- SELECT DATABASE --

USE DATABASE 'databasename';

-- CREATE TABLE --

-- SHOW TABLES --

SHOW TABLES;

-- SHOW TABLE COLUMNS

SHOW COLUMNS FROM 'talbename';

-- DELETE/DROP TABLE --

DROP TABLE 'tablename';