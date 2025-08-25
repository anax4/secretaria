-- Criação do banco
CREATE DATABASE IF NOT EXISTS secretaria
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

-- Tabela de alunos
CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Tabela de turmas
CREATE TABLE turmas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de matrículas
CREATE TABLE matriculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    turma_id INT NOT NULL,
    data_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY (aluno_id, turma_id),
    FOREIGN KEY (aluno_id) REFERENCES alunos(id) ON DELETE CASCADE,
    FOREIGN KEY (turma_id) REFERENCES turmas(id) ON DELETE CASCADE
);


-- Insert de dados iniciais na tabela de alunos
INSERT INTO secretaria.alunos (nome,data_nascimento,cpf,email,senha) VALUES
	 ('Joana Costa','1995-02-10','339.107.500-79','joanacosta@gmail.com','$2y$10$XS8x84NhK8oZ/Dyx.0GHsODP736FwCUOWU4ytQTVklM1BkRj/3rga'),
	 ('Ana Carolina Souza','1998-02-03','111.111.111-11','ana.souza@example.com','$2y$10$Zr9MNXfOztSsnTz9xL6XpewZVJY0MI4ClNhwDop7A10OZ5bnHwdyS'),
	 ('Bruno Henrique Lima','1999-07-22','222.222.222-22','bruno.lima@example.com','$2y$10$Zr9MNXfOztSsnTz9xL6XpewZVJY0MI4ClNhwDop7A10OZ5bnHwdyS'),
	 ('Camila Ferreira','2001-01-10','333.333.333-33','camila.ferreira@example.com','$2y$10$Zr9MNXfOztSsnTz9xL6XpewZVJY0MI4ClNhwDop7A10OZ5bnHwdyS'),
	 ('Diego Martins','1998-11-30','444.444.444-44','diego.martins@example.com','$2y$10$Zr9MNXfOztSsnTz9xL6XpewZVJY0MI4ClNhwDop7A10OZ5bnHwdyS'),
	 ('Eduarda Pereira','2002-05-05','555.555.555-55','eduarda.pereira@example.com','$2y$10$Zr9MNXfOztSsnTz9xL6XpewZVJY0MI4ClNhwDop7A10OZ5bnHwdyS'),
	 ('teste','2009-11-12','1111111112','teste@example.com','$2y$10$3D.JnC2N1XLPFDsqqSIrGOnyZMNj5OVlna5c3nF8FdYvqzdsiyFum'),
	 ('teste data','1997-01-01','01478523695','teste@data.com','$2y$10$GeWJIylWramw2NwDlsZhfu4uRT7keB6KltYt6jpWl9DAm0iXGMEK2');

-- Insert de dados iniciais na tabela de turmas
INSERT INTO secretaria.turmas (nome,descricao,created_at) VALUES
	 ('ADM 2025/1','Administração - Bacharelado, semestre 1 de 2025','2025-08-23 15:44:49'),
	 ('ADS 2025/1','Análise e Desenvolvimento de Sistemas - Tecnólogo, semestre 1 de 2025','2025-08-23 15:45:11'),
	 ('CC 2025/1','Ciência da Computação - Bacharelado, semestre 1 de 2025','2025-08-23 15:45:32'),
	 ('ECOMP 2025/1','Engenharia de Computação - Bacharelado, semestre 1 de 2025','2025-08-23 15:46:00'),
	 ('ESW 2025/1','Engenharia de Software - Bacharelado, semestre 1 de 2025','2025-08-23 15:46:21'),
	 ('GTI 2025/1','Gestão da Tecnologia da Informação - Tecnólogo, semestre 1 de 2025','2025-08-23 15:57:31'),
	 ('MBA GTI 2025/1','MBA em Gestão de Tecnologia da Informação - Pós-graduação, 2025','2025-08-23 15:57:55'),
	 ('MBA BP 2025/1','MBA em Análise de Negócios - Business Partner - 2025 - 1° semestre','2025-08-23 15:58:40'),
	 ('MBA CIBER 2025/1','MBA em Gestão de Cibersegurança','2025-08-23 15:59:04'),
	 ('MBA CIBER 2025/2','MBA em Gestão de Cibersegurança - 2025 2º semestre','2025-08-23 15:59:36');
INSERT INTO secretaria.turmas (nome,descricao,created_at) VALUES
	 ('ADS 2025/2','Análise e Desenvolvimento de Sistemas - Tecnólogo, semestre 2 de 2025','2025-08-23 16:00:11'),
	 ('SI 2025/1','Sistemas de Informação - Bacharelado, semestre 1 de 2025','2025-08-23 16:11:57'),
	 ('GTI 2025/1','Gestão da Tecnologia da Informação - Tecnólogo, semestre 1 de 2025','2025-08-23 16:11:57'),
	 ('DC-DS 2025/1','Defesa Cibernética - Tecnólogo, semestre 1 de 2025','2025-08-23 16:11:57'),
	 ('MKTDS 2025/1','Marketing Digital & Data Science - Tecnólogo, semestre 1 de 2025','2025-08-23 16:11:57'),
	 ('Nova turma','Teste de cadastro','2025-08-25 18:33:38');

-- Insert de dados iniciais na tabela de matrículas
INSERT INTO secretaria.matriculas (aluno_id,turma_id,data_matricula) VALUES
	 (3,1,'2025-08-23 21:35:57'),
	 (3,2,'2025-08-25 20:18:52'),
	 (4,1,'2025-08-25 20:19:02'),
	 (1,1,'2025-08-25 20:19:10'),
	 (5,1,'2025-08-25 20:19:15'),
	 (6,2,'2025-08-25 20:19:19');