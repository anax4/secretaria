<?php

require_once '../app/Services/TurmaService.php';

class TurmaController
{
    private $service;

    public function __construct()
    {
        $this->service = new TurmaService();
    }

    public function index($pagina = 1)
    {
        $turmasData = $this->service->listar($pagina);
        $viewFile   = '../app/Views/turmas/index.php';
        require '../app/Views/layout.php';
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->service->cadastrar($_POST['nome'], $_POST['descricao']);

                session_start();
                $_SESSION['success'] = "Turma cadastrada com sucesso!";

                header("Location: /turma/index");
                exit;
            } catch (Exception $e) {
                $erro = $e->getMessage();
            }
        }
        $viewFile = '../app/Views/turmas/form.php';
        require '../app/Views/layout.php';
    }
    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if (isset($_POST['excluir'])) {
                    $this->service->excluir($id);
                    header("Location: /turma/index");
                    exit;
                } else {
                    $this->service->atualizar(
                        $id,
                        $_POST['nome'],
                        $_POST['descricao']
                    );
                    header("Location: /turma/index");
                    exit;
                }
            } catch (Exception $e) {
                $erro = $e->getMessage();
            }
        }

        $turma = $this->service->buscarPorId($id);
        if (! $turma) {
            $erro = "Turma não encontrada.";
        }

        $viewFile = '../app/Views/turmas/form.php';
        require '../app/Views/layout.php';
    }

}
