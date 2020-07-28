<style type="text/css">
.background-escondido {
    position: absolute;
    top: 0;
    right: 0;
    background-color: rgba(0,0,0, 0.3);
    opacity: 0.5;
    width: 100%;
    height: 100%;
    display: none;
    cursor: pointer;
    z-index: 1;
}

.mostra {
    display: initial;
}

.menu-lateral {
    position: absolute;
    width: 350px;
    margin-left: -350px;
    top: 0;
    left: 0;
    z-index: 3;
    height: 100%;
    color: #fff;
    background-color: #fff;
    transition: all ease 0.3s;
} 

.open {
    margin-left: 0;
    transition: all ease 0.3s;
}

.cima {
    background-color: #35aa69;
    padding: 20px;
    position: relative;
}

.fecha {
    font-size: 25px;
    position: absolute;
    right: 0;
    top: 5%;
    cursor: pointer;
    width: 10%;
}

.linha {
    display: flex; 
    align-items: center;
    margin-bottom: 10%;
}

.cima > img {
    display: block;
    width: 20%;
}

.cima h3 {
    font-size: 32px;
    font-weight: 500;
    display: block;
    margin-left: 5%;
}

.cima p {
    font-size: 18px;
}

.baixo, .btn-sair {
    color: #000;
    list-style: none;
}

.baixo li a, .btn-sair li a {
    padding: 15px 20px ; 
    color: #000;
    text-decoration: none;
    font-size: 17.6px;
    display: block;
    outline: none;
}

.btn-sair {
    text-align: center;
}

.btn-sair li a {
    background-color: #2f8b5a;
    margin: 1% 5%;
    padding: 10px;
    color: #fff;
}

.active {
    background-color: rgba(0,0,0, 0.1);
}

</style>

<span class="background-escondido" id="background"></span>
<nav id="menu-lateral" class="menu-lateral">
    <div class="cima">
        <span class="fecha" id="fecha"><img src="../../imagens/close.png"></span>
        <div class="linha">
            <img src="../../imagens/logo_icet_2.png">
            <h3>Meus Dados</h3>            
        </div>
        <p><?=$_SESSION['user_name']?></p>
    </div>

    <ul class="baixo">
        <li class="<?php if($page === 1) echo 'active' ?>">
            <a href="homeAluno.php">Home</a>
        </li>                
        <li class="<?php if($page === 2) echo 'active' ?>">
            <a href="dadosAluno.php">Dados pessoais</a>
        </li>
        <li class="<?php if($page === 3) echo 'active' ?>">
            <a href="senha.php">Mudar senha</a>
        </li>
    </ul>

    <ul class="btn-sair">
        <li>
            <a href="logoff.php" class="">Sair</a>
        </li>
    </ul>
</nav>