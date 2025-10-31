<?php
class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $host = 'localhost';       // ajuste
        $db   = 'todo_app';        // nome do banco (do script)
        $user = 'root';            // ajuste
        $pass = '';               // ajuste
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->connection = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            // Em produção não exiba a mensagem completa
            die('Erro de conexão: ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
