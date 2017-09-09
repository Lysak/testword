<?php

include_once ROOT. '/models/Blog.php';

class BlogController {
    
    public function actionIndex()
    {
        $newsList = array();
        $newsList = Blog::getNewsList(0, 3);
        Blog::getLikes();
        require_once(ROOT . '/views/blog/list.php');
        return true;
    }

    public function actionView($id)
    {
        $newsItem = array();
        $newsItem = Blog::getNewsItemByID($id);
        require_once(ROOT . '/views/blog/view.php');
        return true;
    }


    public function actionAjax()
    {
        // echo "hello ajax";
        $db = DB::getConnection();
        
        // C какой статьи будет осуществляться вывод
        $startFrom = $_POST['startFrom'];
    
        // Получаем 3 статей, начиная с последней отображенной
        $res = $db->query("SELECT * FROM `articles` ORDER BY `id` DESC LIMIT {$startFrom}, 3");
    
        // Формируем массив со статьями
        $articles = array();
        while ($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            $articles[] = $row;
        }
    
        // Превращаем массив статей в json-строку для передачи через Ajax-запрос
        echo json_encode($articles);
        return true;
    }
} 