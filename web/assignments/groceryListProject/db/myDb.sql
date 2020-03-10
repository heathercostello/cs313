
    
DROP TABLE IF EXISTS grocery_user;
DROP TABLE IF EXISTS list;

CREATE TABLE grocery_user (
	id SERIAL PRIMARY KEY,
	username VARCHAR(25) NOT NULL UNIQUE,
	firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL
);

CREATE TABLE list
(
	id SERIAL PRIMARY KEY,
	grocery_user_id INT NOT NULL REFERENCES grocery_user(id),
	content text NOT NULL
);

INSERT INTO grocery_user(username, firstName, lastName) VALUES ('heatherfeather', 'Heather', 'Costello');
INSERT INTO grocery_user(username, firstName, lastName) VALUES
('mojojoseph', 'Joseph', 'Costello'),
('robynBird', 'Robyn', 'Kleinman');

INSERT INTO list(grocery_user_id, content) VALUES (1, 'milk, eggs, onion');
INSERT INTO list(grocery_user_id, content) VALUES (2, 'nuts, bananas, bread');
INSERT INTO list(grocery_user_id, content) VALUES (3, 'herbal tea, mugs, green onions');

SELECT g.firstName, g.lastName, l.content FROM list l
JOIN grocery_user g ON l.grocery_user_id = g.id
WHERE g.username = 'heatherfeather';