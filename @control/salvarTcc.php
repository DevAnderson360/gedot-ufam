<?php 
	session_start();

	include "conexao.php";

	if($_POST)
		echo main();

	function main(){
		if($_POST['id'] == 0)
			return insert();
		else
			return update();
	}

	function insert(){
		$sql = "INSERT INTO `tcc`(`titulo`, `discente`, `data_avaliacao`) VALUES (?,?,?)";

		$conn = Database::conexao();

		$query = $conn->prepare($sql);

		$query->bind_param('sss',$_POST['tituloTcc'],$_SESSION['id'],$_POST['data']);

		if($query->execute())
			return json('success','Dados alterados com sucesso!');

		return json('error','Erro na atualização! \nTente novamente...');
	}

	function update()
	{
		$sql = "UPDATE `tcc` SET `titulo` = ?, `data_avaliacao` = ?, `registro` = now() WHERE id = ?";

		$conn = Database::conexao();

		$query = $conn->prepare($sql);

		$query->bind_param('sss',$_POST['tituloTcc'],$_POST['data'],$_POST['id']);

		if($query->execute())
			return json('success','Dados alterados com sucesso!');

		return json('error','Erro na atualização! \nTente novamente...');
	}

	function json($status, $msg)
	{
		return json_encode(array("status"=>$status,"msg"=>$msg));
	}