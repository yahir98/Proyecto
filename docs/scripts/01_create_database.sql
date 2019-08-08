CREATE SCHEMA `greentec` ;
ALTER USER 'greentec'@'%' IDENTIFIED WITH mysql_native_password BY '123456';
GRANT ALL ON greentec.* TO 'greentec'@'%';
