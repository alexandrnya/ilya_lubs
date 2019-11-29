<?php


namespace DB;

class Comments
{
    private $DB;

    public function __construct()
    {
        global $mysqli;
        $this->DB = $mysqli;
    }

    public function addComment($arComment)
    {
        if($users_id = Users::getCurrentUser()) {
            $res =
                $this->DB->query("INSERT INTO comments(users_id, comments_comment, news_id) VALUES ($users_id, '$arComment[COMMENT]', '$arComment[NEWS_ID]')");
            return $this->DB->insert_id;
        }
        else return false;
    }

    public function getCommentsByNews(
        $news_id)
    {
        $news_id = intval($news_id);
        $arComments = [];
        if($news_id) {
            if($res = $this->DB->query("SELECT c.COMMENTS_ID, c.USERS_ID, c.COMMENTS_CREATED_AT, c.COMMENTS_COMMENT, u.USERS_LOGIN FROM comments c LEFT JOIN users u on c.users_id = u.users_id where c.NEWS_ID = $news_id order by c.COMMENTS_CREATED_AT desc")) {
                //$res = $this->DB->query("select COMMEWNTS_ID, USERS_ID, COMMENTS_COMMENT, COMMENTS_CREATED_AT FROM comments");
                while($item = $res->fetch_assoc()) {
                    $arComments[] = $item;
                }
            }
            return $arComments;
        }
    }
    
    public function deleteComment($id) {
        if($users_id = Users::getCurrentUser()) {
            return $res = $this->DB->query("DELETE FROM comments WHERE comments_id = '$id' and users_id = '$users_id'");
        }
    }
}