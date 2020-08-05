<?php
    require_once "../../vendor/autoload.php";

    #valida a sessao
    $access = new \App\Utility\Access();
    $access->validaSession("../../index.html");


    //pegar dados
    $crud =  \App\Bd\Crud::getInstance(\App\Bd\Database::conexao());

    $sql = "SELECT * FROM `curso`";

    $cursos = $crud->select($sql);

    $page = 2;
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ICET:: GEDOT :: Dados</title>

     <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../../css/siderbar.css">
    <!-- Font Awesome JS -->
    <script defer src="../../js/solid.js"></script>
    <script defer src="../../js/fontawesome.js"></script>
</head>
<body>
    <?php include "includes/menu.php" ?>
    <div class="container mt-5">
        <form>
        <div class="card shadow">
            <div class="card-header">
                Meus dados
            </div>
            <div class="card-body">
                 <div class="form-row">
                    <div class="form-group col">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="" required="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="" required="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="telefone">Telefone:</label>
                        <input type="text" class="form-control" name="telefone" id="telefone" value="" required="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="curso">Curso:</label>
                        <select name="curso" id="curso" required="" class="form-control">
                            <option value="">Selecione...</option>
                            <?php 

                                if(!empty($cursos))
                                    foreach ($cursos as $value):
                             ?>
                            <option value="<?=$value->id?>"><?=$value->descricao?>.</option>
                        <?php   endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="matricula">Matricula:</label>
                        <input type="text" class="form-control" id="matricula" disabled="">
                    </div>
                </div>
                <span>Semestre Atual</span>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="ano">Ano:</label>
                        <input type="text" class="form-control" name="ano" id="ano" value="" maxlength="4" required="">
                    </div>
                    <div class="form-group mx-auto col-1">
                        <label for="">&nbsp</label>
                        <input type="text" class="form-control-plaintext text-center" value="/" disabled="">
                    </div>
                    <div class="form-group col">
                        <label for="semestre">Semestre:</label>
                        <select name="semestre" id="semestre" class="form-control" required="">
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Salvar</button>
            </div>
        </div>
        </form>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../../js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../../js/bootstrap.min.js"></script>
    <!-- Extrax -->
    <script src="../../js/funcoes.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            getData("../../control/get_discent.php",({nome,email,telefone,matricula,semestre,ano,curso}) => {


                $("#nome").val(nome);
                $("#email").val(email);
                $("#telefone").val(telefone);
                $("#matricula").val(matricula);
                $("#semestre").val(semestre);
                $("#ano").val(ano);
                $("#curso").val(curso);

                let form = new FormValidate('form',new Button('form > button[type=submit]'), null);
                    form.setAction('../../control/put_discent.php');
            });

        });
    </script>
</body>
</html>