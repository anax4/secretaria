Projeto PHP — Secretaria FIAP

Sistema de gerenciamento de alunos desenvolvido em PHP seguindo o padrão MVC, com PDO para acesso ao banco de dados e Bootstrap 5 para o frontend.

Desenvolvido em:

PHP 8+
MySQL 8 
Apache 2.4 com mod_rewrite habilitado
Composer

Como rodar o projeto

Clonar o repositório

git clone https://github.com/seu-usuario/seu-projeto.git
cd seu-projeto


Config  do banco

- CREATE DATABASE secretaria;

- CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);


Configurar conexão

Arquivo: app/Core/Database.php

Ajuste host, usuário, senha e banco conforme seu ambiente.

Rodar o servidor local

php -S localhost:8000 -t public