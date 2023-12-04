<?php class Database
{
    private $host = 'localhost';
    private $db_name = 'eindopdracht';
    private $username = 'root';
    private $password = 'emir2006';
    public $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
?>