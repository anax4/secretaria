<?php

require_once '../app/Services/AlunoService.php';

class AlunoController
{
    private $service;

    public function __construct()
    {
        $this->service = new AlunoService();
    }

    public function index()
    {
        $alunos   = $this->service->listarAlunos();
        $viewFile = '../app/Views/alunos/index.php';
        require '../app/Views/layout.php';
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->service->cadastrar(
                    $_POST['nome'],
                    $_POST['data_nascimento'],
                    $_POST['cpf'],
                    $_POST['email'],
                    $_POST['senha']
                );

                session_start();
                $_SESSION['success'] = "Aluno cadastrado com sucesso!";
                header("Location: /aluno/index");
                exit;
            } catch (Exception $e) {
                $erro = $e->getMessage();
            }
        }
        $viewFile = '../app/Views/alunos/form.php';
        require '../app/Views/layout.php';
    }

    public function editar($id)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['excluir'])) {
                    $this->service->excluir($id);
                    header("Location: /aluno/index");
                    exit;
                } else {
                    $this->service->atualizar(
                        $id,
                        $_POST['nome'],
                        $_POST['data_nascimento'],
                        $_POST['cpf'],
                        $_POST['email'],
                        $_POST['senha']
                    );
                    header("Location: /aluno/index");
                    exit;
                }
            }

            $aluno = $this->service->buscarPorId($id);
            if (! $aluno) {
                throw new Exception("Aluno não encontrado");
            }

            $viewFile = '../app/Views/alunos/form.php';
            require '../app/Views/layout.php';
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function buscar()
    {
        $nome       = $_GET['nome'] ?? '';
        $resultados = $this->service->buscarPorNome($nome);

        header('Content-Type: application/json');
        echo json_encode($resultados);
        exit;
    }
    public function verificar()
    {
        $cpf   = $_GET['cpf'] ?? null;
        $email = $_GET['email'] ?? null;

        $cpfExiste   = $cpf ? (bool) $this->service->buscarPorCpf($cpf) : false;
        $emailExiste = $email ? (bool) $this->service->buscarPorEmail($email) : false;

        header('Content-Type: application/json');
        echo json_encode([
            'cpfExiste'   => $cpfExiste,
            'emailExiste' => $emailExiste,
        ]);
        exit;
    }

}
