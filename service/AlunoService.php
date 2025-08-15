<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once(__DIR__ . "/../model/Aluno.php");

class AlunoService
{
    public function validarAluno(Aluno $aluno)
    {
        $erros = array();
        if ($aluno->getNome() == NULL) {
            array_push($erros, 'Informe o nome do aluno!');
        }
        if ($aluno->getIdade()== NULL || $aluno->getIdade() < 0 || $aluno->getIdade() > 100) {
            array_push($erros, "Insira uma idade válida!");
        }
        if($aluno ->getEstrangeiro() == NULL){
            array_push ($erros, "Selecione sua nacionalidade!");
        }
        if ($aluno ->getCurso()->getId() == NULL) {
            array_push($erros, 'Selecione o curso!');
        }

        return $erros;
    }
}
