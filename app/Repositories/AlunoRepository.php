<?php

require_once '../app/Models/Aluno.php';
require_once '../app/Core/Database.php';

class AlunoRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function salvar(Aluno $aluno): int
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO alunos (nome, data_nascimento, cpf, email, senha)
                VALUES (:nome, :data_nascimento, :cpf, :email, :senha)
            ");
            $stmt->execute([
                ':nome'            => $aluno->nome,
                ':data_nascimento' => $aluno->dataNascimento,
                ':cpf'             => $aluno->cpf,
                ':email'           => $aluno->email,
                ':senha'           => $aluno->senha,
            ]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Erro ao salvar aluno: " . $e->getMessage());
        }
    }

    public function listarTodos(): array
    {
        $stmt = $this->db->query("SELECT * FROM alunos ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM alunos WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
        return $aluno ?: null;
    }

    public function atualizar(int $id, Aluno $aluno): bool
    {
        try {
            $stmt = $this->db->prepare("
                UPDATE alunos
                SET nome = :nome, data_nascimento = :data_nascimento, cpf = :cpf, email = :email, senha = :senha
                WHERE id = :id
            ");
            return $stmt->execute([
                ':id'              => $id,
                ':nome'            => $aluno->nome,
                ':data_nascimento' => $aluno->dataNascimento,
                ':cpf'             => $aluno->cpf,
                ':email'           => $aluno->email,
                ':senha'           => $aluno->senha,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar aluno: " . $e->getMessage());
        }
    }

    public function excluir(int $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM alunos WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao excluir aluno: " . $e->getMessage());
        }
    }

    public function buscarPorCpf($cpf)
    {
        $stmt = $this->db->prepare("SELECT * FROM alunos WHERE cpf = :cpf");
        $stmt->execute([':cpf' => $cpf]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM alunos WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorNome($nome)
    {
        $stmt = $this->db->prepare("SELECT * FROM alunos WHERE nome LIKE :nome ORDER BY nome ASC LIMIT 10");
        $stmt->execute([':nome' => "%$nome%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
