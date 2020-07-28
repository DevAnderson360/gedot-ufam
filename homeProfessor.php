<?php
    include "control/get_dados_tcc.php";
    $page = 1;

    $semestre = date('m') > 06 ? 1:2; 
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ICET:: Gerenciador de TCC :: HOME</title>

     <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/siderbar.css">

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="js/jquery.min.js"></script>

    <script src="js/jquery.mask.min.js"></script>

    <!-- Font Awesome JS -->
    <script defer src="js/solid.js"></script>
    <script defer src="js/fontawesome.js"></script>

</head>

<body>

        <nav class="mb-1 navbar navbar-expand-lg  navbar-dark" style="background-color: #008B00;">
          <a class="navbar-brand justify-content-center" href="#">Sistema TCC</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
                  aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link active" href="homeProfessor.php">Home</a>
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


            <div style="padding-left: 15px;">
            <h2>Discentes por Período</h2>
            <hr>
            <span>Semestre Atual</span>
                <form action="" id="formFiltro">
                    <div class="form-row">
                        <div class="form-group col-3">
                            <label for="cadSemestreAno">Ano:</label>
                            <input type="text" class="form-control" name="ano" id="cadSemestreAno" placeholder="2020" value="2020" maxlength="4" required="">
                        </div>
                        <div class="form-group col-1">
                            <label for="">&nbsp</label>
                            <input type="text" class="form-control-plaintext text-center" value="/" disabled="">
                        </div>
                        <div class="form-group col-3">
                            <label for="cadSemestre">Semestre:</label>
                            <select name="semestre" id="cadSemestre" class="form-control" required="">
                                <option value="">Selecione...</option>
                                <option value="1" <?php if($semestre == 1) echo "selected"; ?>>1</option>
                                <option value="2" <?php if($semestre == 2) echo "selected"; ?>>2</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="">&nbsp</label>
                            <button class="form-control btn btn-success">Filtrar</button>
                        </div>    
                    </div>
                </form>
        </div>

    
    <!-- Popper.JS -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- jQuery Custom Scroller -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Extrax -->
    <script src="js/funcoes.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
            
            $("#formTcc").submit(function(e){
                e.preventDefault();
                submitForm($(this).attr('value'),$(this).serialize())
            });

            $("#formOrientador").submit(function(e){
                e.preventDefault();
                submitForm($(this).attr('value'),$(this).serialize())
            });

            $("#formBanca").submit(function(e){
                e.preventDefault();
                submitForm($(this).attr('value'),$(this).serialize())
            });

            <?php 
                if($tcc_id == 0){ 
            ?>
            $("#formOrientador").find(':input').each(function(i,element){
                $(element).prop('disabled',true);
            })

            $("#formBanca").find(':input').each(function(i,element){
                $(element).prop('disabled',true);
            })
            <?php } ?>
        });
    </script>
</body>

</html>