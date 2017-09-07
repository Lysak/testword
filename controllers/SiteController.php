<?php

include_once ROOT. '/models/Blog.php';

class SiteController {

    protected $page = false;
    protected $limit = 4;
    protected $prev;
    protected $next;
    protected $count_pages;
    
    public function actionIndex()
    {
        $newsList = array();
        require_once ROOT."/models/Blog.php";
        // текущая страница
        

        if ($this->page < 1 or $this->page == "") {
            $this->page = 1;
        }

        if (array_key_exists('page', $_GET))
        {
            $this->page = $_GET['page'];
        }

        // количество строк-статей на стр.
        
        // начало выборки из БД
        $start = Blog::getStart($this->page, $this->limit);
        $newsList = Blog::getNewsList($start, $this->limit);

        $this->paginate($this->limit);
        $prev = $this->prev;
        $next = $this->next;
        $count_pages = $this->count_pages;
        $page = $this->page;
        
        require_once(ROOT . '/views/index.php');
        return true;
    }

    // public function actionContact()
    // {
    //     require_once(ROOT . '/views/contacts.php');
    //     return true;
    // }
    public function paginate($limit) 
    {
        //PAGINATION
        $count_articles = Blog::countArticles();
        // общее количество стр.
        $this->count_pages = ceil($count_articles / $limit);
        if ($this->page > $this->count_pages) $this->page = $this->count_pages;
        $this->prev = $this->page - 1;
        $this->next = $this->page + 1;
        if ($this->prev < 1) $prev = 1;
        if ($this->next > $this->count_pages) $this->next = $this->count_pages;
        //PAGINATION END
    }
}