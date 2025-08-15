<?php

require_once(__DIR__ . "/../dao/AlunoDAO.php");
require_once(__DIR__ . "/../model/Aluno.php");
require_once(__DIR__ . "/../service/AlunoService.php");

class AlunoController
{

    private AlunoDAO $alunoDAO;
    private AlunoService $alunoService;

    public function __construct()
    {
        $this->alunoDAO = new AlunoDAO();
        $this->alunoService = new AlunoService();
    }

    public function listar()
    {
        $lista = $this->alunoDAO->listar();
        return $lista;
    }
    public function buscarPorID(int $id){
        $aluno = $this->alunoDAO->buscarPorID($id);
        return $aluno;    
    }

    public function inserir(Aluno $aluno)
    {
        $erros = $this->alunoService->validarAluno($aluno);
        if (count($erros)> 0) {
            return $erros;
        }
        /// sem erros é vapo pro DAO 

        $erros = array();

        $erro = $this->alunoDAO->inserir($aluno);
        if ($erro) {
            array_push($erros, 'Erro ao salvar o aluno!');
            if (AMB_DEV) {
                array_push($erros, $erro->getMessage());
            }
        }

        return $erros;
    }
}
