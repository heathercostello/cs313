-- DROP TABLE IF EXISTS user_table;
-- DROP TABLE IF EXISTS grocery_list;




-- CREATE TABLE user_table (
--     id     SERIAL   PRIMARY KEY  NOT NULL,
--     username    VARCHAR(30)           NOT NULL  UNIQUE,
--     first_name  VARCHAR(30)           NOT NULL,
--     last_name   VARCHAR(30)           NOT NULL
-- );

-- CREATE TABLE grocery_list (
-- grocery_list_id         SERIAL   PRIMARY KEY  NOT NULL,
-- user_table_id           INTEGER                   NOT NULL    REFERENCES user_table(id),
-- list_content            TEXT                      NOT NULL
-- );

-- CREATE TABLE grocery_list (
-- grocery_list_id         SERIAL   PRIMARY KEY  NOT NULL,
-- user_table_id           INTEGER                   NOT NULL    REFERENCES user_table(id),
-- -- grocery_list_name       VARCHAR(30)               NULL,
-- list_content            TEXT                      NOT NULL
-- );
 

-- INSERT INTO user_table(username, first_name, last_name) VALUES
-- ('heatherfeather', 'heather', 'costello'),
-- ('jojo', 'joseph', 'costello'),
-- ('yellowfive', 'courtney', 'pelessie');

-- INSERT INTO grocery_list(user_table_id, list_content) VALUES
-- ('1', 'green onions, milk, eggs'),
-- ('2', 'bread, milk, eggs'),
-- ('3', 'crackers, icecream');

-- SELECT u.username, g.list_content FROM grocery_list g 
-- JOIN user_table u ON g.user_table_id = u.id
-- WHERE u.username = 'heatherfeather';

-- SELECT u.username, g.list_content FROM grocery_list g 
-- JOIN user_table u ON g.user_table_id = u.id
-- WHERE u.id = '1';
    
DROP TABLE IF EXISTS grocery_user;
DROP TABLE IF EXISTS list;

CREATE TABLE grocery_user (
	id SERIAL PRIMARY KEY,
	username VARCHAR(25) NOT NULL UNIQUE,
	firstName VARCHAR(100) NOT NULL
);

CREATE TABLE list
(
	id SERIAL PRIMARY KEY,
	grocery_user_id INT NOT NULL REFERENCES grocery_user(id),
	content text NOT NULL
);

INSERT INTO grocery_user(username, firstName) VALUES ('heatherfeather', 'Heather');
INSERT INTO grocery_user(username, firstName) VALUES
('mojojoseph', 'Joseph'),
('robynBird', 'Robyn');

INSERT INTO list(grocery_user_id, content) VALUES (1, 'milk, eggs, onion');
INSERT INTO list(grocery_user_id, content) VALUES (2, 'nuts, bananas, bread');
INSERT INTO list(grocery_user_id, content) VALUES (3, 'herbal tea, mugs, green onions');

SELECT g.firstName, l.content FROM list l
JOIN grocery_user g ON l.grocery_user_id = g.id
WHERE g.username = 'heatherfeather';