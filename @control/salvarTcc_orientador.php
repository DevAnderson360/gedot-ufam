<?php 
	session_start();

	include "conexao.php";

	if($_POST)
		echo main();

	function main(){
		if(empty($_POST['orientador'][0]))
			return insert();
		else
			return update();
	}

	function insert(){
		$sql = "INSERT INTO `orientador`(`tcc`, `nome`, `titulo`, `instituicao`, `telefone`, `email`, `tipo`) VALUES (?,?,?,?,?,?,1),(?,?,?,?,?,?,2)";

		$conn = Database::conexao();

		$query = $conn->prepare($sql);

		$query->bind_param('ssssssssssss',
		$_POST['id'],$_POST['nome'][0],$_POST['titulo'][0],$_POST['instituicao'][0],$_POST['telefone'][0],$_POST['email'][0],
		$_POST['id'],$_POST['nome'][1],$_POST['titulo'][1],$_POST['instituicao'][1],$_POST['telefone'][1],$_POST['email'][1],);

		if($query->execute())
			return json('success','Dados alterados com sucesso!');

		return json('error','Erro na atualização! \nTente novamente...');
	}

	function update2($nome,$titulo,$instituicao,$telefone,$email,$orientador)
	{
		$sql = "UPDATE `orientador` SET `nome` = ?, `titulo` = ?, `instituicao` = ?, `telefone` = ?,`email` = ?, `registro` = now() WHERE id = ?";

		$conn = Database::conexao();

		$query = $conn->prepare($sql);

		$query->bind_param('ssssss',$nome,$titulo,$instituicao,$telefone,$email,$orientador);

		return $query->execute();
			
	}

	function update(){
		if(update2($_POST['nome']['0'],$_POST['titulo']['0'],$_POST['instituicao']['0'],$_POST['telefone']['0'],$_POST['email']['0'],$_POST['orientador']['0'])){
			if(update2($_POST['nome']['1'],$_POST['titulo']['1'],$_POST['instituicao']['1'],$_POST['telefone']['1'],$_POST['email']['1'],$_POST['orientador']['1'])){
				return json('success','Dados alterados com sucesso!');
			}
		}
		return json('error','Erro na atualização! \nTente novamente...');
	}

	function json($status, $msg)
	{
		return json_encode(array("status"=>$status,"msg"=>$msg));
	}