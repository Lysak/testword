<?php

class User
{
    public static function checkUserData($email, $password)
    {
        $db = DB::getConnection();
        $sql = 'SELECT id, email, password FROM user WHERE email = :email AND password = :password';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();
        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }
        return false;
    }

    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        if (!isset($_SESSION['user'])) 
        {
            header("Location: /admin/login");
        }
            return true;
    }
}