<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Sistema de TCC UFAM </h3>
    </div>

    <ul class="list-unstyled components p-2">
        <p><?=$_SESSION['nome']?></p>
        <li class="<?php if($page === 1) echo 'active' ?>">
            <a href="homeProfessor.php">Home</a>
        </li>                
        <li class="<?php if($page === 2) echo 'active' ?>">
            <a href="dadosProfessor.php">Meus Dados</a>
        </li>
        <li class="<?php if($page === 3) echo 'active' ?>">
            <a href="senha.php">Mudar senha</a>
        </li>
    </ul>

    <ul class="list-unstyled p-2">
        <li>
            <a href="logoff.php" class="btn btn-danger text-center">Sair</a>
        </li>
    </ul>
</nav>