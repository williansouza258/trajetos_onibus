USE test;
CREATE TABLE usuario (
     id_user MEDIUMINT NOT NULL AUTO_INCREMENT,
     name CHAR(50) NOT NULL,
	 senha CHAR(50) NOT NULL,
     PRIMARY KEY (id_user)
);

insert into usuario (name,senha) values ('root','123456');
