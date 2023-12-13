create table colores (
id int primary key identity (1,1) not null,
r varchar(50) not null,
g varchar(50) not null,
b varchar(50) not null);

select * from colores

ALTER TABLE colores
ADD X INT,
    Y INT;

TRUNCATE TABLE COLORES;

SELECT TOP 3 r, g, b FROM colores ORDER BY id DESC