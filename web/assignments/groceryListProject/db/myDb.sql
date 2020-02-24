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
    

CREATE TABLE course (
	id SERIAL PRIMARY KEY,
	code VARCHAR(25) NOT NULL UNIQUE,
	name VARCHAR(100) NOT NULL
);

CREATE TABLE note
(
	id SERIAL PRIMARY KEY,
	course_id INT NOT NULL REFERENCES course(id),
	content text NOT NULL
);

INSERT INTO course(code, name) VALUES ('CS 313', 'Web Engineering II');
INSERT INTO course(code, name) VALUES
('CS 450', 'Machine Learning and Data Mining'),
('CS 246', 'Software Design and Development');

INSERT INTO note(course_id, content) VALUES (1, 'Today we are learning about dbs');
INSERT INTO note(course_id, content) VALUES (1, 'Inner joins are interesting');
INSERT INTO note(course_id, content) VALUES (2, 'I like neural networks.');

SELECT c.name, n.content FROM note n
JOIN course c ON n.course_id = c.id
WHERE c.code = 'CS 313';