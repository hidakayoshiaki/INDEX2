<?php
class DbConnection {
    private $host = 'localhost';
    private $dbname = 'test';
    private $user = 'root';
    private $pass = '';

    public function connect() {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user,
                $this->pass
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "エラー: " . $e->getMessage();
            exit;
        }
    }
}
