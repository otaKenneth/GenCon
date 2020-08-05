<?php
include 'index.php';

$request = $_POST;

$login = new Login($db);
$login->login($request);

class Login {
    private $users;

    public function __construct($db)
    {
        $this->users = new Users($db);
    }

    public function login ($request) {
        $user = $this->users->find($request);

        if (count($user['data']) == 1) {
            session_start();
            $_SESSION['user'] = $user['data'][0];
            header("Location: ../");
        }
        
    }
}

?>