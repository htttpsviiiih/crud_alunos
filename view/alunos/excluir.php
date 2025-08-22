<?php
require_once(__DIR__ . "/../../controller/AlunoController.php");
//1- Receber o ID do aluno (GET)

$id = 0;
if(isset($_GET['id'])){
   $id = $_GET['id'];
}
//2- Chamar o controler para excluir
$alunoCont = new AlunoController();
$aluno = $alunoCont->buscarPorId($id);

if ($aluno) {
   
   $erros = $alunoCont->excluir($aluno->getId());
   if ($erros) {
      $msgErros = implode("<br>, $erros");
      echo $msgErros;
   }
   else {
      header('location: listar.php');
      exit;
   }
}else{
   echo "Aluno não encontrado!<br>";
   echo "<a href = 'listar.php'>Voltar</a>";
}

//3- Verfica se deu erro

   //3.1- SIM: exibe o erro na própria página

   //3.2- NÃO (sucesso): redireciona para o LISTAR

