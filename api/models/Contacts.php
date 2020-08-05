<?php
class Contacts {
    private $conn;
    private $table = 'contacts';

    private $id;
    private $user_id;
    private $name;
    private $c_num;
    private $in_gen;

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
                    'user_id' => $user_id,
                    'name' => $name,
                    'cnum' => $cnum,
                    'in_gen' => $in_gen,
                ];

                $users['data'][] = $user;
            }
        }

        return $users;
    }

    public function find($contact)
    {
        $this->user_id = $contact['user_id'];
        $this->name = $contact['name'];
        $this->cnum = $contact['cnum'];
        $this->in_gen = $contact['in_gen'];

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

    public function where ($col, $val = true)
    {
        $query = "SELECT * FROM contacts WHERE $col = $val";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $users = [];

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $user = [
                    'id' => $id,
                    'user_id' => $user_id,
                    'name' => $name,
                    'cnum' => $cnum,
                    'in_gen' => $in_gen,
                ];

                $users['data'][] = $user;
            }
        }

        return $users;
    }

    public function create ($new_contact)
    {
        $this->user_id = $new_contact['user_id'];
        $this->name = $new_contact['name'];
        $this->cnum = $new_contact['cnum'];
        $this->in_gen = $new_contact['in_gen'];

        $query = "INSERT INTO $this->table SET user_id = :user_id, name = :name, cnum = :cnum, in_gen = :in_gen";
        
        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->cnum = htmlspecialchars(strip_tags($this->cnum));

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':cnum', $this->cnum);
        $stmt->bindParam(':in_gen', $this->in_gen);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update ($id, $arr)
    {
        $str_arr = [];
        $str = "";
        foreach ($arr as $key => $value) {
            $str_arr[] = "$key = false";
        }
        $str = implode(",", $str_arr);

        $query = "UPDATE $this->table SET $str WHERE id = $id";

        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
