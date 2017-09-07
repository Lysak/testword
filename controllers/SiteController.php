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
        
        //PAGINATION
        $count_articles = Blog::countArticles();
        // общее количество стр.
        $count_pages = ceil($count_articles / $limit);
        if ($page > $count_pages) $page = $count_pages;
        $prev = $page - 1;
        $next = $page + 1;
        if ($prev < 1) $prev = 1;
        if ($next > $count_pages) $next = $count_pages;
        //PAGINATION END

        require_once(ROOT . '/views/index.php');
        return true;
    }

    // public function actionContact()
    // {
    //     require_once(ROOT . '/views/contacts.php');
    //     return true;
    // }

    public function pagination($page, $limit) {
        // общее кол-во строк в БД
        $count_articles = Blog::countArticles();
        // общее количество стр.
        $count_pages = ceil($count_articles / $limit);
        if ($page > $count_pages) $page = $count_pages;
        $prev = $page - 1;
        $next = $page + 1;
        if ($prev < 1) $prev = 1;
        if ($next > $count_pages) $next = $count_pages;
        
        require_once(ROOT . '/views/index.php');
        return true;
    }
}