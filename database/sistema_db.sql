CREATE DATABASE IF NOT EXISTS sistema_db;
USE sistema_db;

CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    marca VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cor VARCHAR(50) NOT NULL,
    valor DOUBLE NOT NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1
);

INSERT INTO produtos (nome, marca, senha, cor, valor, ativo)
VALUES
    ('Notebook Pro 15', 'TechMax', SHA2('techmax123', 256), 'Prata', 4599.90, 1),
    ('Smartphone Vision', 'Mobline', SHA2('mobline123', 256), 'Azul', 2399.50, 1),
    ('Headset Gamer X', 'SoundForce', SHA2('soundforce123', 256), 'Preto', 349.99, 0);
