SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
/*
CREATE SCHEMA IF NOT EXISTS projeto_portaria;
USE projeto_portaria;

CREATE TABLE IF NOT EXISTS projeto_portaria.morador (
    idmorador INT NOT NULL AUTO_INCREMENT,
    cpf VARCHAR(11) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    dtNasc DATE NOT NULL,
    email VARCHAR(60) NOT NULL,
    cod_coutry CHAR(3) NULL,
    cod_reg CHAR(2) NULL,
    operadora CHAR(2) NULL,
    telefone CHAR(11) NULL,
    PRIMARY KEY (idmorador, cpf)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS projeto_portaria.endereco_condominio (
    idendereco_condominio INT NOT NULL AUTO_INCREMENT,
    uf CHAR(2) NOT NULL,
    logradouro VARCHAR(20) NOT NULL,
    tipo_log CHAR(15) NOT NULL COMMENT 'tipo de logradouro',
    localidade VARCHAR(15) NOT NULL,
    cep CHAR(9) NOT NULL,
    FKmorador INT NOT NULL,
    FKmorador_cpf VARCHAR(11) NOT NULL,
    PRIMARY KEY (idendereco_condominio),
    INDEX fk_endereco_condominio_morador_idx (FKmorador, FKmorador_cpf),
    CONSTRAINT fk_endereco_condominio_morador
        FOREIGN KEY (FKmorador, FKmorador_cpf)
        REFERENCES projeto_portaria.morador (idmorador, cpf)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS projeto_portaria.visitante (
    idvisitante INT NOT NULL AUTO_INCREMENT,
    rg VARCHAR(15) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    dtNasc DATE NOT NULL,
    cod_country CHAR(3) NOT NULL,
    cod_reg CHAR(2) NOT NULL,
    operadora CHAR(2) NOT NULL,
    telefone CHAR(11) NOT NULL,
    PRIMARY KEY (idvisitante)
) ENGINE=InnoDB;
*/
CREATE DATABASE IF NOT EXISTS projeto_portaria;
USE projeto_portaria;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    cpf VARCHAR(11) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
ENGINE=InnoDB;
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
