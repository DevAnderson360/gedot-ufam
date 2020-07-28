<?php
namespace App\Utility;
	
	/**
	 * Classe para login e acesso
	 */

	class Access{

	    //email/registro/cadastro/matricula/etc
	    private $login;
	    private $senha;

	    private $table;
	    private $campLogin;
	    private $campSenha;
	    
	    //armazena os dados do select
	    private $dados;

	    private $conexao;

	    //var de erro
	    public $erro;

	    public function __construct()
	    {
	        session_start();
	    }

	    /**
	     * Seta tabela e campos para consulta;
	     *
	     * @return void
	     **/
	    
	    public function setData($table, $campLogin, $campSenha)
	    {
	    	$this->table = $table;
	    	$this->campLogin = $campLogin;
	    	$this->campSenha = $campSenha;
	    }
	    
	    
	    public function validar($login, $senha, $conexao = null){
	    	$st = false;
	    	if($this->setLogin($login) && $this->setSenha($senha)){
	    		
	    		$this->conexao = $conexao;
	    		
	    		if($this->creatSession()){
	    			$st =  true;
	    		}
	    	}
	    	return $st;
	    }

	    /*pode criar um validador dependendo do tipo de login
	    	Ex. email, validador de email
	    */
	    private function setLogin($login){
	    	$this->login = $login;
	    	return true;
	    }

	    private function setSenha($senha){
	        $this->senha = $senha;
	        return true;
	    }

	    public function alerta($msg){
	    	echo "<script> alert('".$msg."'); </script>";
	    }

	    //redireciona a pagina atual
	    //$pg recebe a pagina para onde quer ir
	    public function redireciona($pg){
	    	echo "<script> window.location.replace('".$pg."'); </script>";
	    }

	    private function getNome($nome){
	    	$nome = explode(' ', $nome);
	    	return $nome[0];
	    }

	    //cria a sessão
	    private function creatSession(){
	    	if($this->consultaBanco()){
	    		//seta a var de sessão conforme os dados do banco de dados
	    		//retornados na consulta ao banco
	    		$_SESSION['gedot'] = true; // para validar session;
	    		$_SESSION['user_id'] = $this->dados->id;
	    		$_SESSION['user_name'] = $this->dados->nome;
	    		$_SESSION['user_shot_name'] = $this->getNome($this->dados->nome);
	    		$_SESSION['user_matricula'] = $this->dados->matricula;
	    		return true;
	    	}else{
	    		$this->logOut();
	    		return false;
	    	}
	    }

	    /*
		*	Faz o select na table de usuario usando o login e senha,
	    */
	    private function consultaBanco(){
	    	
	        //prepara query para consulta
	    	$query = $this->conexao->prepare("SELECT * FROM {$this->table} WHERE {$this->campLogin} = ? AND {$this->campSenha} = ?");
	    	//faz ligação das variaveis
	    	$query->bindValue(1,$this->login);
	    	$query->bindValue(2,$this->senha);

	    	//execucao e tratamento de erros
	    	try {
	    		$query->execute();

	    		if($query->rowCount() > 0){
	    			//armazena na var dados o retorno da consulta se achar algo
	    			$this->dados = $query->fetch(\PDO::FETCH_OBJ);
	    			return true;
	    		}else{
	    			//se não encontrar nada
	    			$this->erro = "Não encontrei nada no banco \\n";
	    			return false;
	    		}

	    	} catch (Exception $e) {
	    		$this->erro = "Erro ao execultar consulta \\n".$e;
	    		return false;
	    	}
	    }

	    public function validaSession($pg){//verifica se a sessão esta ativa
	    	if(empty($_SESSION['gedot'])){
	    		$this->logOut();
	    		$this->alerta ("É preciso esta logado para acessar o sistema!");
	    		$this->redireciona($pg);
	    		return false;
	    	}else{
	    		return true;
	    	}

	    }

	    public function validaSessionNr(){//verifica se a sessão esta ativa e não redireciona
	    	if(empty($_SESSION['gedot'])){
	    		$this->logOut();
	    		return false;
	    	}
	    	
	    	return true;

	    }


	    public function logOut(){
	    	session_destroy(); //mata a session
	    }

	}//fim da class



 ?>