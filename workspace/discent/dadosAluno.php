<?php
    include "control/get_dados_pessoais.php";
    $page = 2;
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ICET:: Gerenciador de TCC :: Dados</title>

     <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/siderbar.css">
    <!-- Font Awesome JS -->
    <script defer src="js/solid.js"></script>
    <script defer src="js/fontawesome.js"></script>
</head>
<body>

            <nav class="mb-1 navbar navbar-expand-lg  navbar-dark" style="background-color: #008B00;">
          <a class="navbar-brand justify-content-center" href="#"> <img class="img-fluid" src="img/sis.png" alt="" width="50" height="50">Sistema TCC </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
                  aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="homeAluno.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="dadosAluno.php">Dados Pessoais</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="senha.php">Mudar Senha</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logoff.php">Sair</a>
              </li>
            </ul> 
            <div style="text-align: right;">
                <a class="nav-link" href="#" style="color: white;"><?=$_SESSION['nome']?>&nbsp;&nbsp;<img src="./img/do-utilizador.png" class="rounded-circle z-depth-0"
               alt="avatar image" style="width: 30px; height: 30px;"></a>
               
          </div>           
          </div>
        </nav>

            <h2>Meus dados</h2>
            <div class="card shadow">
                <div class="card-header">
                    Nome, contato e senha
                </div>
                <div class="card-body">
                    <form action="" id="formCad">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="cadNome">Nome:</label>
                                <input type="text" class="form-control" name="nome" id="cadNome" value="<?=$dados['nome']?>" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="cadEmail">Email:</label>
                                <input type="email" class="form-control" name="email" id="cadEmail" value="<?=$dados['email']?>" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="cadTelefone">Telefone:</label>
                                <input type="text" class="form-control" name="telefone" id="cadTelefone" value="<?=$dados['telefone']?>" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="cadMatricula">Matricula:</label>
                                <input type="text" class="form-control" name="matricula" id="cadMatricula" value="<?=$dados['matricula']?>" required="">
                            </div>
                        </div>
                        <span>Semestre Atual</span>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="cadSemestreAno">Ano:</label>
                                <input type="text" class="form-control" name="ano" id="cadSemestreAno" value="<?=$dados['ano']?>" maxlength="4" required="">
                            </div>
                            <div class="form-group mx-auto col-1">
                                <label for="">&nbsp</label>
                                <input type="text" class="form-control-plaintext text-center" value="/" disabled="">
                            </div>
                            <div class="form-group col">
                                <label for="cadSemestre">Semestre:</label>
                                <select name="semestre" id="cadSemestre" class="form-control" required="">
                                    <option value="">Selecione...</option>
                                    <option value="1" <?php if($dados['semestre'] == 1) echo 'selected'; ?>>1</option>
                                    <option value="2" <?php if($dados['semestre'] == 2) echo 'selected'; ?>>2</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success">Salvar</button>
                </div>
            </form>
 

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="js/jquery.min.js"></script>
    <!-- Popper.JS -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- jQuery Custom Scroller -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Extrax -->
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/funcoes.js"></script>

    <script type="text/javascript">
        $(document).ready(function ($) {

            $("#cadTelefone").mask("(##) 00000-0000")
            $("#cadSemestreAno").mask("0000")
            $("#cadMatricula").mask("00000000")

            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });


            $("#formCad").submit(function(e){
                e.preventDefault();
                   $.post('control/editar_dados_pessoais.php',$(this).serialize())
                        .done(function(data,status){
                            if(status)
                                tratamento(data,2);
                            else{
                                alert('Erro ao salvar alterações \nNão foi possivel conectar!');
                                console.log(data);
                            }
                        }).fail(function(xrh){
                            alert('Servidor indisponivel no momento! \nVerifique sua conexão!')
                        });
            });

        });
    </script>
</body>

</html>