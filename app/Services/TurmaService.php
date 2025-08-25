<?php

require_once '../app/Repositories/TurmaRepository.php';
require_once '../app/Models/Turma.php';

class TurmaService
{
    private $repo;

    public function __construct()
    {
        $this->repo = new TurmaRepository();
    }

    public function cadastrar($nome, $descricao)
    {
        if (strlen(trim($nome)) < 3) {
            throw new Exception("O nome da turma deve ter no mínimo 3 caracteres.");
        }

        $turma = new Turma($nome, $descricao);
        return $this->repo->salvar($turma);
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
    public function buscarPorId($id)
    {
        return $this->repo->buscarPorId($id);
    }

    public function atualizar($id, $nome, $descricao)
    {
        if (strlen(trim($nome)) < 3) {
            throw new Exception("O nome da turma deve ter no mínimo 3 caracteres.");
        }
        $turmaExistente = $this->repo->buscarPorId($id);
        if (! $turmaExistente) {
            throw new Exception("Turma não encontrada.");
        }
        $turma = new Turma($nome, $descricao);
        return $this->repo->atualizar($id, $turma);
    }

    public function excluir($id)
    {
        return $this->repo->excluir($id);
    }

}
