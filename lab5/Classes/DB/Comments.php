<?php


namespace DB;

/*"
CREATE TABLE IF NOT EXISTS `ilya_labs_lab4`.`comments` (
`comments_id` INT(10) NOT NULL AUTO_INCREMENT,
  `comments_comment` TEXT NULL DEFAULT NULL,
  `comments_created_at` TIMESTAMP NULL DEFAULT NULL,
  `users_id` INT(10) NOT NULL,
  `news_id` INT(10) NOT NULL,
  PRIMARY KEY (`comments_id`),
  INDEX `fk_comments_users1` (`users_id` ASC) VISIBLE,
  INDEX `fk_comments_news1` (`news_id` ASC) VISIBLE,
  CONSTRAINT `fk_comments_news1`
    FOREIGN KEY (`news_id`)
    REFERENCES `ilya_labs_lab4`.`news` (`news_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `ilya_labs_lab4`.`users` (`users_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
"*/
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