<?php

require_once '../app/Services/MatriculaService.php';
require_once '../app/Repositories/AlunoRepository.php';
require_once '../app/Repositories/TurmaRepository.php';

class MatriculaController
{
    private $service;
    private $alunoRepo;
    private $turmaRepo;

    public function __construct()
    {
        $this->service   = new MatriculaService();
        $this->alunoRepo = new AlunoRepository();
        $this->turmaRepo = new TurmaRepository();
    }

    public function index()
    {
        $matriculas = $this->service->listar();
        $viewFile   = '../app/Views/matriculas/index.php';
        require '../app/Views/layout.php';
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        
            try {
                $this->service->cadastrar($_POST['aluno_id'], $_POST['turma_id']);

                session_start();
                $_SESSION['success'] = "Matrícula realizada com sucesso!";
                header("Location: /matricula/index");
                exit;
            } catch (Exception $e) {
                $erro = $e->getMessage();
            }
        }

        $alunos   = $this->alunoRepo->listarTodos();
        $turmas = $this->turmaRepo->listarComTotalAlunos(1000, 0);
        $viewFile = '../app/Views/matriculas/form.php';
        echo "antes do require"; 
        require '../app/Views/layout.php';
    }
}
