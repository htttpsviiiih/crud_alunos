<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once(__DIR__ . "/../../model/Aluno.php");
require_once(__DIR__ . "/../../controller/AlunoController.php");

$msgErro = "";
$aluno = null;

if (isset($_POST['nome'])) {
    //clicou no gravar

    // 1- capturar os dados do formulario

    if (isset($_POST['nome'])) {
        //Usuário já clicou no gravar
        $nome  = trim($_POST['nome']) ? trim($_POST['nome']) : null;
        $idade = is_numeric($_POST['idade']) ? $_POST['idade'] : null;
        $estrangeiro = trim($_POST['estrang']) ? trim($_POST['estrang']) : null;
        $idCurso = is_numeric($_POST['curso']) ? $_POST['curso'] : null;

        //Criar um objeto Aluno para persistí-lo
        $aluno = new Aluno();
        $aluno->setNome($nome);
        $aluno->setIdade($idade);
        $aluno->setEstrangeiro($estrangeiro);

        $curso = new Curso();
        $curso->setId($idCurso);
        $aluno->setCurso($curso);
        //print_r($aluno);

        //Chamar o DAO para alterar o objeto Aluno
        $alunoCont = new AlunoController();
        $erros = $alunoCont->alterar($aluno);

        if (! $erros) {
            //redirecionando pro listar
            header("location : listar.php");
        } else {
            //convertendo para string

            $msgErro = implode("<br>", $erros);
        }
    }

} else {
    //abriu o formulario
    $id = 0;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    $id = $_GET['id'];

    // 2- chamar o controller para alterar
    $alunoCont = new AlunoController();
    $aluno = $alunoCont->buscarPorId($id);

    if (! $aluno) {
        echo "ID do aluno é inválido";
        echo "<a href = 'listar.php'>Voltar</a>";
        exit;
    }
}
include_once(__DIR__ . "/form.php");
