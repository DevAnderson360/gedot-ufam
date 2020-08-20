<?php 
    
    require_once "vendor/autoload.php";

    //pegar dados
    $crud =  \App\Bd\Crud::getInstance(\App\Bd\Database::conexao());

    $sql = "SELECT * FROM `curso`";

    $cursos = $crud->select($sql);
    
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ICET:: Gerenciador de TCC</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- material design icons -->
    <link rel="stylesheet" href="icons/mdi/css/materialdesignicons.css">

    <script src="js/funcoes.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-xl navbar-light bg-light shadow">
        <a class="navbar-brand" href="#"><img class="img-fluid" src="img/sis1.png" alt="" width="50" height="50">GEDOT</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#container-menu" aria-controls="container-menu" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="container-menu">
            <ul class="navbar-nav mr-auto">
                <!--li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(página atual)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Ação</a>
                        <a class="dropdown-item" href="#">Outra ação</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Algo mais aqui</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Desativado</a>
                </li-->
            </ul>
            <form class="form-inline my-1 my-lg-0" id="formProfessor" method="POST" action="control/admin_login.php">
                <input class="form-control mr-sm-1" type="text" placeholder="Professor" name='registration' required="" />
                <input class="form-control mr-sm-1" type="password" placeholder="*****" name="password" required="" />
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Entrar</button>
            </form>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-5 border shadow p-3 mt-2 mb-2">
                <h5>Acessar meus dados</h5>
                <form action="control/discent_login.php" method="POST" id="formLogin" class="mt-2">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="loginMatricula">Matricula:</label>
                            <input type="text" class="form-control" name="registration" id="loginMatricula" placeholder="Matrícula da UFAM" required="" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="loginSenha">Senha:</label>
                            <input type="password" class="form-control" name="password" id="loginSenha" placeholder="******" required="" />
                        </div>
                    </div>
                    <!--span class="small">
                        <a href="#" class="badge">Esqueci minha senha</a>
                    </span-->
                    <div class="form-row">
                        <button class="btn btn-success col m-3" type="submit" style="display: flex; align-content: center; justify-content: center;">Entrar</button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 ml-auto shadow border p-3 mt-2 mb-2">
                <h5>Primeiro Acesso</h5>
                <small>Todos os campos são obrigatorios</small>
                <form action="control/post_discent.php" id="formCad">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="cadNome">Nome:</label>
                            <input type="text" class="form-control" name="nome" id="cadNome" placeholder="Seu nome completo com Iniciais Maiusculas" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="cadEmail">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="endereco@host.com" id="cadEmail" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="cadTelefone">Telefone:</label>
                            <input type="text" class="form-control" name="telefone" id="cadTelefone" placeholder="(92) 99999-9999" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="cadCurso">Curso:</label>
                            <select name="curso" id="cadCurso" required="" class="form-control">
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
                            <label for="cadMatricula">Matrícula:</label>
                            <input type="text" class="form-control" name="matricula" id="cadMatricula" maxlength="8" placeholder="Matrícula da UFAM" required="">
                        </div>
                    </div>
                    <span>Semestre Atual</span>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="cadSemestreAno">Ano:</label>
                            <input type="text" class="form-control" name="ano" id="cadSemestreAno" placeholder="2020" maxlength="4" autocomplete="false" required="">
                        </div>
                        <div class="form-group mx-auto col-1">
                            <label for="">&nbsp</label>
                            <input type="text" class="form-control-plaintext text-center" value="/" disabled="">
                        </div>
                        <div class="form-group col">
                            <label for="cadSemestre">Semestre:</label>
                            <select name="semestre" id="cadSemestre" class="form-control" required="">
                                <option value="">Selecione...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="cadSenha">Senha:</label>
                            <input type="password" class="form-control" placeholder="******" name="senha" id="cadSenha" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-success col m-3" type="submit">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Extras -->
    <!--script src="js/jquery.mask.min.js"></script-->
   

    <script type="text/javascript">
        $(document).ready(()=>{
           
            new FormValidate('#formProfessor', new Button('#formProfessor :button[type=submit]'), null);

            new FormValidate('#formLogin', new Button('#formLogin :button[type=submit]'), null);

            new FormValidate('#formCad',  new Button('#formCad :button[type=submit]'), null);
        });
    </script>
</body>

</html>
