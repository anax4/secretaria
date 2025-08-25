<?php

require_once '../app/Repositories/AlunoRepository.php';
require_once '../app/Models/Aluno.php';

class AlunoService
{
    private $repo;

    public function __construct()
    {
        $this->repo = new AlunoRepository();
    }

    public function listarAlunos()
    {
        return $this->repo->listarTodos();
    }

    public function cadastrar($nome, $dataNascimento, $cpf, $email, $senha)
    {
        if (strlen($nome) < 3) {
            throw new Exception("O nome deve ter no mínimo 3 caracteres.");
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("E-mail inválido.");
        }

        $regexSenha = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/";
        if (! preg_match($regexSenha, $senha)) {
            throw new Exception("Senha fraca. Deve conter maiúscula, minúscula, número e símbolo.");
        }

        $cpf = preg_replace('/\D/', '', $cpf);

        if ($this->repo->buscarPorCpf($cpf)) {
            throw new Exception("Já existe um aluno cadastrado com este CPF.");
        }
        if ($this->repo->buscarPorEmail($email)) {
            throw new Exception("Já existe um aluno cadastrado com este e-mail.");
        }

        // formatar data
        $dataNascimento = $this->formatarData($dataNascimento);

        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

        $aluno = new Aluno($nome, $dataNascimento, $cpf, $email, $senhaHash);
        return $this->repo->salvar($aluno);
    }

    public function buscarPorId($id)
    {
        return $this->repo->buscarPorId($id);
    }

    public function atualizar($id, $nome, $dataNascimento, $cpf, $email, $senha = null)
    {
        if (strlen($nome) < 3) {
            throw new Exception("O nome deve ter no mínimo 3 caracteres.");
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("E-mail inválido.");
        }

        $alunoExistente = $this->repo->buscarPorId($id);
        if (! $alunoExistente) {
            throw new Exception("Aluno não encontrado.");
        }

        $cpfDuplicado = $this->repo->buscarPorCpf($cpf);
        if ($cpfDuplicado && $cpfDuplicado['id'] != $id) {
            throw new Exception("Já existe outro aluno com este CPF.");
        }

        $emailDuplicado = $this->repo->buscarPorEmail($email);
        if ($emailDuplicado && $emailDuplicado['id'] != $id) {
            throw new Exception("Já existe outro aluno com este e-mail.");
        }

        if (empty($senha)) {
            $senhaHash = $alunoExistente['senha'];
        } else {
            $regexSenha = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/";
            if (! preg_match($regexSenha, $senha)) {
                throw new Exception("Senha fraca. Deve conter maiúscula, minúscula, número e símbolo.");
            }
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        }

        $dataNascimento = $this->formatarData($dataNascimento);
        $aluno          = new Aluno($nome, $dataNascimento, $cpf, $email, $senhaHash);

        return $this->repo->atualizar($id, $aluno);
    }

    public function excluir($id)
    {
        return $this->repo->excluir($id);
    }

    public function buscarPorNome($nome)
    {
        return $this->repo->buscarPorNome($nome);
    }

    private function formatarData($data)
    {

        if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $data, $matches)) {
            return $matches[3] . '-' . $matches[2] . '-' . $matches[1];
        }
        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $data)) {
            return $data;
        }
        throw new Exception("Data inválida. Use o formato DD/MM/AAAA.");
    }

}
