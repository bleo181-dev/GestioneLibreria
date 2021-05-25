CREATE SCHEMA IF NOT EXISTS Libreria;

USE Libreria;

CREATE TABLE Utente (
	Matricola 	INT NOT NULL,
	Nome 	VARCHAR(30),
	Cognome 	VARCHAR(30),
	Numero_telefono 		VARCHAR(15),
	Via 	VARCHAR(30),
	Numero_civico 	VARCHAR(5),
	Codice_postale 		CHAR(5),
	Città 	VARCHAR(30),
	Sesso 	CHAR,
	Data_nascita 		DATE,

	PRIMARY KEY (Matricola),
	UNIQUE (Numero_telefono)
);

CREATE TABLE Dipartimento (
	Codice_dipartimento INT NOT NULL AUTO_INCREMENT,
	Nome 		VARCHAR(100),
	Via 	VARCHAR(30),
	Numero_civico 	VARCHAR(5),
	Codice_postale 		CHAR(5),
	Città 	VARCHAR(30),

	PRIMARY KEY (Codice_dipartimento),
	UNIQUE (Nome)
);


CREATE TABLE Libro( 
	Codice_libro 	INT NOT NULL AUTO_INCREMENT,	
Titolo		VARCHAR(100), 	
	ISBN		VARCHAR(20),
Lingua		VARCHAR(30),	 	
	Anno_pubblicazione		INT,		
	Codice_dipartimento	INT,		
	
	PRIMARY KEY (Codice_libro), 	
	FOREIGN KEY (Codice_dipartimento) REFERENCES Dipartimento(Codice_dipartimento) 
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Autore( 
	Codice_autore		INT NOT NULL AUTO_INCREMENT,		
	Nome 	VARCHAR(30),
	Cognome 	VARCHAR(30),
	Data_nascita 		DATE,
	Luogo_nascita VARCHAR(30),
	
	PRIMARY KEY (Codice_autore)
);

CREATE TABLE Prestito( 
	Codice		INT NOT NULL AUTO_INCREMENT,
	Codice_libro	INT,
	Matricola	INT,
	Data_uscita BOOLEAN,
Restituito	BOOLEAN,
	
	PRIMARY KEY (Codice),
	FOREIGN KEY (Codice_libro) REFERENCES Libro(Codice_libro) 
ON DELETE CASCADE ON UPDATE CASCADE, 
	FOREIGN KEY (Matricola) REFERENCES Utente(Matricola) 
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Scrive( 
	Codice		INT NOT NULL AUTO_INCREMENT,
	Codice_libro	INT,
	Codice_autore		INT,
	
	PRIMARY KEY (Codice),
	FOREIGN KEY (Codice_libro) REFERENCES Libro(Codice_libro) 
ON DELETE CASCADE ON UPDATE CASCADE, 
	FOREIGN KEY (Codice_autore) REFERENCES Autore(Codice_autore)
);




