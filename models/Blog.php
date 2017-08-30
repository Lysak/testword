<?php
class Blog
{
    public static function getNewsItemById($id)
    {
        $id = intval($id);

        if ($id) {

            $db = Db::getConnection();

            $result = $db->query('SELECT * from articles WHERE id='.$id);

            $result->setFetchMode(PDO::FETCH_ASSOC);

            $newsItem = $result->fetch();

            return $newsItem;


        }
    }


    public static function getStart($page, $limit) {
        return $limit * ($page - 1);
    }

    public static function getNewsList($start, $limit)
    {
        $db = Db::getConnection();

        $newsList = array();

        $result = $db->query("SELECT id, title, date, short_content FROM articles ORDER BY date DESC LIMIT ".$start.", ".$limit);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $i = 0;
        while($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $i++;
        }

        return $newsList;
    }

//    public static function getAllArticles($start, $limit) {
//        $db = DB::getConnection();
//        $result = $db->query("SELECT * FROM `articles` ORDER BY date DESC LIMIT ".$start.", ".$limit);
//        $result->setFetchMode(PDO::FETCH_ASSOC);
////		closeDB($db);
//        return Blog::setResultToArray($result);
//    }
//
//    static function setResultToArray($result) {
//        $array = array();
//        while ($row = $result->fetch()) {
//            $array[] = $row;
//        }
//        return $array;
//    }

//    public static function getNewsList()
//    {
//        $db = Db::getConnection();
//
//        $newsList = array();
//
//        $result = $db->query('SELECT id, title, date, short_content '
//            . 'FROM articles '
//            . 'ORDER BY date DESC '
//            . 'LIMIT 3');
////        $result = $db->query("SELECT * FROM `articles` ORDER BY `date` DESC LIMIT ".$start.", ".$limit);
//
//        $i = 0;
//        while($row = $result->fetch()) {
//            $newsList[$i]['id'] = $row['id'];
//            $newsList[$i]['title'] = $row['title'];
//            $newsList[$i]['date'] = $row['date'];
//            $newsList[$i]['short_content'] = $row['short_content'];
//            $i++;
//        }
//
//        return $newsList;
//    }

    public static function createProduct($options)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO articles '
                . '(title, short_content, content)'
                . 'VALUES '
                . '(:title, :short_content, :content)';
        $result = $db->prepare($sql);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':short_content', $options['short_content'], PDO::PARAM_STR);
        $result->bindParam(':content', $options['content'], PDO::PARAM_STR);


        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }

    // *************************** //







    static function countArticles() {
        $db = DB::getConnection();
        $result = $db->query("SELECT COUNT(`id`) FROM `articles`");
        $result = ($row = $result->fetch());
        return $result[0];
    }

    public static function pagination($page, $limit) {
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
                                     </li>";;
            }
            for ($i = 1; $i <= $count_pages; $i++) {
//                if ($i == $page) $pagination .= "<span> ".$i." </span>";
//                if ($i == $page) $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"#\">$i</a></li>";
//                elseif ($i == 1) $pagination .= "<a href='/index/'> ".$i." </a>";
                if ($i == 1) $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"/\">$i</a></li>";
//                else $pagination .= "<a href='/index/?page=".$i."'> ".$i." </a>";
                else $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"/index/?page=".$i."\">$i</a></li>";
            }
            if ($page == $count_pages) {
                $pagination .= "<li class=\"page-item disabled\">
                                    <a class=\"page-link\">Next</a>
                                </li>";
            }
            if ($page != $count_pages) {
//                $pagination .= "<a href='/index/?page=".$next."'> Next</a>";
                $pagination .= "<li class=\"page-item\">
                                    <a class=\"page-link\" href=\"/index/?page=".$next."\">Next</a>
                                </li>";
            }


//            if ($page == 1) {
//                $pagination .= "<span>Прервая </span>";
//                $pagination .= "<span>Предыдущая </span>";
//            }
//            else {
//                $pagination .= "<a href='/'>Прервая </a>";
//                if ($prev == 1) $pagination .= "<a href='/'>Прервая </a>";
//                else $pagination .= "<a href='/index/?page=".$prev."'>Предыдущая </a>";
//            }
//            for ($i = 1; $i <= $count_pages; $i++) {
//                if ($i == $page) $pagination .= "<span> ".$i." </span>";
//                elseif ($i == 1) $pagination .= "<a href='/index/'> ".$i." </a>";
//                else $pagination .= "<a href='/index/?page=".$i."'> ".$i." </a>";
//            }
//            if ($page == $count_pages) {
//                $pagination .= "<span> Следующая</span>";
//                $pagination .= "<span> Последняя</span>";
//            }
//            else {
//                $pagination .= "<a href='/index/?page=".$next."'> Следующая</a>";
//                $pagination .= "<a href='/index/?page=".$count_pages."'> Последняя</a>";
//            }
        }



        return $pagination;
    }
}