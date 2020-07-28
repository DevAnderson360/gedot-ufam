<?php
	/*
		PARA SER USADO NA PAGINA DE EDIÇÃO DOS DADOS PESSOAIS DO USUARIO;
		SOMENTE PEGA NO BANCO OS DADOS JÁ CADASTRASDOS.
		NÃO FOI FEITO TRATAMENTO POIS TEORICAMENTE O USUARIO TERÁ QUE PASSAR PELO
		CADASTRO PARA PODER ENTRAR E EDITAR;
	*/
	session_start();

	//garante que somente quem está logado acesse o sistema!
    if(empty($_SESSION["id"])){
    echo "<script>
            alert('É preciso está logado!')
            window.location.replace('logoff.php'); 
          </script>";
    }

	include "conexao.php";

	$dados = null;

	$id = $_SESSION['id'];

	$sql = "SELECT * FROM discente WHERE id = ?";

	$conn = Database::conexao();

	$query = $conn->prepare($sql);

	$query->bind_param('s',$id);

	$query->execute();

	$result = $query->get_result();

	$dados = $result->fetch_assoc();
