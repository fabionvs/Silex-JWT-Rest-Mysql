

CREATE TABLE car (
    parent_id INT NOT NULL AUTO_INCREMENT,
    nome  varchar(80) NOT NULL,
    ano  varchar(4) NOT NULL,
    aro integer NOT NULL,  
    PRIMARY KEY (parent_id)
) ENGINE=INNODB;



CREATE TABLE parts (
    part_id INT NOT NULL AUTO_INCREMENT,
    car_id INT NOT NULL,
    nome varchar(80) NOT NULL,
    opcional integer NOT NULL,
    PRIMARY KEY ( part_id),
    INDEX par_ind (part_id)
)  ENGINE=INNODB;




CREATE TABLE usuario (
    username varchar(50),
    pass varchar(50),
    id integer,
    token varchar(500)
) ENGINE=INNODB;


INSERT INTO car ( nome, ano, aro) VALUES ('Corsa10', '1992', 18);
INSERT INTO car ( nome, ano, aro) VALUES ('testeee', '1233', 12);



INSERT INTO parts (car_id, nome, opcional) VALUES ( 7, 'teste', 0);
INSERT INTO parts (car_id, nome, opcional) VALUES ( 7, 'teste2', 0);
INSERT INTO parts (car_id, nome, opcional) VALUES ( 5, 'teste teste22', 1);
INSERT INTO parts (car_id, nome, opcional) VALUES ( 5, 'Teste2', 0);



INSERT INTO usuario (username, pass, id, token) VALUES ('fabio', '123', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0OTMzNTY0NjQsImp0aSI6ImNkbjVFMDE1SVwvOEZ5c1d2QkpyaXBXRXZcL0NVdFQ5Y1RDOWI0QUVod3FHcz0iLCJpc3MiOiJsb2NhbGhvc3Q6ODAwMCIsIm5iZiI6MTQ5MzM1NjQ2NCwiZXhwIjoxNDkzOTYxMjY0LCJkYXRhIjp7InVzZXJJZCI6MCwidXNlck5hbWUiOiJmYWJpbyJ9fQ.IUWqM3DyXG5A84CZ2D2Ny0smFX22ftuSL0LkNyzEcd0qzKEOxZn5ny3jHgInalwnoqWt1Hnp6afcV-ykkREtFA');
