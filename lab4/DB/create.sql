CREATE TABLE IF NOT EXISTS themes
(
    themes_id   INT(10)      NOT NULL AUTO_INCREMENT,
    themes_path VARCHAR(100) NOT NULL,
    themes_name VARCHAR(100) NOT NULL,
    PRIMARY KEY (themes_id)
)
;
CREATE TABLE IF NOT EXISTS users
(
    users_id         INT(10)      NOT NULL AUTO_INCREMENT,
    users_login      VARCHAR(100) NOT NULL,
    users_email      VARCHAR(100) NOT NULL,
    users_password   VARCHAR(100) NOT NULL,
    users_first_name VARCHAR(100) NULL     DEFAULT NULL,
    users_last_name  VARCHAR(100) NULL     DEFAULT NULL,
    users_created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    themes_id        INT(10)      NOT NULL,
    PRIMARY KEY (users_id),
    INDEX fk_users_themes1_idx1 (themes_id ASC) VISIBLE,
    CONSTRAINT fk_users_themes1
        FOREIGN KEY (themes_id)
            REFERENCES themes (themes_id)
            ON DELETE SET NULL
)
;

CREATE TABLE IF NOT EXISTS comments
(
    comments_id         INT(10)   NOT NULL AUTO_INCREMENT,
    users_id            INT(10)   NULL     DEFAULT NULL,
    comments_comment    TEXT      NOT NULL,
    comments_created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (comments_id),
    INDEX users_id (users_id ASC) VISIBLE,
    CONSTRAINT comments_ibfk_1
        FOREIGN KEY (users_id)
            REFERENCES users (users_id)
            ON DELETE SET NULL
)
;

CREATE TABLE IF NOT EXISTS news
(
    news_id             INT(10)   NOT NULL AUTO_INCREMENT,
    users_id            INT(10)   NULL     DEFAULT NULL,
    news_detail_picture TEXT      NULL     DEFAULT NULL,
    news_view_picture   TEXT      NULL     DEFAULT NULL,
    news_detail_text    TEXT      NOT NULL,
    news_view_text      TEXT      NOT NULL,
    news_created_at     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    news_name           CHAR(200) NOT NULL,
    PRIMARY KEY (news_id),
    INDEX users_id (users_id ASC) VISIBLE,
    CONSTRAINT news_ibfk_1
        FOREIGN KEY (users_id)
            REFERENCES users (users_id)
            ON DELETE SET NULL
)