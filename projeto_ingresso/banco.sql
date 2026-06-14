CREATE DATABASE ingresso_site;

USE ingresso_site;

CREATE TABLE filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    horario VARCHAR(20),
    sala VARCHAR(20),
    preco DECIMAL(10,2)
);

CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(100),
    filme_id INT,
    quantidade INT,
    total DECIMAL(10,2),
    FOREIGN KEY (filme_id) REFERENCES filmes(id)
);

INSERT INTO filmes (nome, horario, sala, preco) VALUES
('Homem-Aranha', '19:30', 'Sala 1', 25.00),
('Batman', '21:00', 'Sala 2', 30.00);
