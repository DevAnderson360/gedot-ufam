<?php 
/**
 * Classe de conexão ao banco de dados usando PDO no padrão Singleton.
 * Modo de Usar:
 * include 'Database.class.php';
 * $db = Database::conexao();
 * E agora use as funções do PDO (prepare, query, exec) em cima da variável $db.
 */
class Database{
    # Variável que guarda a conexão.
    protected static $db;
    # Private construct - garante que a classe só possa ser instanciada internamente.
    private function __construct()
    {
        # Informações sobre o banco de dados:
        $db_host = "localhost";
        $db_banco = "tcc";//nome do banco de dados
        $db_usuario = "root";
        $db_senha = "";
        
        try
        {
            self::$db = new mysqli($db_host, $db_usuario, $db_senha, $db_banco);

            if (mysqli_connect_errno())
            	throw new Exception(mysqli_connect_error(), 1);
            	
        }
        catch (Exception $e)
        {
            echo "Erro de conexão com banco de dados: ".$e->getMessage();
        }
    }
    # Método estático - acessível sem instanciação.
    public static function conexao()
    {
        # Garante uma única instância. Se não existe uma conexão, criamos uma nova.
        if (!self::$db)
        {
            new Database();
        }
        # Retorna a conexão.
        return self::$db;
    }
}