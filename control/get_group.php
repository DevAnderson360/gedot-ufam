<?php
	
	main();

	function main()
	{
		require_once "../vendor/autoload.php";

		//instance Group
		$group = new \App\Entities\Group(\App\Bd\Database::conexao());

		$ano = $_POST['ano'];
		$semestre = $_POST['semestre'];
		$curso = $_POST['curso'];

		//ano,semestre,curso
		if($group->get($ano, $semestre, $curso))
			echo \App\Utility\Tools::response_json('OK','success', $group->getGroup());
		else
			echo \App\Utility\Tools::response_json('fail','Sem discente para listar.');
	}