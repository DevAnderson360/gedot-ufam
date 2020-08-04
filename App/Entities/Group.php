<?php

	namespace App\Entities;

	/**
	 * undocumented class
	 * Agrupa todos os dicentes separados por turma
	 *
	 * @package Entities
	 * @author Anderson Nogueira Silvério
	 **/
	class Group extends \App\Bd\Crud
	{

		private $group;

		function __construct($conexao)
		{
			self::getInstance($conexao);
			$this->group = null;
		}

		//------------------
		/**
		 *
		 * @return $group
		 * @author default 
		 **/
		function getGroup()
		{
			return $this->group;
		}
		//------------------

		/**
		 * Metodo para listagem em workspace/teacher/index
		 * @param [$ano, $semestre, $curso]				
		 * @return boolean
		 * @author Default
		 **/
		function get($ano, $semestre, $curso)
		{
			$sql = "SELECT discente.id, discente.nome, discente.matricula, (SELECT curso.descricao FROM curso WHERE curso.id = discente.curso) as curso FROM `discente` WHERE ano = ? AND semestre = ? AND curso = ?";

			$data = self::$crud->select($sql,array($ano, $semestre, $curso));

			if($data !== null){
				$this->group = $data;
				return true;
			}

			return false;
				
		}




	} // END Group class 
