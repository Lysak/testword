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
//    {
//        $id = intval($id);
//        $newsItem = array();
//        if ($id) {
//            $db = Db::getConnection();
//
//            $result = $db->query('SELECT id, title, date, content FROM articles WHERE id=' . $id);
//            $i = 0;
//            while($row = $result->fetch()) {
//                $newsItem[$i]['id'] = $row['id'];
//                $newsItem[$i]['title'] = $row['title'];
//                $newsItem[$i]['date'] = $row['date'];
//                $newsItem[$i]['content'] = $row['content'];
//                $i++;
//            }
//        }
//        $newsItem = $result->fetch();
//        return $newsItem;
//    }

    public static function getNewsList()
    {
        $db = Db::getConnection();

        $newsList = array();

        $result = $db->query('SELECT id, title, date, short_content, author_name, preview '
            . 'FROM articles '
            . 'ORDER BY date DESC '
            . 'LIMIT 6');

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

//    public static function getNewsList() {
//        $db = Db::getConnection();
//        $newsList = array();
//        $result = $db->query('SELECT id, title, date, short_content FROM articles ORDER BY date DESC LIMIT 10');
//        $i = 0;
//        while($row = $result->fetch()) {
//            $newsList[$i]['id'] = $row['id'];
//            $newsList[$i]['title'] = $row['title'];
//            $newsList[$i]['date'] = $row['date'];
//            $newsList[$i]['short_content'] = $row['short_content'];
//            $i++;
//        }
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
}