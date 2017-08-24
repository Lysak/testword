<?php

include_once ROOT. '/models/User.php';
include_once ROOT. '/models/Blog.php';

class AdminController {

    public function actionLogin()
    {
        $email = false;
        $password = false;

        if (isset($_POST['submit'])) 
        {
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
//            $secretPassword = hash("sha256", $password);

            $userId = User::checkUserData($email, $password);
            if ($userId == false) {
                $errors[] = 'Неправильні дані для входу';
//                print_r($errors);
            } else {
                    User::auth($userId);
                    }
            header("Location: /admin");
        }
        require_once(ROOT . '/views/admin/signin.php');
        return true;
    }

    public function actionIndex()
    {
        User::checkLogged();     
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

    public function actionAddNews()
    {
        if (isset($_POST['submit'])) {

            $options['title'] = $_POST['title'];
            $options['short_content'] = $_POST['short_content'];
            $options['content'] = $_POST['content'];

                $id = Blog::createProduct($options);

                if ($id) {
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/template/img/news/{$id}.jpg");
                    }
                }
            }
        
        require_once(ROOT . '/views/admin/create.php');
        return true;
    }
}