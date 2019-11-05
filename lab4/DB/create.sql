
CREATE TABLE users
(
    users_id   int(10)                             NOT NULL AUTO_INCREMENT,
    login      VARCHAR(100)                        NOT NULL,
    email      VARCHAR(100)                        NOT NULL,
    password   VARCHAR(100)                        NOT NULL,
    first_name VARCHAR(100),
    last_name  VARCHAR(100),
    created_at timestamp default current_timestamp NOT NULL,
    PRIMARY KEY (users_id)
);


CREATE TABLE comments
(
    comments_id int(10)                             NOT NULL AUTO_INCREMENT,
    users_id    int(10),
    comment     text                                NOT NULL,
    created_at  timestamp default current_timestamp NOT NULL,
    FOREIGN KEY (users_id) REFERENCES users (users_id) ON DELETE SET NULL,
    PRIMARY KEY (comments_id)
);

CREATE TABLE news
(
    news_id        int(10)                             NOT NULL AUTO_INCREMENT,
    users_id       int(10),
    detail_picture text,
    view_picture   text,
    detail_text    text                                NOT NULL,
    view_text      text                                NOT NULL,
    created_at     timestamp default current_timestamp NOT NULL,
    FOREIGN KEY (users_id) REFERENCES users (users_id) ON DELETE SET NULL,
    PRIMARY KEY (news_id)
);

