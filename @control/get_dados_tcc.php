<?php
    /*
        PARA SER USADO NA PAGINA DE EDIÇÃO DOS DADOS DO TCC DO USUARIO;
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
    
    $conn = Database::conexao();


    function getTitulos($conn)
    {

        $sql = "SELECT * FROM titulo";

        $query = $conn->prepare($sql);

        $query->execute();

        $result = $query->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    //busca dados do tcc;
    function getTcc($conn)
    {
    	$sql = "SELECT * FROM tcc WHERE discente = ?";

        $query = $conn->prepare($sql);

        $query->bind_param('s',$_SESSION['id']);

        $query->execute();

        $result = $query->get_result();

		if($result->num_rows > 0)
			return $result->fetch_assoc();

		return null;
    }

    /**
     * pega da var correspondente
     *
     * @return string
     * @author Anderson
     **/
    function getValue ($dados,$campo)
    {
    	return empty($dados) ? "" : $dados[$campo];
    }

    function getValue2 ($dados,$index,$campo)
    {
    	return empty($dados[$index]) ? "" : $dados[$index][$campo];
    }

    function getOrientadores($tcc,$conn)
    {
    	$sql = "SELECT * FROM `orientador` WHERE tcc = ?";

        $query = $conn->prepare($sql);

        $query->bind_param('s',$tcc);

        $query->execute();

        $result = $query->get_result();
        
        if($result->num_rows > 0)
        	return $result->fetch_all(MYSQLI_ASSOC);

        return null;
    }

    function getAvaliadores($tcc,$conn)
    {
    	$sql = "SELECT * FROM `avaliador` WHERE tcc = ?";

        $query = $conn->prepare($sql);

        $query->bind_param('s',$tcc);

        $query->execute();

        $result = $query->get_result();
        
        if($result->num_rows > 0)
        	return $result->fetch_all(MYSQLI_ASSOC);

        return null;
    }

    //$_SESSION['id'] = "1";

    //dados para o formulario;
    $titulos = getTitulos($conn);

    //dados do tcc se houverem;
    $dadosTcc = getTcc($conn);

    //gatilho para saber se vamos editar ou inserir os dados
    //0 para inserir ou a id do tcc para editar;
    $tcc_id = $dadosTcc === null ? 0 : getValue($dadosTcc,'id');

    //--dados tcc--
    $tcc_titulo = getValue($dadosTcc,'titulo');
    $tcc_defesa = getValue($dadosTcc,'data_avaliacao');

    $orientadores = getOrientadores($tcc_id,$conn);
    
    //var_dump($orientadores);
    //--dados orientador 1
    $orientador_id          = getValue2($orientadores,0,'id');
    $orientador_nome        = getValue2($orientadores,0,'nome');
    $orientador_instituicao = getValue2($orientadores,0,'instituicao');
    $orientador_telefone    = getValue2($orientadores,0,'telefone');
    $orientador_email       = getValue2($orientadores,0,'email');
    $orientador_titulo      = getValue2($orientadores,0,'titulo');

    //--dados orientador 2
    $corientador_id          = getValue2($orientadores,1,'id');
    $corientador_nome        = getValue2($orientadores,1,'nome');
    $corientador_instituicao = getValue2($orientadores,1,'instituicao');
    $corientador_telefone    = getValue2($orientadores,1,'telefone');
    $corientador_email       = getValue2($orientadores,1,'email');
    $corientador_titulo      = getValue2($orientadores,1,'titulo');

    $avaliadores = getAvaliadores($tcc_id,$conn);

    //--dados avaliador 1
    $avaliador_id          = getValue2($avaliadores,0,'id');
    $avaliador_nome        = getValue2($avaliadores,0,'nome');
    $avaliador_instituicao = getValue2($avaliadores,0,'instituicao');
    $avaliador_telefone    = getValue2($avaliadores,0,'telefone');
    $avaliador_email       = getValue2($avaliadores,0,'email');
    $avaliador_titulo      = getValue2($avaliadores,0,'titulo');
    $avaliador_cargo       = getValue2($avaliadores,0,'cargo');
    $avaliador_cidade      = getValue2($avaliadores,0,'cidade');
    
    //--dados avaliador 2
    $cavaliador_id          = getValue2($avaliadores,1,'id');
    $cavaliador_nome        = getValue2($avaliadores,1,'nome');
    $cavaliador_instituicao = getValue2($avaliadores,1,'instituicao');
    $cavaliador_telefone    = getValue2($avaliadores,1,'telefone');
    $cavaliador_email       = getValue2($avaliadores,1,'email');
    $cavaliador_titulo      = getValue2($avaliadores,1,'titulo');
    $cavaliador_cargo       = getValue2($avaliadores,1,'cargo');
    $cavaliador_cidade      = getValue2($avaliadores,1,'cidade');

