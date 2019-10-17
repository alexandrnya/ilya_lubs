CREATE TABLE comments (
                            id int(10) NOT NULL AUTO_INCREMENT,
                            user_id int(10),
                            comment text NOT NULL,
                            created_at timestamp default current_timestamp NOT NULL,
                            FOREIGN KEY (user_id)  REFERENCES users (Id) ON DELETE SET NULL,
                            PRIMARY KEY (id)
);

CREATE TABLE users (
                         id int(10) NOT NULL AUTO_INCREMENT,
                         username VARCHAR(100) NOT NULL,
                         email VARCHAR(100) NOT NULL,
                         password VARCHAR(100) NOT NULL,
                         first_name VARCHAR(100),
                         last_name VARCHAR(100),
                         created_at timestamp default current_timestamp NOT NULL,
                         PRIMARY KEY (id)
)