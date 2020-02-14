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
grocery_list_name       VARCHAR(30)               NOT NULL,
list_content            TEXT                      NOT NULL
);
 
 -- CREATE SEQUENCE user_table_sequence START WITH 1001;
--CREATE SEQUENCE grocery_list_sequence START WITH 1001;

-- CREATE TABLE product (
--     product_id          SERIAL   PRIMARY KEY  NOT NULL,
--     product_name        VARCHAR(30)           NOT NULL,
--     product_quantity    INTEGER        
-- );

-- CREATE SEQUENCE product_sequence START WITH 1001;

/* SOME FICTIONAL INFO TO INSERT */ 

INSERT INTO user_table(username, first_name, last_name) VALUES
('heatherfeather', 'heather', 'costello'),
('jojo', 'joseph', 'costello'),
('yellowfive', 'courtney', 'pelessie');

INSERT INTO grocery_list(user_table_id, grocery_list_name, list_content) VALUES
('1', 'weekOneHeather', 'green onions, milk, eggs'),
('2', 'weekOneJoseph', 'bread, milk, eggs'),
('3', 'weekOneCourtney', 'crackers, icecream');

SELECT u.username, g.list_content FROM grocery_list g 
JOIN user_table u ON g.user_table_id = u.id
WHERE u.username = 'heatherfeather';

SELECT u.username, g.list_content FROM grocery_list g 
JOIN user_table u ON g.user_table_id = u.id
WHERE u.id = '1';


-- INSERT INTO user_table VALUES
--     (NEXTVAL('user_table'), 'heathercostello', 'Heather', 'Costello'),
--     (NEXTVAL('user_table'), 'josephcostello', 'Joseph', 'Costello'),
--     (NEXTVAL('user_table'), 'charliecostello', 'Charlie', 'Costello');
    


-- INSERT INTO grocery_list VALUES
--     (NEXTVAL('grocery_list'), '1001', '1001', 'First Week', 'My List for this week.'),
--     (NEXTVAL('grocery_list'), '1001', '1001', 'Second Week', 'My List for this week.'),
--     (NEXTVAL('grocery_list'), '1001', '1001', 'Third Week', 'My List for this week.');



    -- CREATE TABLE food_category (
--     food_category_id       SERIAL   PRIMARY KEY  NOT NULL,
--     food_category_name     VARCHAR(30)                                                NOT NULL
-- );

-- CREATE SEQUENCE food_category_sequence START WITH 1001;
    