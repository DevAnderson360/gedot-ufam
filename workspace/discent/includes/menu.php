<nav class="mb-1 navbar navbar-expand-lg  navbar-dark" style="background-color: #008B00;">
    <a class="navbar-brand justify-content-center" href="./">Gedot</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
      aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
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
            <a class="nav-link" href="<?=$_SERVER['REQUEST_URI']?>" style="color: white;"><?=$_SESSION['user_shot_name']?>&nbsp;&nbsp;<img src="../../img/do-utilizador.png" alt="avatar image" style="width: 30px; height: 30px;"></a>
        </div>           
    </div>
</nav>