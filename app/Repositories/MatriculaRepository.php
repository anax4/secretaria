<?php

require_once '../app/Core/Database.php';
require_once '../app/Models/Matricula.php';

class MatriculaRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function salvar(Matricula $matricula) {
        $stmt = $this->db->prepare("
            INSERT INTO matriculas (aluno_id, turma_id) 
            VALUES (:aluno_id, :turma_id)
        ");
        return $stmt->execute([
            ':aluno_id' => $matricula->alunoId,
            ':turma_id' => $matricula->turmaId
        ]);
    }

    public function listarTodos() {
        $sql = "SELECT m.id, a.nome AS aluno, t.nome AS turma, m.data_matricula
                FROM matriculas m
                JOIN alunos a ON m.aluno_id = a.id
                JOIN turmas t ON m.turma_id = t.id
                ORDER BY m.data_matricula DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verificarDuplicada($alunoId, $turmaId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total 
                                    FROM matriculas 
                                    WHERE aluno_id = :aluno_id AND turma_id = :turma_id");
        $stmt->execute([
            ':aluno_id' => $alunoId,
            ':turma_id' => $turmaId
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] > 0;
    }
}
