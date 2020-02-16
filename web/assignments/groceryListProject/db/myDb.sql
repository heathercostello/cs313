DROP TABLE IF EXISTS user_table;
DROP TABLE IF EXISTS grocery_list;




CREATE TABLE user_table (
    id     SERIAL   PRIMARY KEY  NOT NULL,
    username    VARCHAR(30)           NOT NULL  UNIQUE,
    first_name  VARCHAR(30)           NOT NULL,
    last_name   VARCHAR(30)           NOT NULL
);

CREATE TABLE grocery_list (
grocery_list_id         SERIAL   PRIMARY KEY  NOT NULL,
user_table_id           INTEGER                   NOT NULL    REFERENCES user_table(id),
list_content            TEXT                      NOT NULL
);

CREATE TABLE grocery_list (
grocery_list_id         SERIAL   PRIMARY KEY  NOT NULL,
user_table_id           INTEGER                   NOT NULL    REFERENCES user_table(id),
-- grocery_list_name       VARCHAR(30)               NULL,
list_content            TEXT                      NOT NULL
);
 

INSERT INTO user_table(username, first_name, last_name) VALUES
('heatherfeather', 'heather', 'costello'),
('jojo', 'joseph', 'costello'),
('yellowfive', 'courtney', 'pelessie');

INSERT INTO grocery_list(user_table_id, list_content) VALUES
('1', 'green onions, milk, eggs'),
('2', 'bread, milk, eggs'),
('3', 'crackers, icecream');

SELECT u.username, g.list_content FROM grocery_list g 
JOIN user_table u ON g.user_table_id = u.id
WHERE u.username = 'heatherfeather';

SELECT u.username, g.list_content FROM grocery_list g 
JOIN user_table u ON g.user_table_id = u.id
WHERE u.id = '1';
    