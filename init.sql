DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts;


CREATE TABLE posts (
	id SERIAL,
	nickname VARCHAR(128) NOT NULL,
	content TEXT NOT NULL,
	timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE INDEX idx_posts_nickname ON posts (nickname);
CREATE INDEX idx_posts_timestamp ON posts (timestamp);

CREATE TABLE comments (
	id SERIAL,
	nickname VARCHAR(128) NOT NULL,
	content TEXT NOT NULL,
	timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	post_id INTEGER,
	PRIMARY KEY (id),
	FOREIGN KEY (post_id) REFERENCES posts (id)
);

CREATE INDEX idx_comments_nickname ON comments (nickname);
CREATE INDEX idx_comments_timestamp ON comments (timestamp);
