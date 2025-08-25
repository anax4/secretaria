<?php

class Aluno
{
    public $id;
    public $nome;
    public $dataNascimento;
    public $cpf;
    public $email;
    public $senha;

    public function __construct($nome, $dataNascimento, $cpf, $email, $senha = null)
    {
        $this->nome           = htmlspecialchars(trim($nome));
        $this->dataNascimento = $dataNascimento;
        $this->cpf            = htmlspecialchars(trim($cpf));
        $this->email          = filter_var($email, FILTER_SANITIZE_EMAIL);
        $this->senha          = $senha;
    }
}
