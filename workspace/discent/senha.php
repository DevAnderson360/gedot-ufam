<?php
    require_once "../../vendor/autoload.php";

    #valida a sessao
    $access = new \App\Utility\Access();
    $access->validaSession("../../");

    $page = 3;
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ICET:: GEDOT :: Minha Senha</title>

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
    <div class="container mt-5 col-md-4">
        <form>
        <div class="card shadow">
            <div class="card-header">
                Alterar Senha
            </div>
            <div class="card-body">
                 <div class="form-row">
                    <div class="form-group col">
                        <label for="atual">Atual:</label>
                        <input type="password" class="form-control" name="atual" id="atual" value="" required="" autocomplete="false">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="nova">Nova:</label>
                        <input type="password" class="form-control" name="nova" id="nova" value="" required="" autocomplete="false">
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

            let form = new FormValidate('form',new Button('form > button[type=submit]'), null);
                form.setAction('../../control/put_senha.php');
        });
    </script>
</body>

</html>