<?php

class Matricula {
    public $alunoId;
    public $turmaId;

    public function __construct($alunoId, $turmaId) {
        $this->alunoId = $alunoId;
        $this->turmaId = $turmaId;
    }
}
