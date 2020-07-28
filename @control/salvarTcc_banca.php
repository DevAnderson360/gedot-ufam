<?php 
	session_start();

	include "conexao.php";

	if($_POST)
		echo main();
		//var_dump($_POST);

	function main(){
		if(empty($_POST['avaliador'][0]))
			return insert();
		else
			return update();
	}

	function insert(){
		$sql = "INSERT INTO `avaliador`(`tcc`, `titulo`, `nome`, `instituicao`, `telefone`, `email`, `cidade`, `cargo`) VALUES (?,?,?,?,?,?,?,?),(?,?,?,?,?,?,?,?)";

		$conn = Database::conexao();

		$query = $conn->prepare($sql);

		$vazio = "NULL";

		/*Remove caracteres especiais da string telefone*/		
		$_POST['telefone'][0] = str_replace(' ', '', str_replace('(', '', str_replace(')', '', str_replace('-', '', $_POST['telefone'][0]))));
		$_POST['telefone'][1] = str_replace(' ', '', str_replace('(', '', str_replace(')', '', str_replace('-', '', $_POST['telefone'][1]))));

		$query->bind_param('ssssssssssssssss',
		$_POST['id'],$_POST['titulo'][0],$_POST['nome'][0],$_POST['instituicao'][0],$_POST['telefone'][0],$_POST['email'][0],$vazio,$vazio,
		$_POST['id'],$_POST['titulo'][1],$_POST['nome'][1],$_POST['instituicao'][1],$_POST['telefone'][1],$_POST['email'][1],$_POST['cidade'],$_POST['cargo']);

		if($query->execute())
			return json('success','Dados alterados com sucesso!');

		return json('error','Erro na atualização! \nTente novamente...');
	}

	function update2($titulo,$nome,$instituicao,$telefone,$email,$id,$cidade = null, $cargo = null)
	{
		$sql = "UPDATE `avaliador` SET `titulo`=?,`nome`=?,`instituicao`=?,`telefone`=?,`email`=?,`cidade`=?,`cargo`=?,`registro`=now() WHERE id = ?";

		$conn = Database::conexao();

		$query = $conn->prepare($sql);

		/*Remove caracteres especiais da string telefone*/		
		$telefone = str_replace(' ', '', str_replace('(', '', str_replace(')', '', str_replace('-', '', $telefone))));

		$query->bind_param('ssssssss',$titulo,$nome,$instituicao,$telefone,$email,$cidade,$cargo,$id);

		return $query->execute();
			
	}

	function update(){
		$vazio = "NULL";
		if(update2($_POST['titulo'][0],$_POST['nome'][0],$_POST['instituicao'][0],$_POST['telefone'][0],$_POST['email'][0],$_POST['avaliador'][0])){
			if(update2($_POST['titulo'][1],$_POST['nome'][1],$_POST['instituicao'][1],$_POST['telefone'][1],$_POST['email'][1],$_POST['avaliador'][1],$_POST['cidade'],$_POST['cargo'])){
				return json('success','Dados alterados com sucesso!');
			}
		}
		return json('error','Erro na atualização! \nTente novamente...');
	}

	function json($status, $msg)
	{
		return json_encode(array("status"=>$status,"msg"=>$msg));
	}