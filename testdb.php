<?php

class Database
{
    public $pdo;

    public function __construct($db = "test", $host = "localhost", $user = "root", $password = "emir2006")
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insertUser($email, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([
            'email' => $email,
            'password' => $password
        ]);
    }

    public function select(int $id = null)
    {
        if (!$id) {
            $stmt = $this->pdo->query("SELECT * FROM users");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function editUser($id, $email, $password)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET email = :email, password = :password WHERE id = :id");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([
            'id' => $id,
            'email' => $email,
            'password' => $password
        ]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute([$id]);
    }
}

?>