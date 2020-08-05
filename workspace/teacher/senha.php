<?php
    require_once "../../vendor/autoload.php";

    #valida a sessao
    $access = new \App\Utility\Access();
    $access->validaSession("../../index.html");

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

    <link rel="stylesheet" href="../../icons/mdi/css/materialdesignicons.css">
</head>
<body>
    <nav class="mb-1 navbar navbar-expand-lg  navbar-dark" style="background-color: #008B00;">
        <a class="navbar-brand justify-content-center" href="#">GEDOT</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
        aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="senha.php">Mudar Senha</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logoff.php">Sair</a>
                </li>
            </ul> 
            <div style="text-align: right;">
                <a class="nav-link" href="#" style="color: white;">Professor&nbsp;&nbsp;<img src="../../img/do-utilizador.png" class="rounded-circle z-depth-0"
            alt="avatar image" style="width: 30px; height: 30px;"></a>
            </div>           
        </div>
    </nav>
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

            let form = new FormValidate('form',new Button('form :button[type=submit]'), null);
                form.setAction('../../control/put_senha_admin.php');
        });
    </script>
</body>

</html>