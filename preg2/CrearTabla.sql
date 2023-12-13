CREATE DATABASE segparcial;

CREATE TABLE IF NOT EXISTS workflow(
	flujo VARCHAR(5) NOT NULL,
	proceso VARCHAR(5) NOT NULL,
	proceso_siguiente VARCHAR(5),
	descripcion VARCHAR(75),
	rol VARCHAR(25) NOT NULL,
	pantalla VARCHAR(25)
);

CREATE TABLE IF NOT EXISTS workflow_quest(
	flujo VARCHAR(5) NOT NULL,
	proceso VARCHAR(5) NOT NULL,
	si VARCHAR(5),
	no VARCHAR(5)
);

CREATE TABLE IF NOT EXISTS usuario(
	ci VARCHAR(15) PRIMARY KEY NOT NULL,
	password VARCHAR(60) NOT NULL,
	nombre VARCHAR(100) NOT NULL,
	rol VARCHAR(15) NOT NULL
);


CREATE TABLE IF NOT EXISTS seguimiento(
	id_seguimiento INTEGER PRIMARY KEY AUTO_INCREMENT,
	ci_alumno VARCHAR(15) NOT NULL,
	fecha_creacion DATETIME DEFAULT now(),
	flujo VARCHAR(5) NOT NULL,
	proceso VARCHAR(5),
	FOREIGN KEY (ci_alumno) REFERENCES usuario(ci)
);

--############################ LLENADO DE DATOS ######################################

INSERT INTO workflow(flujo,proceso,proceso_siguiente,descripcion,rol,pantalla) 
VALUES ('F1','P1','P2','subir datos al sistema','usuario','notas'),
('F1','P2','P3','validacion de los documentos','kardex','escorrecto'),
('F1','P3','P4','Pago del costo de la matricula','usuario','deudas'),
('F1','P4','P5','Generacion de la matricula digital','kardex','requisitos'),
('F1','P5',null,'Impresion de la matricula','usuario','rrecoge_certificado'),

INSERT INTO workflow_quest(flujo, proceso, si, no) VALUES ('F1','P2','P3','P1');

INSERT INTO usuario(ci,password,nombre,rol) VALUES ('123456','123456','mishel','usuario');
INSERT INTO usuario(ci,password,nombre,rol) VALUES ('555','555','pamela','kardex');

