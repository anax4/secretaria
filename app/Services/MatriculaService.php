<?php

require_once '../app/Repositories/MatriculaRepository.php';

class MatriculaService {
    private $repo;

    public function __construct() {
        $this->repo = new MatriculaRepository();
    }

    public function cadastrar($alunoId, $turmaId) {
        if ($this->repo->verificarDuplicada($alunoId, $turmaId)) {
            throw new Exception("Este aluno já está matriculado nesta turma.");
        }

        $matricula = new Matricula($alunoId, $turmaId);
        return $this->repo->salvar($matricula);
    }

    public function listar() {
        return $this->repo->listarTodos();
    }
}
