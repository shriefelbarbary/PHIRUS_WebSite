<?php
class User {
    private $conn;
    private $table = "users";
    private $table2 = "password_reset_tokens";
    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register() {
        $query = "INSERT INTO " . $this->table . " (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->execute();
        return $stmt;
    }

    public function login() {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return false;
    }
    public function getProfile()
    {
        $query = 'SELECT username FROM '.$this->table.' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function storeResetToken($token)
    {
        $query = 'INSERT INTO '.$this->table2.' (email, token) VALUES (:email, :token)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt;
    }
    public function verifyToken($token): bool
    {
        $query = "SELECT email FROM password_reset_tokens WHERE token = :token AND created_at >= NOW() - INTERVAL 1 HOUR";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->email = $result["email"];
            return true;
        }
        return false;
    }
    public function updatePassword($newPassword) {
        $query = "UPDATE users SET password = :password WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":password", $newPassword);
        $stmt->bindParam(":email", $this->email);
        return $stmt->execute();
    }
}
?>
