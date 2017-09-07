<?php
/**
 * Created by PhpStorm.
 * User: lysak
 * Date: 31.08.17
 * Time: 0:30
 */

include_once ROOT. '/models/Auth.php';
//include_once ROOT. '/models/User.php';

class AuthController
{

    public function actionLogin()
    {
        require_once(ROOT . '/views/auth/login.php');

        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION["session_username"])) {
            header("Location: intropage");
        }

        if (isset($_POST["login"])) {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                Auth::checkUserData($username, $password);

            }
        }
        return true;
    }


    public function actionIntropage()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
        if(!isset($_SESSION["session_username"])) {
            header("location:login.php");
        } else {
            require_once(ROOT . '/views/auth/intropage.php');
        }
        return true;
    }

    public function actionLogout()
    {
        session_start();
        unset($_SESSION['session_username']);
        session_destroy();
        header("location:login");
        return true;
    }

    public function actionRegister()
    {
        require_once(ROOT . '/views/auth/register.php');
        require_once(ROOT . '/views/auth/connection.php');

        if(isset($_POST["register"])) {


            if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                $full_name=$_POST['full_name'];
                $email=$_POST['email'];
                $username=$_POST['username'];
                $password=$_POST['password'];

                $query=mysql_query("SELECT * FROM usertbl WHERE username='".$username."'");
                $numrows=mysql_num_rows($query);

                if($numrows==0)
                {
                    $sql="INSERT INTO usertbl
                    (full_name, email, username,password) 
                    VALUES('$full_name','$email', '$username', '$password')";

                    $result=mysql_query($sql);


                    if($result){
                        $message = "Account Successfully Created";
                    } else {
                        $message = "Failed to insert data information!";
                    }

                } else {
                    $message = "That username already exists! Please try another one!";
                }

            } else {
                $message = "All fields are required!";
            }
        }
        if (!empty($message)) {echo "<p class=\"error\">" . "MESSAGE: ". $message . "</p>";}


        return true;
    }
}