<?php 
    require_once "../../vendor/autoload.php";

    #valida a sessao
    $access = new \App\Utility\Access();
    $access->validaSession("../../");

    //controle de pagina
    $page = 1;

    $titulos = function()
    {
       $conn = \App\Bd\Database::conexao();

       $sql = "SELECT * FROM titulo";

       $query = $conn->prepare($sql);

       $query->execute();

       return $query->fetchAll(\PDO::FETCH_OBJ);
    };

 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ICET:: Gerenciador de TCC :: HOME</title>

     <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">

    <!-- material design icons -->
    <link rel="stylesheet" href="../../icons/mdi/css/materialdesignicons.css">

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../../js/jquery.min.js"></script>
</head>
<body>
    <?php include "includes/menu.php" ?>
    <div class="container mt-5">
        <form id="form-tcc">
            <input type="hidden" name="id" id="idTcc">
            <div class="card shadow">
                <div class="card-header">TCC</div>
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
                            <input type="date" class="form-control" name="data_avaliacao" id="dataTcc" value="" required="">
                        </div>
                    </div>
                </div><!--card-body-->
                <div class="card-footer">
                    <button class="btn btn-success" type="submit">Salvar</button>
                </div>
            </div>
        </form>
        <!--dados orientador-->
        <form id="formOrientador">
            <input type="hidden" name="id" id="orientador_id">
            <div class="card shadow mt-2">
                <div class="card-header">Dados do Orientador</div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="orientador_titulo">Título do Orientador</label>
                            <select name="titulo" id="orientador_titulo" class="form-control">
                            <?php foreach ($titulos() as $value): ?>
                                <option value="<?=$value->id?>"><?="{$value->abv} - {$value->descricao}"?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="orientador_nome">Nome completo</label>
                            <input type="text" class="form-control" name="nome" id="orientador_nome" value="" required="" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="orientado_instituicao">Instituição que trabalha</label>
                            <input type="text" class="form-control" id="orientador_instituicao" name="instituicao" value="" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="orientador_telefone">Telefone</label>
                            <input type="text" class="form-control" name="telefone" data-mask="(00) 00000-0000" data-mask-selectonfocus="true" id="orientador_telefone" value="" required="" />
                        </div>
                        <div class="form-group col">
                            <label for="orientador_email">E-mail</label>
                            <input type="email" class="form-control" name="email" id="orientador_email" value=""  required="" />
                        </div>
                    </div>
                </div>
                <div class="card-footer"><button class="btn btn-success" type="submit">Salvar</button></div>
            </div>
        </form>
        <!--form coorientador-->
        <form id="formCoorientador">
            <input type="hidden" name="id" id="coorientador_id" value="">
            <div class="card shadow mt-2">
                <div class="card-header">Dados do Coorientador</div>
                <div class="card-body">                     
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="coorientador_titulo">Título</label>
                            <select name="titulo" id="coorientador_titulo" class="form-control">
                                <?php foreach ($titulos() as $value): ?>
                                    <option value="<?=$value->id?>"><?="{$value->abv} - {$value->descricao}"?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="coorientador_nome">Nome completo</label>
                            <input type="text" class="form-control" name="nome" id="coorientador_nome" value="" required="" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="coorientador_instituicao">Instituição que trabalha</label>
                            <input type="text" class="form-control" id="coorientador_instituicao" value="" name="instituicao" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="coorientador_telefone">Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="coorientador_telefone" value="" required="" />
                        </div>
                        <div class="form-group col">
                            <label for="coorientador_email">E-mail</label>
                            <input type="email" class="form-control" name="email" value="" id="coorientador_email" required="" />
                        </div>
                    </div>
                </div>
                <div class="card-footer"><button class="btn btn-success" type="submit">Salvar</button></div>
            </div>
        </form>
        <!--form avaliador1-->
        <form id="formAvaliador">
            <input type="hidden" name="id" id="avaliador_id" value="">
            <div class="card shadow mt-2">
                <div class="card-header">Dados do avaliador 1</div>
                <div class="card-body">                     
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="avaliador_titulo">Título</label>
                            <select name="titulo" id="avaliador_titulo" class="form-control">
                                <?php foreach ($titulos() as $value): ?>
                                    <option value="<?=$value->id?>"><?="{$value->abv} - {$value->descricao}"?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="avaliador_nome">Nome completo</label>
                            <input type="text" class="form-control" name="nome" id="avaliador_nome" value="" required="" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md">
                            <label for="avaliador_instituicao">Instituição que trabalha</label>
                            <input type="text" class="form-control" id="avaliador_instituicao" value="" name="instituicao" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md">
                            <label for="avaliador_telefone">Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="avaliador_telefone" value="" required="" />
                        </div>                            
                        <div class="form-group col-md">
                            <label for="avaliador_email">E-mail</label>
                            <input type="email" class="form-control" name="email" value="" id="avaliador_email" required="" />
                        </div>
                    </div>
                    <div class="form-row">                            
                        <div class="form-group col-md">
                            <label for="avaliador_cidade">Origem</label>
                            <input type="text" class="form-control" name="cidade" value="" id="avaliador_cidade" required="" />
                        </div>
                    </div>
                </div>
                <div class="card-footer"><button class="btn btn-success" type="submit">Salvar</button></div>
            </div>
        </form>
         <!--form avaliador2-->
        <form id="formAvaliador2">
            <input type="hidden" name="id" id="avaliador2_id" value="">
            <div class="card shadow mt-2 mb-3">
                <div class="card-header">Dados do avaliador 2</div>
                <div class="card-body">                     
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="avaliador2_titulo">Título</label>
                            <select name="titulo" id="avaliador2_titulo" class="form-control">
                                <?php foreach ($titulos() as $value): ?>
                                    <option value="<?=$value->id?>"><?="{$value->abv} - {$value->descricao}"?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="avaliador2_nome">Nome completo</label>
                            <input type="text" class="form-control" name="nome" id="avaliador2_nome" value="" required="" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md">
                            <label for="avaliador2_instituicao">Instituição ou empresa que trabalha</label>
                            <input type="text" class="form-control" id="avaliador2_instituicao" value="" name="instituicao" required />
                        </div>
                        <div class="form-group col-md">
                            <label for="avaliador2_cargo">Cargo</label>
                            <input type="text" class="form-control" name="cargo" value="" id="avaliador2_cargo" required="" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md">
                            <label for="avaliador2_telefone">Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="avaliador2_telefone" value="" required="" />
                        </div>                            
                        <div class="form-group col-md">
                            <label for="avaliador2_email">E-mail</label>
                            <input type="email" class="form-control" name="email" value="" id="avaliador2_email" required="" />
                        </div>
                    </div>
                     <div class="form-row">                            
                        <div class="form-group col-md">
                            <label for="avaliador2_cidade">Origem</label>
                            <input type="text" class="form-control" name="cidade" value="" id="avaliador2_cidade" required="" />
                        </div>
                    </div>
                </div>
                <div class="card-footer"><button class="btn btn-success" type="submit">Salvar</button></div>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="../../js/bootstrap.min.js"></script>
    <!-- jQuery Custom Scroller -->
    <script src="../../js/funcoes.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {


           let setFormOrientador = ({id, tcc, nome, titulo, instituicao, telefone, email}) =>{
                $('#orientador_id').val(id)
                $('#orientador_titulo').val(titulo);
                $('#orientador_telefone').val(telefone);
                $('#orientador_email').val(email);
                $('#orientador_nome').val(nome);
                $('#orientador_instituicao').val(instituicao);
           }

           let setFormCoorientador = ({id, tcc, nome, titulo, instituicao, telefone, email}) =>{
                $('#coorientador_id').val(id)
                $('#coorientador_titulo').val(titulo);
                $('#coorientador_telefone').val(telefone);
                $('#coorientador_email').val(email);
                $('#coorientador_nome').val(nome);
                $('#coorientador_instituicao').val(instituicao);
           }

           let setFormAvaliador1 = ({id, tcc, nome, titulo, instituicao, telefone, email, cidade}) =>{
                $('#avaliador_id').val(id)
                $('#avaliador_titulo').val(titulo);
                $('#avaliador_telefone').val(telefone);
                $('#avaliador_email').val(email);
                $('#avaliador_nome').val(nome);
                $('#avaliador_instituicao').val(instituicao);
                $('#avaliador_cidade').val(cidade);
           }

           let setFormAvaliador2 = ({id, tcc, nome, titulo, instituicao, telefone, email, cargo, cidade}) =>{
                $('#avaliador2_id').val(id)
                $('#avaliador2_titulo').val(titulo);
                $('#avaliador2_telefone').val(telefone);
                $('#avaliador2_email').val(email);
                $('#avaliador2_nome').val(nome);
                $('#avaliador2_cargo').val(cargo);
                $('#avaliador2_instituicao').val(instituicao);
                $('#avaliador2_cidade').val(cidade);

           }

           let setFormTcc = ({id, titulo, data_avaliacao}) =>{
                $("#idTcc").val(id)
                $("#tituloTcc").val(titulo)
                $("#dataTcc").val(data_avaliacao)
           }


           let setForms = () =>{
               //seta form tcc
               getData('../../control/get_tcc.php',({tcc,orientador,coorientador,avaliadores}) => {

                    let formTcc = new FormValidate('#form-tcc',new Button('#form-tcc :button[type=submit]'), null);
                        formTcc.setAction('../../control/put_tcc.php');

                    let formOrientador   = new FormValidate('#formOrientador',   new Button('#formOrientador :button[type=submit]'), null);
                        formOrientador.setAction('../../control/put_orientador.php')

                    let formCoorientador = new FormValidate('#formCoorientador', new Button('#formCoorientador :button[type=submit]'), null);
                        formCoorientador.setAction('../../control/put_orientador.php')

                    let formAvaliador    = new FormValidate('#formAvaliador',    new Button('#formAvaliador :button[type=submit]'), null);
                        formAvaliador.setAction('../../control/put_avaliador.php')

                    let formAvaliador2   = new FormValidate('#formAvaliador2',   new Button('#formAvaliador2 :button[type=submit]'), null);
                        formAvaliador2.setAction('../../control/put_avaliador.php')

                    if(tcc.id === null){
                        formTcc.setAction('../../control/post_tcc.php');
                        formOrientador.disabled();
                        formCoorientador.disabled();
                        formAvaliador.disabled();
                        formAvaliador2.disabled();
                    }else{
                        setFormTcc(tcc);

                        if(orientador === null){
                            formOrientador.setAction('../../control/post_orientador.php')
                        }else{
                            setFormOrientador(orientador)
                        }

                        if(coorientador === null){
                            formCoorientador.setAction('../../control/post_coorientador.php')
                        }else{
                            setFormCoorientador(coorientador)
                        }
                        
                       if(avaliadores === null){
                            formAvaliador.setAction('../../control/post_avaliador.php')
                            formAvaliador2.disabled();
                       }else{
                            setFormAvaliador1(avaliadores['0']);

                            if(avaliadores['1'] === undefined)
                                formAvaliador2.setAction('../../control/post_avaliador.php')
                            else
                                setFormAvaliador2(avaliadores['1'])
                       }                        
                    }
               });
           }

            setForms();
            
        });
    </script>
</body>

</html>