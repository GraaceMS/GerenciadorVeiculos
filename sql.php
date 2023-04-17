CREATE DATABASE gerenciador_veiculos;

USE gerenciador_veiculos;

CREATE TABLE veiculos (
    id INT(11) NOT NULL AUTO_INCREMENT,
    modelo VARCHAR(50) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    ano INT(4) NOT NULL,
    placa VARCHAR(8) NOT NULL,
    cor VARCHAR(20) NOT NULL,
    PRIMARY KEY (id)
);