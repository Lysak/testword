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
} 