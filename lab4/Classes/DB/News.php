<?php


namespace DB;


class News
{
    private $DB;

    public function __construct()
    {
        global $mysqli;
        $this->DB = $mysqli;
    }

    public function getNewsDetailByID($id) {
        $news = array();
        $res = $this->DB->query("SELECT n.NEWS_ID, n.NEWS_NAME, n.USERS_ID, n.NEWS_DETAIL_PICTURE ,n.NEWS_DETAIL_TEXT, n.NEWS_CREATED_AT, u.USERS_LOGIN, u.USERS_FIRST_NAME, u.USERS_LAST_NAME FROM news n LEFT JOIN users u on n.users_id = u.users_id where NEWS_ID = $id");
        if($news = $res->fetch_assoc()) {
            return $news;
        }
        return $news;
    }

    public function addNews($arNews) {
        if($users_id = Users::getCurrentUser()) {
            $res = $this->DB->query("INSERT INTO news(users_id, news_name, news_detail_text, news_view_text, news_detail_picture, news_view_picture) VALUES ($users_id, '$arNews[NAME]', '$arNews[DETAIL_TEXT]', '$arNews[VIEW_TEXT]', '$arNews[DETAIL_PICTURE]', '$arNews[VIEW_PICTURE]')");
            return $this->DB->insert_id;
        }
        else return false;
    }

    public function deleteNews($id) {
        if($users_id = Users::getCurrentUser()) {
            $res = $this->DB->query("DELETE FROM news WHERE news.news_id = $id and users_id = $users_id");
        }
    }

    public function getNewsList() {
        $result = [];
        $dbRes = $this->DB->query("SELECT n.NEWS_ID, n.NEWS_NAME, n.USERS_ID, n.NEWS_VIEW_TEXT, n.NEWS_VIEW_PICTURE, n.NEWS_CREATED_AT, u.USERS_LOGIN, u.USERS_FIRST_NAME, u.USERS_LAST_NAME FROM news n LEFT JOIN users u on n.users_id = u.users_id");
        while ($arNews = $dbRes->fetch_assoc()) {
            $result[] = $arNews;
        }
        return $result;
    }
}