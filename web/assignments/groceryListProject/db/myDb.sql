DROP TABLE IF EXISTS user_table;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS grocery_list;
DROP TABLE IF EXISTS food_category;

DROP SEQUENCE IF EXISTS user_table_sequence;
DROP SEQUENCE IF EXISTS product_sequence;
DROP SEQUENCE IF EXISTS grocery_list_sequence;
DROP SEQUENCE IF EXISTS food_category_sequence;


CREATE TABLE user_table (
    user_id     SERIAL   PRIMARY KEY  NOT NULL,
    username    VARCHAR(30)           NOT NULL,
    first_name  VARCHAR(30),
    last_name   VARCHAR(30)
);

CREATE SEQUENCE user_table_sequence START WITH 1001;

CREATE TABLE product (
    product_id          SERIAL   PRIMARY KEY  NOT NULL,
    product_name        VARCHAR(30)                                         NOT NULL,
    product_quantity    INTEGER        
);

CREATE SEQUENCE product_sequence START WITH 1001;

CREATE TABLE grocery_list (
    grocery_list_id         SERIAL   PRIMARY KEY  NOT NULL,
    user_id                 INTEGER                                             NOT NULL,
    product_id              INTEGER                                             NOT NULL,
    grocery_list_name       VARCHAR(300)                                        NOT NULL,
    food_category_sequence_text               TEXT);
 

CREATE SEQUENCE grocery_list_sequence START WITH 1001;

/* SOME FICTIONAL INFO TO INSERT */ 

INSERT INTO user_table VALUES
    (NEXTVAL('user_table_sequence'), 'heathercostello', 'Heather', 'Costello'),
    (NEXTVAL('user_table_sequence'), 'josephcostello', 'Joseph', 'Costello'),
    (NEXTVAL('user_table_sequence'), 'charliecostello', 'Charlie', 'Costello');
    

INSERT INTO product VALUES
    (NEXTVAL('product_sequence'), 'brown rice', '2');


INSERT INTO grocery_list VALUES
    (NEXTVAL('grocery_list_sequence'), '1001', '1001', 'FirstWeek', 'My List for this week.');



    -- CREATE TABLE food_category (
--     food_category_id       SERIAL   PRIMARY KEY  NOT NULL,
--     food_category_name     VARCHAR(30)                                                NOT NULL
-- );

-- CREATE SEQUENCE food_category_sequence START WITH 1001;
    