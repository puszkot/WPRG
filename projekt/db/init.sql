# CREATE DATABASE IF NOT EXISTS projekt;

USE projekt;

#USE s30295;

DROP TABLE komentarze;
DROP TABLE artykuly;
DROP TABLE dzialy;
DROP TABLE uzytkownicy;
DROP TABLE wiadomosci;

CREATE TABLE IF NOT EXISTS uzytkownicy (
                             id INT AUTO_INCREMENT PRIMARY KEY,
                             login VARCHAR(100) UNIQUE NOT NULL,
                             haslo VARCHAR(255) NOT NULL,
                             email VARCHAR(255) UNIQUE NOT NULL ,
                             nazwa varchar(100) NOT NULL,
                             rola ENUM('admin', 'autor', 'uzytkownik') NOT NULL DEFAULT 'uzytkownik',
                             token VARCHAR(255) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS dzialy (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        nazwa VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS artykuly (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          tytul VARCHAR(255) NOT NULL,
                          tresc TEXT NOT NULL,
                          data DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          autor_id INT NOT NULL,
                          dzial_id INT NOT NULL,
                          img_url VARCHAR(255),
                          FOREIGN KEY (autor_id) REFERENCES uzytkownicy(id) ON DELETE CASCADE,
                          FOREIGN KEY (dzial_id) REFERENCES dzialy(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS komentarze (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            artykul_id INT NOT NULL,
                            nazwa VARCHAR(100) NOT NULL,
                            tresc TEXT NOT NULL,
                            data DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            FOREIGN KEY (artykul_id) REFERENCES artykuly(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS wiadomosci (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            nazwa VARCHAR(100) NOT NULL,
                            email VARCHAR(255) NOT NULL,
                            temat VARCHAR(255) NOT NULL,
                            tresc TEXT NOT NULL,
                            data DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            przeczytana BOOLEAN NOT NULL DEFAULT 0,
                            odbiorca_ID INT NOT NULL,
                            FOREIGN KEY (odbiorca_ID) REFERENCES uzytkownicy(id) ON DELETE CASCADE
);

INSERT INTO dzialy (nazwa) VALUES ('Polityka'),
                                  ('Techonologia'),
                                  ('Sport');
INSERT INTO uzytkownicy (login, haslo, email, nazwa, rola) VALUES ('autor', 'autor', 'autor@autor.com', 'Autor', 'autor');
INSERT INTO uzytkownicy (login, haslo, email, nazwa, rola) VALUES ('admin', 'admin', 'admin@admin.com', 'Admin', 'admin ');

INSERT INTO artykuly (tytul, tresc, autor_id, dzial_id, img_url) VALUES ('tytul', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',5, 3,'');


