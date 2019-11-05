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
        $res = $this->DB->query("SELECT NEWS_ID, USERS_ID, NEWS_DETAIL_PICTURE ,NEWS_DETAIL_TEXT, NEWS_CREATED_AT FROM news where NEWS_ID = $id");
        if($news = $res->fetch_assoc()) {
            return $news;
        }
        return $news;
    }

    public function addNews($arNews) {
        if($users_id = Users::getCurrentUser()) {
            $res = $this->DB->query("INSERT INTO news(users_id, news_detail_text, news_view_text, news_detail_picture, news_view_picture) VALUES ($users_id, '$arNews[DETAIL]', '$arNews[VIEW]', '$arNews[DETAIL_PICTURE]', '$arNews[VIEW_PICTURE]')");
            return $this->DB->insert_id;
        }
        else return false;
    }

    public function getNewsList() {
        $res = $this->DB->query("SELECT n.NEWS_ID, n.USERS_ID, n.NEWS_VIEW_TEXT, n.NEWS_VIEW_PICTURE, n.NEWS_CREATED_AT, u.USERS_LOGIN, u.USERS_FIRST_NAME, u.USERS_LAST_NAME FROM news n LEFT JOIN users u on n.users_id = u.users_id");
        $arNews = $res->fetch_all();
        return $arNews;
    }
}