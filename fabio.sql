
CREATE SEQUENCE car_sequence;



CREATE TABLE car (
    parent_id integer DEFAULT nextval('car_sequence') NOT NULL,
    nome character varying(80) NOT NULL,
    ano character varying(4) NOT NULL,
    aro integer NOT NULL
);


CREATE SEQUENCE parts_sequence;


CREATE TABLE parts (
    part_id integer DEFAULT nextval('parts_sequence') NOT NULL,
    car_id integer NOT NULL,
    nome character varying(80) NOT NULL,
    opcional integer NOT NULL
);



CREATE TABLE usuario (
    username character varying(50),
    pass character varying(50),
    id integer,
    token character varying(500)
);


INSERT INTO car (parent_id, nome, ano, aro) VALUES (5, 'Corsa10', '1992', 18);
INSERT INTO car (parent_id, nome, ano, aro) VALUES (7, 'testeee', '1233', 12);



INSERT INTO parts (part_id, car_id, nome, opcional) VALUES (3, 7, 'teste', 0);
INSERT INTO parts (part_id, car_id, nome, opcional) VALUES (4, 7, 'teste2', 0);
INSERT INTO parts (part_id, car_id, nome, opcional) VALUES (2, 5, 'teste teste22', 1);
INSERT INTO parts (part_id, car_id, nome, opcional) VALUES (1, 5, 'Teste2', 0);



INSERT INTO usuario (username, pass, id, token) VALUES ('fabio', '123', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0OTMzNTY0NjQsImp0aSI6ImNkbjVFMDE1SVwvOEZ5c1d2QkpyaXBXRXZcL0NVdFQ5Y1RDOWI0QUVod3FHcz0iLCJpc3MiOiJsb2NhbGhvc3Q6ODAwMCIsIm5iZiI6MTQ5MzM1NjQ2NCwiZXhwIjoxNDkzOTYxMjY0LCJkYXRhIjp7InVzZXJJZCI6MCwidXNlck5hbWUiOiJmYWJpbyJ9fQ.IUWqM3DyXG5A84CZ2D2Ny0smFX22ftuSL0LkNyzEcd0qzKEOxZn5ny3jHgInalwnoqWt1Hnp6afcV-ykkREtFA');



ALTER TABLE ONLY car
    ADD CONSTRAINT car_pkey PRIMARY KEY (parent_id);

ALTER TABLE ONLY parts
    ADD CONSTRAINT parts_pkey PRIMARY KEY (part_id);


ALTER TABLE ONLY parts
    ADD CONSTRAINT parts_car_id_fkey FOREIGN KEY (car_id) REFERENCES car(parent_id);

