<?php
class Blog
{
    public static function getNewsItemByID($id)
    {
        $id = intval($id);
        $newsItem = array();
        if ($id) {
            $db = Db::getConnection();
            
            $result = $db->query('SELECT id, title, date, content FROM articles WHERE id=' . $id);
            $i = 0;
            while($row = $result->fetch()) {
                $newsItem[$i]['id'] = $row['id'];
                $newsItem[$i]['title'] = $row['title'];
                $newsItem[$i]['date'] = $row['date'];
                $newsItem[$i]['content'] = $row['content'];
                $i++;
            }
        }
        return $newsItem;
    }

    public static function getNewsList() {
        $db = Db::getConnection();
        $newsList = array();
        $result = $db->query('SELECT id, title, date, preview FROM articles ORDER BY id ASC LIMIT 10');
        $i = 0;
        while($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['preview'] = $row['preview'];
            $i++;
        }
        return $newsList;
    }


    public static function createProduct($options)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO articles '
                . '(title, preview, content)'
                . 'VALUES '
                . '(:title, :preview, :content)';
        $result = $db->prepare($sql);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':preview', $options['preview'], PDO::PARAM_STR);
        $result->bindParam(':content', $options['content'], PDO::PARAM_STR);

        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }
}