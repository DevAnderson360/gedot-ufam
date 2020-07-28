<?php
	session_start();

	include "conexao.php";

	main();

	function main(){

		echo update(
			$_POST["nome"],
			$_POST["email"],
			$_POST["telefone"],
			$_POST["matricula"],
			$_POST["ano"],
			$_POST["semestre"]);

	}

	/**
	 * altera dados no banco
	 *
	 * @return json
	 * @author Anderson
	 **/
	function update ($nome, $email,$telefone,$matricula,$ano,$semestre)
	{
		$sql = "UPDATE `discente` SET `nome` = ?, `email` = ?, `telefone` = ?, `matricula` = ?, `ano` = ?, `semestre` = ? WHERE id = ?";

		$conn = Database::conexao();

		$query = $conn->prepare($sql);

		/*Remove caracteres especiais da string telefone*/		
		$telefone = str_replace(' ', '', str_replace('(', '', str_replace(')', '', str_replace('-', '', $telefone))));

		$query->bind_param('sssssss',$nome,$email,$telefone,$matricula,$ano,$semestre,$_SESSION['id']);

		if($query->execute())
			return json('success','Dados alterados com sucesso!');

		return json('error','Erro na atualização! \nTente novamente...');

	}

	/**
	 * 
	 *
	 * @return retorna uma dados em json
	 * @author anderson
	 **/
	function json($status, $msg)
	{
		return json_encode(array("status"=>$status,"msg"=>$msg));
	}

	