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
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" sizes="16x16" href="../../imagens/favicon-16x16.png">

    <title>GEDOT :: Workspace Discente</title>

     <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../../css/siderbar.css">

    <link rel="stylesheet" href="../../icons/mdi/css/materialdesignicons.css">

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../../js/jquery.min.js"></script>

    <script src="../../js/jquery.mask.min.js"></script>

    <!-- Font Awesome JS -->
    <script defer src="../../js/solid.js"></script>
    <script defer src="../../js/fontawesome.js"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include "includes/menul.php" ?>

        <!-- Page Content  -->
        <div id="content">

            <?php include "includes/menuV.php" ?>

            <h2>Meus dados do TCC</h2>
            <form id="formTcc" action="../../control/post_tcc.php" method="POST">
                <input type="hidden" name="id" value="<?=$tcc_id?>">
                <div class="card shadow">
                    <div class="card-header">Dados do TCC</div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="tituloTcc">Título do tcc</label>
                                <input type="text" class="form-control" name="titulo" id="tituloTcc" value="" required="" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="data">Data de Defesa</label>
                                <input type="date" class="form-control" name="data_avaliacao" id="data" value="" required="">
                            </div>
                        </div>
                    </div><!--card-body-->
                    <div class="card-footer">
                        <button class="btn btn-success" type='submit'>Salvar</button>
                        <button class="btn btn-warning" type="reset">Limpar</button>
                    </div>
                </div>
            </form>
            <form action="#" id="formOrientador" value="salvarTcc_orientador.php">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="orientador[]" value="">
                <input type="hidden" name="orientador[]" value="">
                <div class="card shadow mt-2">
                    <div class="card-header">Dados do Orientador e Coorientador</div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="orientadorTitulo">Título do Orientador</label>
                                <select name="titulo[]" id="orientadorTitulo" class="form-control">
                                    <option value="">Selecione...</option>
                                
                                </select>
                            </div>
                            <div class="form-group col-8">
                                <label for="orientador">Nome completo do(a) Orientador(a)</label>
                                <input type="text" class="form-control" name="nome[]" id="orientador" value=">" required="" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="orientadorInstituicao">Instituição que trabalha</label>
                                <input type="text" class="form-control" id="orientadorInstituicao" name="instituicao[]" value="" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="orientadorTelefone">Telefone</label>
                                <input type="text" class="form-control" name="telefone[]" data-mask="(00) 00000-0000" data-mask-selectonfocus="true" id="orientadorTelefone" value="" required="" />
                            </div>
                            <div class="form-group col">
                                <label for="orientadorEmail">E-mail</label>
                                <input type="email" class="form-control" name="email[]" id="orientadorEmail" value=""  required="" />
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="corientadorTitulo">Título do Corientador</label>
                                <select name="titulo[]" id="corientadorTitulo" class="form-control">
                                    <option value="">Selecione...</option>
                                
                                </select>
                            </div>
                            <div class="form-group col-8">
                                <label for="corientador">Nome completo do(a) Corientador(a)</label>
                                <input type="text" class="form-control" name="nome[]" id="corientador" value="" required="" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="corientadorInstituicao">Instituição que trabalha</label>
                                <input type="text" class="form-control" id="corientadorInstituicao" value="" name="instituicao[]" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="corientadorTelefone">Telefone</label>
                                <input type="text" class="form-control" name="telefone[]" id="orientadorTelefone" value="" required="" />
                            </div>
                            <div class="form-group col">
                                <label for="corientadorEmail">E-mail</label>
                                <input type="email" class="form-control" name="email[]" value="" id="corientadorEmail" required="" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"><button class="btn btn-success">Salvar</button></div>
                </div>
            </form>
            <form action="#" id='formBanca' value="salvarTcc_banca.php">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="avaliador[]" value="">
                <input type="hidden" name="avaliador[]" value="">
                <div class="card shadow mt-2">
                    <div class="card-header">Dados da Banca Examinadora</div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="avaliadorTitulo">Título do(a) Avaliador(a)</label>
                                <select name="titulo[]" id="avaliadorTitulo" class="form-control" required="">
                                    <option value="">Selecione...</option>
                                
                                </select>
                            </div>
                            <div class="form-group col-8">
                                <label for="avaliador">Nome completo do(a) Avaliador(a)</label>
                                <input type="text" class="form-control" name="nome[]" id="avaliador" value="" required="" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="avaliadorInstituicao">Instituição que trabalha</label>
                                <input type="text" class="form-control" id="avaliadorInstituicao" value="" name="instituicao[]" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="avaliadorTelefone">Telefone</label>
                                <input type="text" class="form-control" name="telefone[]" id="avaliadorTelefone" value="" required="" />
                            </div>
                            <div class="form-group col">
                                <label for="avaliadorEmail">E-mail</label>
                                <input type="email" class="form-control" name="email[]" id="avaliadorEmail" value="" required="" />
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="avaliadorTitulo2">
                                    Título do(a) Avaliador(a) 2
                                </label>

                                <select name="titulo[]" id="avaliadorTitulo" class="form-control">
                                    <option value="">Selecione...</option>
                                
                                </select>
                            </div>
                            <div class="form-group col-8">
                                <label for="avaliador">Nome completo do(a) Avaliador(a)</label>
                                <input type="text" class="form-control" name="nome[]" id="avaliador" value="" required="" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-8">
                                <label for="avaliadorInstituicao2">Instituição ou empresa que trabalha</label>
                                <input type="text" class="form-control" id="avaliadorInstituicao2" name="instituicao[]" value="" required />
                            </div>
                            <div class="form-group col">
                                <label for="avaliadorCargo2">Cargo:</label>
                                <input type="text" class="form-control" id="avaliadorCargo2" name="cargo" value="" placeholder="por em tooltips" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="avaliadorOrigem2">Cidade de Origem</label>
                                <input type="text" class="form-control" id="avaliadorOrigem2" name="cidade" value="" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="avaliadorTelefone2">Telefone</label>
                                <input type="text" class="form-control" id="avaliadorTelefone2" name="telefone[]" value="" required="" />
                            </div>
                            <div class="form-group col">
                                <label for="avaliadorEmail2">E-mail</label>
                                <input type="email" class="form-control" id="avaliadorEmail2" name="email[]" value="" required="" />
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

    
    <!-- Popper.JS -->
    <script src="../../js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../../js/bootstrap.min.js"></script>
    <!-- jQuery Custom Scroller -->
    <script src="../../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Extrax -->
    <script src="../../js/funcoes.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {


            //carregar dados para um formulario
            let getDataForm = (URL,method) =>
            {

                $.ajax({
                    url: URL,
                    type: 'GET',
                    //data: DATA,
                    dataType: 'json',
                    //beforeSend: () =>  this.buttonSubmit.setElement() ,
                    //complete: () =>  this.buttonSubmit.setElement(),
                    success: (d) => method(d),
                    error: (r) =>  alert(`Erro ao processar: ${r.status}\nMensagem do servidor: ${r.responseJSON.msg}`) ,
                });

            }

            //---var do form formTcc

            let setFormTcc = (data) =>{

                let form = $("#formTcc");
                
                let inputTituloTcc = $('#tituloTcc');

                let inputDataTcc   = $('#data');

                let buttonSubmit = new Button (form.find("button[type='submit']"))

                let buttonReset  = new Button (form.find("button[type='reset']"))

                let formulario = new FormValidate(form,buttonSubmit, buttonReset);

                if(data.id != null)
                    form.prop('action','../../control/put_tcc.php');

                inputTituloTcc.val(data.titulo);

                inputDataTcc.val(data.data_avaliacao);


            }

            getDataForm("../../control/get_tcc.php", (data)=> setFormTcc(data))

            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('aria-expanded=true]').attr('aria-expanded', 'false');
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

           
            $("#formOrientador").find(':input').each(function(i,element){
                $(element).prop('disabled',true);
            })

            $("#formBanca").find(':input').each(function(i,element){
                $(element).prop('disabled',true);
            })
            
        });

        function closeMenu() {
            document.getElementById('background').classList.remove('mostra');
            document.getElementById('menu-lateral').classList.remove('open');   
        }
        document.getElementById('menu-vertical').onclick = function openMenu() {
            document.getElementById('background').classList.add('mostra');
            document.getElementById('menu-lateral').classList.add('open');
        }
        document.getElementById('background').onclick = () => closeMenu();
        document.getElementById('fecha').onclick = () => closeMenu();
    </script>
</body>

</html>