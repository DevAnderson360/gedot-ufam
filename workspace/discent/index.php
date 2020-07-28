<?php 
    require_once "../../vendor/autoload.php";

    #valida a sessao
    $access = new \App\Utility\Access();
    $access->validaSession("../../index.html");

    //controle de pagina
    $page = 1;

    $tcc_id = 0;
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ICET:: Gerenciador de TCC :: HOME</title>

     <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../../css/siderbar.css">

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="js/jquery.min.js"></script>

    <script src="js/jquery.mask.min.js"></script>

    <!-- Font Awesome JS -->
    <script defer src="js/solid.js"></script>
    <script defer src="js/fontawesome.js"></script>

</head>

<body>

    


        <nav class="mb-1 navbar navbar-expand-lg  navbar-dark" style="background-color: #008B00;">
          <a class="navbar-brand justify-content-center" href="../../#">Sistema TCC</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
                  aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link active" href="../../homeAluno.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../../dadosAluno.php">Dados Pessoais</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../../senha.php">Mudar Senha</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../../logoff.php">Sair</a>
              </li>
            </ul> 
            <div style="text-align: right;">
                <a class="nav-link" href="../../#" style="color: white;"><?=$_SESSION['user_shot_name']?>&nbsp;&nbsp;<img src="../../img/do-utilizador.png" class="rounded-circle z-depth-0"
               alt="avatar image" style="width: 30px; height: 30px;"></a>
               
          </div>           
          </div>
        </nav>

            <h4 style="text-align: center;">Meus dados do TCC</h4>

            <form action="#" id="formTcc" value="salvarTcc.php">
                <input type="hidden" name="id" value="<?=$tcc_id?>">
                <div class="card shadow">
                    <div class="card-header" style="text-align: center;">Dados do TCC</div>
                    <div class="card-body">
                        
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="tituloTcc">Título do tcc</label>
                                <input type="text" class="form-control" name="tituloTcc" id="tituloTcc" value="<?=getValue($dadosTcc,'titulo')?>" required="" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="data">Data de Defesa</label>
                                <input type="date" class="form-control" name="data" id="data" value="<?=getValue($dadosTcc,'data_avaliacao')?>" required="">
                            </div>
                        </div>
                    </div><!--card-body-->
                    <div class="card-footer">
                        <button class="btn btn-success" type="submit">Salvar</button>
                    </div>
                </div>
            </form>

<!--dados orientador-->
            <form action="#" id="formOrientador" value="salvarTcc_orientador.php">
                <input type="hidden" name="id" value="<?=$tcc_id?>">
                <input type="hidden" name="orientador[]" value="<?=$orientador_id?>">
                <!-- <input type="hidden" name="orientador[]" value="<?=$corientador_id?>"> -->
                <div class="card shadow mt-2">
                    <div class="card-header" style="text-align: center;">Dados do Orientador</div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="orientadorTitulo">Título do Orientador</label>
                                <select name="titulo[]" id="orientadorTitulo" class="form-control">
                                    <option value="">-</option>
                                <?php 
                                   foreach($titulos as $t): 
                                 ?>
                                    <option value="<?=$t['id']?>" <?php if($orientador_titulo == $t['id']) echo 'selected'; ?>>
                                        <?=$t['abv'].' - '.$t['descricao']?>
                                    </option>
                                    
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="orientador">Nome completo do(a) Orientador(a)</label>
                                <input type="text" class="form-control" name="nome[]" id="orientador" value="<?= $orientador_nome?>" required="" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="orientadorInstituicao">Instituição que trabalha</label>
                                <input type="text" class="form-control" id="orientadorInstituicao" name="instituicao[]" value="<?=$orientador_instituicao?>" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="orientadorTelefone">Telefone</label>
                                <input type="text" class="form-control" name="telefone[]" data-mask="(00) 00000-0000" data-mask-selectonfocus="true" id="orientadorTelefone" value="<?=$orientador_telefone?>" required="" />
                            </div>
                          
                        </div> <!--mudar a variavel que vai ser´passada-->

                        
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="orientadorEmail">E-mail</label>
                                <input type="email" class="form-control" name="email[]" id="orientadorEmail" value="<?=$orientador_email?>"  required="" />
                            </div>
                        </div>

                    </div>
                    <div class="card-footer"><button class="btn btn-success">Salvar</button></div>
                </div>
            </form>


<!--form coorientador-->

			<form action="#" id="formOrientador" value="salvarTcc_orientador.php">
                <input type="hidden" name="id" value="<?=$tcc_id?>">
                <!-- <input type="hidden" name="orientador[]" value="<?=$orientador_id?>"> -->
                <input type="hidden" name="orientador[]" value="<?=$corientador_id?>">
                <div class="card shadow mt-2">
                    <div class="card-header" style="text-align: center;">Dados do Coorientador</div>
                    <div class="card-body">                     
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="corientadorTitulo">Título do Corientador</label>
                                <select name="titulo[]" id="corientadorTitulo" class="form-control">
                                    <option value="">Selecione...</option>
                                <?php 
                                   foreach($titulos as $t): 
                                 ?>
                                    <option value="<?=$t['id']?>" <?php if($corientador_titulo == $t['id']) echo 'selected'; ?>>
                                        <?=$t['abv'].' - '.$t['descricao']?>
                                            
                                    </option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="corientador">Nome completo do(a) Corientador(a)</label>
                                <input type="text" class="form-control" name="nome[]" id="corientador" value="<?=$corientador_nome?>" required="" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="corientadorInstituicao">Instituição que trabalha</label>
                                <input type="text" class="form-control" id="corientadorInstituicao" value="<?=$corientador_instituicao?>" name="instituicao[]" required />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="corientadorTelefone">Telefone 1</label>
                                <input type="text" class="form-control" name="telefone[]" id="orientadorTelefone" value="<?=$corientador_telefone?>" required="" />
                            </div>                            
                        </div>

                         <div class="form-row">
                            <div class="form-group col">
                                <label for="corientadorEmail">E-mail</label>
                                <input type="email" class="form-control" name="email[]" value="<?=$corientador_email?>" id="corientadorEmail" required="" />
                            </div>
                        </div>

                    </div>
                    <div class="card-footer"><button class="btn btn-success">Salvar</button></div>
                </div>
            </form>


<!--form banca-->
             <form action="#" id='formBanca' value="salvarTcc_banca.php">
                <input type="hidden" name="id" value="<?=$tcc_id?>">
                <input type="hidden" name="avaliador[]" value="<?=$avaliador_id?>">
                <input type="hidden" name="avaliador[]" value="<?=$cavaliador_id?>">
                <div class="card shadow mt-2">
                    <div class="card-header" style="text-align: center;">Dados da Banca Examinadora</div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="avaliadorTitulo">Título do(a) Avaliador(a)</label>
                                <select name="titulo[]" id="avaliadorTitulo" class="form-control" required="">
                                    <option value="">Selecione...</option>
                                <?php 
                                   foreach($titulos as $t): 
                                 ?>
                                    <option value="<?=$t['id']?>" <?php if($avaliador_titulo === $t['id']) echo 'selected'; ?>>
                                        <?=$t['abv'].' - '.$t['descricao']?></option>
                                    
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="avaliador">Nome completo do(a) Avaliador(a)</label>
                                <input type="text" class="form-control" name="nome[]" id="avaliador" value="<?=$avaliador_nome?>" required="" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="avaliadorInstituicao">Instituição que trabalha</label>
                                <input type="text" class="form-control" id="avaliadorInstituicao" value="<?=$avaliador_instituicao?>" name="instituicao[]" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="avaliadorTelefone">Telefone</label>
                                <input type="text" class="form-control" name="telefone[]" id="avaliadorTelefone" value="<?=$avaliador_telefone?>" required="" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="avaliadorEmail">E-mail</label>
                                <input type="email" class="form-control" name="email[]" id="avaliadorEmail" value="<?=$avaliador_email?>" required="" />
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="avaliadorTitulo2">
                                    Título do(a) Avaliador(a) 2
                                </label>

                                <select name="titulo[]" id="avaliadorTitulo" class="form-control">
                                    <option value="">Selecione...</option>
                                <?php 
                                   foreach($titulos as $t): 
                                 ?>
                                    <option value="<?=$t['id']?>" <?php if($cavaliador_titulo === $t['id']) echo 'selected'; ?>>
                                        <?=$t['abv'].' - '.$t['descricao']?></option>
                                    
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="avaliador">Nome completo do(a) Avaliador(a)</label>
                                <input type="text" class="form-control" name="nome[]" id="avaliador" value="<?=$cavaliador_nome?>" required="" />
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="avaliadorInstituicao2">Instituição ou empresa que trabalha</label>
                                <input type="text" class="form-control" id="avaliadorInstituicao2" name="instituicao[]" value="<?=$cavaliador_instituicao?>" required />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="avaliadorCargo2">Cargo:</label>
                                <input type="text" class="form-control" id="avaliadorCargo2" name="cargo" value="<?=$cavaliador_cargo?>" placeholder="por em tooltips" required />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="avaliadorOrigem2">Cidade de Origem</label>
                                <input type="text" class="form-control" id="avaliadorOrigem2" name="cidade" value="<?=$cavaliador_cidade?>" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="avaliadorTelefone2">Telefone</label>
                                <input type="text" class="form-control" id="avaliadorTelefone2" name="telefone[]" value="<?=$cavaliador_telefone?>" required="" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="avaliadorEmail2">E-mail</label>
                                <input type="email" class="form-control" id="avaliadorEmail2" name="email[]" value="<?=$cavaliador_email?>" required="" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" type="submit">Salvar</button>
                    </div>
                </div>
                <!--card2-->
            </form>
        </div>
    </div>
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