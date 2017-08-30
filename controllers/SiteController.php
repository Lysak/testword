<?php

include_once ROOT. '/models/Blog.php';

class SiteController {
	
    public function actionIndex()
    {
        $newsList = array();
        require_once ROOT."/models/Blog.php";
        // текущая страница
        $page = false;

        if ($page < 1 or $page == "") {
            $page = 1;
        }

        if (array_key_exists('page', $_GET))
        {
            $page = $_GET['page'];
        }

        // количество строк-статей на стр.
        $limit = 4;
        // начало выборки из БД
        $start = Blog::getStart($page, $limit);
        $newsList = Blog::getNewsList($start, $limit);
        require_once(ROOT . '/views/index.php');
        return true;
    }

    public function actionContact()
    {
        require_once(ROOT . '/views/contacts.php');
        return true;
    }
} 