<?php

include_once ROOT. '/models/Blog.php';

class BlogController {
    
    public function actionIndex()
    {
        $newsList = array();
        $newsList = Blog::getNewsList(1, 3); // ajax placeholder
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

    public function actionLikes()
    {
        $newsItem = array();
        $newsItem = Blog::getLikes();


        // determine if user has already like this post
        $result = mysql_query("SELECT * FROM likes WHERE userid=1 AND postid=".$newsItem['id']."");


        require_once(ROOT . '/views/blog/list.php');
        return true;
    }
} 