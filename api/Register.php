<?php
include 'index.php';

$request = $_POST;

$register = new Register($db);
$register->register($request);

class Register {
    private $users;

    public function __construct($db)
    {
        $this->users = new Users($db);
    }

    public function register($request)
    {
        $confirmation = $this->checkPassword($request['password'], $request['confirm_password']);

        if ($confirmation) {
            $user = [
                'username' => $request['username'],
                'password' => md5($request['password'])
            ];

            if ($this->users->create($user)) {
                header("Location: ../");
            }
        }else{
            header("../?err=1");
        }
    }

    public function checkPassword($pass, $cpass)
    {
        return $pass == $cpass;
    }
}


?>