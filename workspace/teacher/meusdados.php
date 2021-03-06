<?php
    require_once "../../vendor/autoload.php";

    #valida a sessao
    $access = new \App\Utility\Access();
    $access->validaSession("../../");

    $titulos = function()
    {
       $conn = \App\Bd\Database::conexao();

       $sql = "SELECT * FROM titulo";

       $query = $conn->prepare($sql);

       $query->execute();

       return $query->fetchAll(\PDO::FETCH_OBJ);
    };

    $dados = function()
    {
       $conn = \App\Bd\Database::conexao();

       $sql = "SELECT * FROM `administrador`";

       $query = $conn->prepare($sql);

       $query->execute();

       return $query->fetch(\PDO::FETCH_OBJ);
    };


    $admin = $dados(); 

 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ICET:: GEDOT :: Meus dados</title>

     <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">

    <link rel="stylesheet" href="../../icons/mdi/css/materialdesignicons.css">
</head>
<body>
    <nav class="navbar navbar-expand-xl navbar-light bg-light shadow">
        <a class="navbar-brand" href="#"><img class="img-fluid" src="../../img/sis1.png" alt="" width="50" height="50">GEDOT</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#container-menu" aria-controls="container-menu" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="container-menu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="meusdados.php">Meus dados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="senha.php">Mudar Senha</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logoff.php">Sair</a>
                </li>
            </ul>  
            <div style="text-align: right;">
                <a class="nav-link" style="pointer-events: none; cursor: default; opacity: 0.6; color: black; font-weight: bold;"  href="<?=$_SERVER['REQUEST_URI']?>" style="color: white;">Prof. <?=$_SESSION['user_shot_name']?>&nbsp;&nbsp;<img src="../../img/do-utilizador.png" alt="avatar image" style="width: 30px; height: 30px;"></a>
            </div>           
        </div>
    </nav>
    <div class="container mt-5 col-md-10">
        <form>
        <div class="card shadow">
            <div class="card-header">
                Alterar Senha
            </div>
            <div class="card-body">
                 <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="titulo">Título</label>
                        <select name="titulo" id="titulo" class="form-control">
                        <?php foreach ($titulos() as $value): ?>
                            <option value="<?=$value->abv?>" <?php if($value->abv == $admin->titulo) echo "selected"; ?> ><?="{$value->abv} - {$value->descricao}"?></option>
                        <?php endforeach; ?>   
                        </select>
                    </div>
                    <div class="form-group col-md">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="<?=$admin->nome?>" required="" autocomplete="false"></div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="matricula">Matricula: <span class="small">Mesma que é usada no login</span></label>
                        <input type="text" class="form-control" id="matricula" name="matricula" required="" value="<?=$admin->matricula?>" autocomplet="false"></div>
                    <div class="form-group col-md">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" id="email" name="email" required="" value="<?=$admin->email?>" autocomplete="false"></div>
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
                form.setAction('../../control/put_admin.php');
        });
    </script>
</body>

</html>