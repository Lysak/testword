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
        $pagination = "<ul class=\"pagination justify-content-center\">";
        if ($count_pages > 1) {
            // pagination
            if ($page == 1) {
                $pagination .= "<li class=\"page-item disabled\">
                                    <a class=\"page-link\" tabindex=\"\">Prev</a>
                                </li>";
            }
            else {
                if ($prev == 1) $pagination .= "<li class=\"page-item\">
                                                    <a class=\"page-link\" href=\"/\" tabindex=\"\">Prev</a>
                                                </li>";
                else $pagination .= "<li class=\"page-item \">
                                        <a class=\"page-link\" href=\"/index/?page=".$prev."\" tabindex=\"\">Prev</a>
                                     </li>";
            }
            for ($i = 1; $i <= $count_pages; $i++) {
                if ($i == 1) $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"/\">$i</a></li>";
                else $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"/index/?page=".$i."\">$i</a></li>";
            }
            if ($page == $count_pages) {
                $pagination .= "<li class=\"page-item disabled\">
                                    <a class=\"page-link\">Next</a>
                                </li>";
            }
            if ($page != $count_pages) {
                $pagination .= "<li class=\"page-item\">
                                    <a class=\"page-link\" href=\"/index/?page=".$next."\">Next</a>
                                </li>";
            }
        }
        return $pagination;
    }
} 