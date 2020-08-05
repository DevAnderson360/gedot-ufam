<?php 
    require_once "../../vendor/autoload.php";

    #valida a sessao
    $access = new \App\Utility\Access();
    //$access->validaSession("../../index.html");

    if(empty($_REQUEST['id'])){
        $access->alerta('Indentificador não encontrado.');
        $access->redireciona('./');
    }


    $conn = \App\Bd\Database::conexao();

    $titulos = function()
    {
       global $conn;
       
       $sql = "SELECT * FROM titulo";

       $query = $conn->prepare($sql);

       $query->execute();

       return $query->fetchAll(\PDO::FETCH_OBJ);
    };

	$discente = new \App\Entities\Discent($conn);

	$discente->setId($_REQUEST['id']);
    
    //carregar dados
    //instance tcc
	$dados = new \App\Entities\Tcc($conn);

	$dados->setDiscente($_REQUEST['id']);

	$dados->getBDTcc(true);

	$discente->getBDdiscente(true);

	$orientador = $dados->getOrientador();

	$coorientador = $dados->getCoorientador();

	$avaliadores = $dados->getAvaliadores();

	$avaliador 	= $avaliadores['0'];

	$avaliador2 = $avaliadores['1'];


 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>ICET::GEDOT - Detalhes de Andersons nogueira silvério</title>

     <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../../css/siderbar.css">

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../../js/jquery.min.js"></script>

</head>
<body>

	<div class="container mt-2">
		<div class="card shadow">
			<div class="card-header">Selecione os documentos</div>
			<div class="card-body">
                <select name="documento" id="documento" class="form-control">
				    <option value="a">
				    	Critérios de avaliação do trabalho escrito
				    </option>
				    <option value="b">
				    	Critérios de avaliação do trabalho oral
				    </option>
				    <option value="c">
				    	Comprovante de entrega do TCC para menbros da banca
				    </option>
				    <option value="d">
				    	Declaração de Orientação de TCC (Orientador) -- falta setar professor da disciplina
				    </option>
				    <option value="e">
				    	Declaração de Orientação de TCC (Coorientador) -- falta setar professor da disciplina
				    </option>
				    <option value="f">
				    	Declaração de Avaliação de TCC
				    </option>
				    <option value="h">
				    	Folha
				    </option>
				</select>
			</div>
			<div class="card-footer">
				<div class="row">
					
    				<div class="col-md-2">
    					<button class="btn btn-success" id="generator">Gerar</button>
    				</div>
				</div>
			</div>
		</div>
		<div class="card shadow mt-4 mb-4">
			<div class="card-header">
				Dados do discente
				<br>
				<span class="small">Pode alterar antes de gerar os documentos</span>
			</div>
			<div class="card-body">
				<h5>Dados pessoais</h5>
				<div class="form-row">
                    <div class="form-group col">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" name="discente_nome" id="discente_nome" value="<?=$discente->getNome()?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?=$discente->getEmail()?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="telefone">Telefone:</label>
                        <input type="text" class="form-control" name="telefone" id="telefone" value="<?=$discente->getTelefone()?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="matricula">Matricula:</label>
                        <input type="text" class="form-control" id="matricula" value="<?=$discente->getMatricula()?>">
                    </div>
                </div>
                <span>Semestre Atual</span>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="ano">Ano:</label>
                        <input type="text" class="form-control" name="discente_ano" id="discente_ano" value="<?=$discente->getAno()?>" maxlength="4">
                    </div>
                    <div class="form-group mx-auto col-1">
                        <label for="">&nbsp</label>
                        <input type="text" class="form-control-plaintext text-center" value="/" disabled="">
                    </div>
                    <div class="form-group col">
                        <label for="semestre">Semestre:</label>
                        <select name="discente_semestre" id="discente_semestre" class="form-control">
                            <option value="1" <?php if($discente->getSemestre() == 1) echo "selected" ?> >1</option>
                            <option value="2" <?php if($discente->getSemestre() == 2) echo "selected" ?> >2</option>
                        </select>
                    </div>
                </div>

				<hr>
				<h5>Dados do TCC</h5>
				<div class="form-row">
                    <div class="form-group col">
                        <label for="tcc_titulo">Título do tcc</label>
                        <input type="text" class="form-control" name="tcc_titulo" id="tcc_titulo" value="<?=$dados->getTitulo()?>" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="tcc_data">Data de Defesa</label>
                        <input type="date" class="form-control" name="tcc_data" id="tcc_data" value="<?=$dados->getDataAvaliacao()?>">
                    </div>
                </div>

                <hr>
                <h5>Orientador</h5>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="orientador_titulo">Título do Orientador</label>
                        <select name="orientador_titulo" id="orientador_titulo" class="form-control">
                        <?php foreach ($titulos() as $value): ?>
                            <option value="<?="{$value->abv}"?>" <?php if($value->id === $orientador->titulo) echo "selected"; ?> ><?="{$value->abv} - {$value->descricao}"?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="orientador_nome">Nome completo</label>
                        <input type="text" class="form-control" name="orientador_nome" id="orientador_nome" value="<?=$orientador->nome?>" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="orientador_instituicao">Instituição que trabalha</label>
                        <input type="text" class="form-control" id="orientador_instituicao" name="orientador_instituicao" value="<?=$orientador->instituicao?>" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="orientador_telefone">Telefone</label>
                        <input type="text" class="form-control" name="telefone" data-mask="(00) 00000-0000" data-mask-selectonfocus="true" id="orientador_telefone" value="<?=$orientador->telefone?>" />
                    </div>
                    <div class="form-group col">
                        <label for="orientador_email">E-mail</label>
                        <input type="email" class="form-control" name="email" id="orientador_email" value="<?=$orientador->email?>"  />
                    </div>
                </div>

                <hr>
                <h5>Coorientador</h5>
				<div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="coorientador_titulo">Título</label>
                        <select name="coorientador_titulo" id="coorientador_titulo" class="form-control">
                            <?php foreach ($titulos() as $value): ?>
                            <option value="<?="{$value->abv}"?>" <?php if($value->id === $orientador->titulo) echo "selected"; ?> ><?="{$value->abv} - {$value->descricao}"?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="coorientador_nome">Nome completo</label>
                        <input type="text" class="form-control" name="coorientador_nome" id="coorientador_nome" value="<?=$coorientador->nome?>" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="coorientador_instituicao">Instituição que trabalha</label>
                        <input type="text" class="form-control" id="coorientador_instituicao" value="<?=$coorientador->instituicao?>" name="coorientador_instituicao" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="coorientador_telefone">Telefone</label>
                        <input type="text" class="form-control" name="telefone" id="coorientador_telefone" value="<?=$coorientador->telefone?>" />
                    </div>
                    <div class="form-group col">
                        <label for="coorientador_email">E-mail</label>
                        <input type="email" class="form-control" name="email" value="<?=$coorientador->email?>" id="coorientador_email" />
                    </div>
                </div>

				<hr>
				<h5>Avaliador</h5>
				<div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="avaliador_titulo">Título</label>
                        <select name="avaliador_titulo" id="avaliador_titulo" class="form-control">
                            <?php foreach ($titulos() as $value): ?>
                            <option value="<?="{$value->abv}"?>" <?php if($value->id === $orientador->titulo) echo "selected"; ?> ><?="{$value->abv} - {$value->descricao}"?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="avaliador_nome">Nome completo</label>
                        <input type="text" class="form-control" name="avaliador_nome" id="avaliador_nome" value="<?=$avaliador->nome?>" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="avaliador_instituicao">Instituição que trabalha</label>
                        <input type="text" class="form-control" id="avaliador_instituicao" value="<?=$avaliador->instituicao?>" name="avaliador_instituicao" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="avaliador_telefone">Telefone</label>
                        <input type="text" class="form-control" name="telefone" id="avaliador_telefone" value="<?=$avaliador->telefone?>" />
                    </div>                            
                    <div class="form-group col-md">
                        <label for="avaliador_email">E-mail</label>
                        <input type="email" class="form-control" name="email" value="<?=$avaliador->email?>" id="avaliador_email" />
                    </div>
                </div>
                <div class="form-row">                            
                    <div class="form-group col-md">
                        <label for="avaliador_cidade">Origem</label>
                        <input type="text" class="form-control" name="cidade" value="<?=$avaliador->cidade?>" id="avaliador_cidade" />
                    </div>
                </div>

                <hr>
                <h5>Segundo avaliador</h5>
                 <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="avaliador2_titulo">Título</label>
                        <select name="avaliador2_titulo" id="avaliador2_titulo" class="form-control">
                            <?php foreach ($titulos() as $value): ?>
                                <option value="<?="{$value->abv}"?>" <?php if($value->id === $orientador->titulo) echo "selected"; ?> ><?="{$value->abv} - {$value->descricao}"?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="avaliador2_nome">Nome completo</label>
                        <input type="text" class="form-control" name="avaliador2_nome" id="avaliador2_nome" value="<?=$avaliador2->nome?>" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="avaliador2_instituicao">Instituição ou empresa que trabalha</label>
                        <input type="text" class="form-control" id="avaliador2_instituicao" value="<?=$avaliador2->instituicao?>" name="avaliador2_instituicao" required />
                    </div>
                    <div class="form-group col-md">
                        <label for="avaliador2_cargo">Cargo</label>
                        <input type="text" class="form-control" name="cargo" value="<?=$avaliador2->cargo?>" id="avaliador2_cargo" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="avaliador2_telefone">Telefone</label>
                        <input type="text" class="form-control" name="telefone" id="avaliador2_telefone" value="<?=$avaliador2->telefone?>" />
                    </div>                            
                    <div class="form-group col-md">
                        <label for="avaliador2_email">E-mail</label>
                        <input type="email" class="form-control" name="email" value="<?=$avaliador2->email?>" id="avaliador2_email" />
                    </div>
                </div>
                 <div class="form-row">                            
                    <div class="form-group col-md">
                        <label for="avaliador2_cidade">Origem</label>
                        <input type="text" class="form-control" name="cidade" value="<?=$avaliador2->cidade?>" id="avaliador2_cidade" />
                    </div>
                </div>


			</div>
		</div>

	</div>
    <form id="dataForm" target="__BLANCK" method="POST" ></form>
	<!-- Bootstrap JS -->
    <script src="../../js/bootstrap.min.js"></script>
    <!-- jQuery Custom Scroller -->
    <script src="../../js/funcoes.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

        	let documents = {
        		//documento 1
        		a : (form) => {

        			form.append(`<input type="hidden" name="discente_nome" value="${$("#discente_nome").val()}" />`);
        			form.append(`<input type="hidden" name="discente_ano" value="${$("#discente_ano").val()}" />`);
        			form.append(`<input type="hidden" name="tcc_titulo" value="${$("#tcc_titulo").val()}" />`);
        			form.append(`<input type="hidden" name="orientador_nome" value="${$("#orientador_nome").val()}" />`);
        			form.append(`<input type="hidden" name="coorientador_nome" value="${$("#coorientador_nome").val()}" />`);
        			form.append(`<input type="hidden" name="discente_semestre" value="${$("#discente_semestre").val()}"/>`);

        			form.prop('action', "../../control/documents/criteriosAvaliacaoDefesaEscritoTcc.php")

        			form.submit()
        		},
        		b : (form) => {
        			
        			form.append(`<input type="hidden" name="discente_nome" value="${$("#discente_nome").val()}" />`);
        			form.append(`<input type="hidden" name="discente_ano" value="${$("#discente_ano").val()}" />`);
        			form.append(`<input type="hidden" name="tcc_titulo" value="${$("#tcc_titulo").val()}" />`);
        			form.append(`<input type="hidden" name="orientador_nome" value="${$("#orientador_nome").val()}" />`);
        			form.append(`<input type="hidden" name="coorientador_nome" value="${$("#coorientador_nome").val()}" />`);
        			form.append(`<input type="hidden" name="discente_semestre" value="${$("#discente_semestre").val()}"/>`);


        			form.prop('action', "../../control/documents/criteriosAvaliacaoDefesaOralTcc.php")

        			form.submit()
        		},
        		c : (form) => {
        			
        			form.append(`<input type="hidden" name="discente_nome" value="${$("#discente_nome").val()}" />`);
        			form.append(`<input type="hidden" name="discente_ano" value="${$("#discente_ano").val()}" />`);
        			form.append(`<input type="hidden" name="discente_semestre" value="${$("#discente_semestre").val()}"/>`);

        			form.prop('action', "../../control/documents/comprovanteEntregaTccMenbrosBanca.php")

        			form.submit()
        		},
        		d : (form) => {
        			
        			form.append(`<input type="hidden" name="discente_nome" value="${$("#discente_nome").val()}"  />`);
        			form.append(`<input type="hidden" name="discente_ano" value="${$("#discente_ano").val()}"  />`);
        			form.append(`<input type="hidden" name="discente_semestre" value="${$("#discente_semestre").val()}"/>`);

        			form.append(`<input type="hidden" name="orientador_titulo" value="${$("#orientador_titulo").val()}"/>`);
        			form.append(`<input type="hidden" name="orientador_nome" value="${$("#orientador_nome").val()}"  />`);
        			form.append(`<input type="hidden" name="orientador_instituicao" value="${$("#orientador_instituicao").val()}"  />`);

        			form.append(`<input type="hidden" name="tcc_titulo" value="${$("#tcc_titulo").val()}"  />`);
        			form.append(`<input type="hidden" name="tcc_data" value="${$("#tcc_data").val()}"  />`);

        			form.append(`<input type="hidden" name="avaliador_titulo" value="${$("#avaliador_titulo").val()}"/>`);
        			form.append(`<input type="hidden" name="avaliador_nome" value="${$("#avaliador_nome").val()}"  />`);
        			form.append(`<input type="hidden" name="avaliador_instituicao" value="${$("#avaliador_instituicao").val()}"  />`);

        			form.append(`<input type="hidden" name="avaliador2_titulo" value="${$("#avaliador2_titulo").val()}"/>`);
        			form.append(`<input type="hidden" name="avaliador2_nome" value="${$("#avaliador2_nome").val()}"  />`);
        			form.append(`<input type="hidden" name="avaliador2_instituicao" value="${$("#avaliador2_instituicao").val()}"  />`);

        			form.prop('action', "../../control/documents/declaracaoOrientacaoTcc.php")

        			form.submit()
        		},
        		e : (form) => {
        			
        			form.append(`<input type="hidden" name="discente_nome" value="${$("#discente_nome").val()}"  />`);
        			form.append(`<input type="hidden" name="discente_ano" value="${$("#discente_ano").val()}"  />`);
        			form.append(`<input type="hidden" name="discente_semestre" value="${$("#discente_semestre").val()}"/>`);

        			form.append(`<input type="hidden" name="coorientador_titulo" value="${$("#coorientador_titulo").val()}"/>`);
        			form.append(`<input type="hidden" name="coorientador_nome" value="${$("#coorientador_nome").val()}"  />`);
        			form.append(`<input type="hidden" name="coorientador_instituicao" value="${$("#coorientador_instituicao").val()}"  />`);

        			form.append(`<input type="hidden" name="tcc_titulo" value="${$("#tcc_titulo").val()}"  />`);
        			form.append(`<input type="hidden" name="tcc_data" value="${$("#tcc_data").val()}"  />`);

        			form.append(`<input type="hidden" name="avaliador_titulo" value="${$("#avaliador_titulo").val()}"/>`);
        			form.append(`<input type="hidden" name="avaliador_nome" value="${$("#avaliador_nome").val()}"  />`);
        			form.append(`<input type="hidden" name="avaliador_instituicao" value="${$("#avaliador_instituicao").val()}"  />`);

        			form.append(`<input type="hidden" name="avaliador2_titulo" value="${$("#avaliador2_titulo").val()}"/>`);
        			form.append(`<input type="hidden" name="avaliador2_nome" value="${$("#avaliador2_nome").val()}"  />`);
        			form.append(`<input type="hidden" name="avaliador2_instituicao" value="${$("#avaliador2_instituicao").val()}"  />`);

        			form.prop('action', "../../control/documents/declaracaoOrientacaoTcc2.php")

        			form.submit()
        		},
        		f : (form) => {
        			
        			form.append(`<input type="hidden" name="avaliador_nome" value="${$("#avaliador_nome").val()}"/>`);
        			form.append(`<input type="hidden" name="avaliador2_nome" value="${$("#avaliador2_nome").val()}"/>`);
        			form.append(`<input type="hidden" name="avaliador_instituicao" value="${$("#avaliador_instituicao").val()}"/>`);
        			form.append(`<input type="hidden" name="avaliador2_instituicao" value="${$("#avaliador2_instituicao").val()}"/>`);

        			form.append(`<input type="hidden" name="tcc_data" value="${$("#tcc_data").val()}"/>`);
        			form.append(`<input type="hidden" name="tcc_titulo" value="${$("#tcc_titulo").val()}"/>`);

        			form.append(`<input type="hidden" name="orientador_nome" value="${$("#orientador_nome").val()}"/>`);
        			form.append(`<input type="hidden" name="orientador_titulo" value="${$("#orientador_titulo").val()}"/>`);
        			
        			form.append(`<input type="hidden" name="discente_nome" value="${$("#discente_nome").val()}"/>`);
        			form.append(`<input type="hidden" name="discente_semestre" value="${$("#discente_semestre").val()}"/>`);
        			form.append(`<input type="hidden" name="discente_ano" value="${$("#discente_ano").val()}"/>`);


        			form.prop('action', "../../control/documents/declaracaoAvaliacaoTcc.php")

        			form.submit()
        		},
        		h : (form) => {

        			//folha
        			
        			form.append(`<input type="hidden" name="orientador_nome" value="${$("#orientador_nome").val()}"/>`);
        			form.append(`<input type="hidden" name="orientador_titulo" value="${$("#orientador_titulo").val()}"/>`);
        			form.append(`<input type="hidden" name="orientador_instituicao" value="${$("#orientador_instituicao").val()}"/>`);

        			form.append(`<input type="hidden" name="avaliador_nome" value="${$("#avaliador_nome").val()}"/>`);
        			form.append(`<input type="hidden" name="avaliador2_nome" value="${$("#avaliador2_nome").val()}"/>`);

        			form.append(`<input type="hidden" name="avaliador_titulo" value="${$("#avaliador_titulo").val()}"/>`);
        			form.append(`<input type="hidden" name="avaliador2_titulo" value="${$("#avaliador2_titulo").val()}"/>`);

        			form.append(`<input type="hidden" name="avaliador_instituicao" value="${$("#avaliador_instituicao").val()}"/>`);
        			form.append(`<input type="hidden" name="avaliador2_instituicao" value="${$("#avaliador2_instituicao").val()}"/>`);

        			form.append(`<input type="hidden" name="discente_nome" value="${$("#discente_nome").val()}"/>`);

        			form.append(`<input type="hidden" name="tcc_titulo" value="${$("#tcc_titulo").val()}"/>`);
        			form.append(`<input type="hidden" name="tcc_data" value="${$("#tcc_data").val()}"/>`);

        			form.prop('action', "../../control/documents/folha.php")

        			form.submit()
        		},
        		
        	}


        	$("#generator").click(()=>{
        		let form = $('#dataForm');
        		let option = $("#documento").val();
        		documents[option](form)

        	})
        })
    </script>
</body>
</html>