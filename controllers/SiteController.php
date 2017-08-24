<?php

include_once ROOT. '/models/Blog.php';

class SiteController {
	
    public function actionIndex()
    {
        $newsList = array();
        $newsList = Blog::getNewsList();
        require_once(ROOT . '/views/index.php');
        return true;
    }

    public function actionContact()
    {
        require_once(ROOT . '/views/contacts.php');
        return true;
    }
} 