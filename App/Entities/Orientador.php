<?php 

	namespace App\Entities;

	/**
	 * Somente para armazenar os dados
	 * Class Orientador
	 */
	class Orientador
	{	

		public $id;
		public $tipo;
		public $tcc;
		public $nome;
		public $titulo;
		public $instituicao;
		public $telefone;
		public $email;
		public $registro;
		
		/*function __construct($id, $tipo, $tcc, $nome,$titulo,$instituicao, $telefone, $email, $registro)
		{
			$this->id = $id;
			$this->tipo = $tipo;
			$this->tcc = $tcc;
			$this->nome = $nome;
			$this->titulo = $titulo;
			$this->instituicao = $instituicao;
			$this->telefone = $telefone;
			$this->email = $email;
			$this->registro = $registro;
		}*/

	}//end class