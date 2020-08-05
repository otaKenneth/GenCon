<?php
class Users {
    private $conn;
    private $table = 'users';

    private $id;
    private $username;
    private $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function all ()
    {
        $query = "SELECT * FROM $this->table";
        $users = [];

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $user = [
                    'id' => $id,
                    'username' => $username,
                    'password' => $password,
                ];

                $users['data'][] = $user;
            }
        }

        return $users;
    }

    public function find($user)
    {
        $this->username = $user['username'];
        $this->password = $user['password'];

        $query = "SELECT * FROM $this->table WHERE username = :username AND password = :password";
        $users = [];

        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = md5(htmlspecialchars(strip_tags($this->password)));

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $user = [
                    'id' => $id,
                    'username' => $username,
                    // 'password' => $password,
                ];

                $users['data'][] = $user;
            }
        }

        return $users;
    }

    public function create ($user)
    {
        $this->username = $user['username'];
        $this->password = $user['password'];

        $query = "INSERT INTO $this->table SET username = :username, password = :password";
        
        $stmt = $this->conn->prepare($query);
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>