<?php
require_once './dao/UserDaoMysql.php';

class Auth {
    private $pdo;
    private $base;

    public function __construct(PDO $pdo, $base){
        $this->pdo = $pdo;
        $this->base = $base;
        $this->dao = new UserDaoMysql($this->pdo);
    }

    public function checkToken(){
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];

            $user = $this->dao->findByToken($token);

            if($user){
                return $user;
            }

        }

        header('Location: '.$this->base.'/login.php');
        exit;
    }

    public function validateLogin($email, $password){

        $user = $this->dao->findByEmail($email);
        $newPassword = $user->password;

        if($user){
            if($password == $newPassword){
               
                $token = md5(time().rand(0, 9999));
                $_SESSION['token'] = $token;
                $user->token = $token;
                $this->dao->update($user);

                return true;
            }
        }

        return false;
    }
}

?>