<?php

include_once ROOT. '/models/Blog.php';

class BlogController {
    
    public function actionIndex()
    {
        $newsList = array();
        $newsList2 = array();
        $add = array();
        $newsList = Blog::getNewsList(0, 3);
        foreach($newsList as $postItem){
            $rowCount = Blog::ifUserHasAlreadyLikeThisPost($postItem);
            // print_r($postItem);
            $add = ['if_like' => $rowCount];
            $postItem = array_merge($postItem, $add);
            array_push($newsList2, $postItem);
       }
        // echo '<pre>';
        // print_r($newsList2);
        // echo '</pre>';
        
        Blog::getLikes();
        require_once(ROOT . '/views/blog/list.php');
        return true;


        // $newsList = array();
        // $newsList2 = array();
        // $newsList = Blog::getNewsList(0, 3);
        // foreach($newsList as $postItem){
        //     $rowCount = Blog::ifUserHasAlreadyLikeThisPost($postItem);
        //     array_push($postItem, $rowCount);
        //     array_push($newsList2, $postItem);
        // }
        // echo '<pre>';
        // print_r($newsList2);
        // echo '</pre>';
        
        // Blog::getLikes();
        // require_once(ROOT . '/views/blog/list.php');
        // return true;
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
        // $startFrom = 0;
    
        // Получаем 3 статей, начиная с последней отображенной
        $res = $db->query("SELECT * FROM `articles` ORDER BY `id` DESC LIMIT {$startFrom}, 3");
    
        // Формируем массив со статьями
        $articles = array();
        while ($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            $articles[] = $row;
        }
        

        // echo '<pre>';
        // print_r($articles);
        // echo '</pre>';
        
        //
        // $newsList = array();
        $newsList2 = array();
        $add = array();
        // $newsList = Blog::getNewsList(0, 3);
        foreach($articles as $postItem){
            $rowCount = Blog::ifUserHasAlreadyLikeThisPost($postItem);
            // print_r($postItem);
            $add = ['if_like' => $rowCount];
            $postItem = array_merge($postItem, $add);
            array_push($newsList2, $postItem);
       }
        // echo '<pre>';
        // print_r($newsList2);
        // echo '</pre>';
        //
        // Превращаем массив статей в json-строку для передачи через Ajax-запрос
        echo json_encode($newsList2);
        return true;
    }
} 