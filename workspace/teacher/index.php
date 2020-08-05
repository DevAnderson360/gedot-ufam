<?php
    require_once "../../vendor/autoload.php";

    #valida a sessao
    $access = new \App\Utility\Access();
    $access->validaSession("../../index.html");


    //pegar dados
    $crud =  \App\Bd\Crud::getInstance(\App\Bd\Database::conexao());

    $sql = "SELECT * FROM `curso`";

    $cursos = $crud->select($sql);



    //default
    $page = 1;

    $curso_default = 1;

    $ano_default = date("Y") ;
    
    $semestre_default = date('n') < 7  ? 1 : 2;
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ICET:: Gedot :: HOME</title>

     <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../../css/siderbar.css">

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../../js/jquery.min.js"></script>

    <style>
        .selectable:hover{
            top:-4px;
            transition: all .3s ease-in-out;
            background-color: #28a745;
            box-shadow:0 4px 3px #999;
            cursor:pointer;
        }
    </style>

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
                    <a class="nav-link active" href="homeProfessor.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="senha.php">Mudar Senha</a>
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
    <div class="container-fluid mt-5">
        <div>
        <h4>Discentes</h4>
        <hr>
            <form id="formFiltro">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="ano">Ano</label>
                        <input type="text" class="form-control" name="ano" id="ano" value="<?=$ano_default?>" maxlength="4" required="">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="semestre">Semestre</label>
                        <select name="semestre" id="semestre" class="form-control" required="">
                            <option value="1" <?php if($semestre_default === 1) echo "selected" ?> >1º</option>
                            <option value="2" <?php if($semestre_default === 2) echo "selected" ?> >2º</option>
                        </select>
                    </div>
                    <div class="form-group col-md">
                         <label for="curso">Curso</label>
                        <select name="curso" id="curso" class="form-control" required="">
                            <?php 

                                if(!empty($cursos))
                                    foreach ($cursos as $value):
                             ?>
                            <option value="<?=$value->id?>" <?php if($curso_default === $value->id) echo "selected" ?> ><?=$value->descricao?>.</option>
                            <?php   endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">&nbsp</label>
                        <button class="form-control btn btn-success" type="submit">Filtrar</button>
                    </div>    
                </div>
            </form>
            <div class="table-responsive mt-5">
                <label>Filtro :: <em id="label_filtro">Sistemas de informação > 2020 > 1</em></label>
                <table class="table table-border-less">
                    <thead>
                        <tr>
                            <th style="width: 10%">Matrícula</th>
                            <th style="width: 40%">Nome</th>
                            <th>Curso</th>
                        </tr>
                    </thead>
                    <tbody/>
                </table>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="../../js/bootstrap.min.js"></script>
    <!-- jQuery Custom Scroller -->
    <script src="../../js/funcoes.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            let discentes = [];

            let tbody = $("table > tbody");


            let renderDiscents = () =>{

                let renderItem = ({nome, curso, matricula},index) => `<tr class="selectable" key="${index}"><td>${matricula}</td><td>${nome}</td><td>${curso}</td></tr>`;

                tbody.html("");

                if(discentes !== null){
                    discentes.map((discent, index) => {
                        tbody.append(renderItem(discent,index))
                    });
                }
                else
                    tbody.append(`<tr><td colspan="3">Discentes não encontrados.</td></tr>`)

            };

            let change = () =>{
                let ano = $('#ano').val();
                let curso = $('#curso').val();
                let semestre = $('#semestre').val();

                let DATA = {ano, curso, semestre};


                $("#label_filtro").text(`${$('#curso :selected').text()}>${ano}>${semestre}`);

                getData('../../control/get_group.php',({data})=>{
                    discentes = data;
                    renderDiscents();
                },DATA);//end
            }

            let changeDiscent = (element) => window.open(`detail.php?id=${discentes[element.attr('key')].id}`, '_blank')

            $("#formFiltro").submit((e) => {
                e.preventDefault();
                change();
            });

            tbody.on("click",".selectable",function(){
                changeDiscent($(this))
            })

            change();
        
        });
    </script>
</body>

</html>