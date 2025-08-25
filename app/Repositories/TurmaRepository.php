<?php

require_once '../app/Models/Turma.php';
require_once '../app/Core/Database.php';

class TurmaRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function salvar(Turma $turma)
    {
        $stmt = $this->db->prepare("INSERT INTO turmas (nome, descricao) VALUES (:nome, :descricao)");
        $stmt->execute([
            ':nome'      => $turma->nome,
            ':descricao' => $turma->descricao,
        ]);
        return $this->db->lastInsertId();
    }

    public function listarComTotalAlunos($limit, $offset)
    {
        $sql = "SELECT t.id, t.nome, t.descricao, COUNT(m.aluno_id) as total_alunos
            FROM turmas t
            LEFT JOIN matriculas m ON t.id = m.turma_id
            GROUP BY t.id, t.nome, t.descricao
            ORDER BY t.nome ASC
            LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarTotal()
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM turmas");
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
    public function buscarPorId($id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM turmas WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $turma = $stmt->fetch(PDO::FETCH_ASSOC);
        return $turma ?: null;
    }

    public function atualizar($id, Turma $turma): bool
    {
        $stmt = $this->db->prepare("
            UPDATE turmas
            SET nome = :nome, descricao = :descricao
            WHERE id = :id
        ");
        return $stmt->execute([
            ':id'        => $id,
            ':nome'      => $turma->nome,
            ':descricao' => $turma->descricao,
        ]);
    }

    public function excluir($id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM turmas WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
    public function listar($pagina = 1, $porPagina = 10)
    {
        $offset = ($pagina - 1) * $porPagina;
        $turmas = $this->repo->listarComTotalAlunos($porPagina, $offset);
        $total  = $this->repo->contarTotal();

        return [
            'dados'        => $turmas,
            'total'        => $total,
            'pagina'       => $pagina,
            'porPagina'    => $porPagina,
            'totalPaginas' => ceil($total / $porPagina),
        ];
    }

}
