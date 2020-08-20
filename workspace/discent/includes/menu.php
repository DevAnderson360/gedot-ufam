<nav class="navbar navbar-expand-xl navbar-light bg-light shadow">
    <a class="navbar-brand" href="#"><img class="img-fluid" src="../../img/sis1.png" alt="" width="50" height="50">GEDOT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#container-menu" aria-controls="container-menu" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="container-menu">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link <?php if($page === 1) echo "active" ?>" href="./">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($page === 2) echo "active" ?>" href="meusdados.php">Dados Pessoais</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($page === 3) echo "active" ?>" href="senha.php">Mudar Senha</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logoff.php">Sair</a>
            </li>
        </ul> 
        <div style="text-align: right;">
            <a class="nav-link" style="pointer-events: none; cursor: default; opacity: 0.6; color: black; font-weight: bold;"  href="<?=$_SERVER['REQUEST_URI']?>" style="color: white;"><?=$_SESSION['user_shot_name']?>&nbsp;&nbsp;<img src="../../img/p2.png" alt="avatar image" style="width: 30px; height: 30px;"></a>
        </div>           
    </div>
</nav>