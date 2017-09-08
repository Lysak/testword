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

        $result = $db->query("SELECT id, title, date, short_content, likes FROM articles ORDER BY date DESC LIMIT ".$start.", ".$limit);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $i = 0;
        while($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['likes'] = $row['likes'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $i++;
        }

        return $newsList;
    }

    public static function getLikes()
    {

    }


    public static function createProduct($options)
    {
        $db = DB::getConnection();
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

    static function countArticles() {
        $db = DB::getConnection();
        $result = $db->query("SELECT COUNT(`id`) FROM `articles`");
        $result = ($row = $result->fetch());
        return $result[0];
    }
}