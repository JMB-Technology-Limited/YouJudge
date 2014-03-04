CREATE TABLE site (
	id INT UNSIGNED AUTO_INCREMENT NOT NULL,
	title VARCHAR(255) NULL,
	question_type  ENUM('answer', 'versus'),
	question TEXT NOT NULL,
	admin_password VARCHAR(255) NOT NULL,
	api_password VARCHAR(255) NOT NULL,
	created_at DATETIME NOT NULL,
	removed_at DATETIME NULL,
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE question_answer (
	id INT UNSIGNED AUTO_INCREMENT NOT NULL,
	site_id INT UNSIGNED NOT NULL,
	answer_index INT UNSIGNED NOT NULL,
	answer VARCHAR(255) NOT NULL,
	created_at DATETIME NOT NULL,
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE UNIQUE INDEX question_answer_idx ON question_answer (site_id,answer_index);
ALTER TABLE question_answer ADD CONSTRAINT question_answer_site_id  FOREIGN KEY (site_id) REFERENCES site(id);

CREATE TABLE item (
	id INT UNSIGNED AUTO_INCREMENT NOT NULL,
	source_url VARCHAR(255) NULL,
	source_text VARCHAR(255) NULL,
	filename VARCHAR(255) NOT NULL,
	created_at DATETIME NOT NULL,
	removed_at DATETIME NULL,
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE item_in_site (
	site_id INT UNSIGNED NOT NULL,
	item_id INT UNSIGNED NOT NULL,
	created_at DATETIME NOT NULL,
	removed_at DATETIME NULL,
	PRIMARY KEY (site_id, item_Id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE item_in_site ADD CONSTRAINT item_in_site_site_id  FOREIGN KEY (site_id) REFERENCES site(id);
ALTER TABLE item_in_site ADD CONSTRAINT item_in_site_item_Id  FOREIGN KEY (item_Id) REFERENCES item(id);

CREATE TABLE vote_versus (
	site_id INT UNSIGNED NOT NULL,
	winning_item_id INT UNSIGNED NOT NULL,
	losing_item_id INT UNSIGNED NOT NULL,
	ip VARCHAR(255) NOT NULL,
	useragent VARCHAR(255) NOT NULL,
	created_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE vote_versus ADD CONSTRAINT vote_versus_winning_item_id  FOREIGN KEY (winning_item_id) REFERENCES item(id);
ALTER TABLE vote_versus ADD CONSTRAINT vote_versus_losing_item_id  FOREIGN KEY (losing_item_id) REFERENCES item(id);
ALTER TABLE vote_versus ADD CONSTRAINT vote_versus_site_id  FOREIGN KEY (site_id) REFERENCES site(id);

CREATE TABLE vote_answer (
	item_id INT UNSIGNED NOT NULL,
	question_answer_id INT UNSIGNED NOT NULL,
	ip VARCHAR(255) NOT NULL,
	useragent VARCHAR(255) NOT NULL,
	created_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE vote_answer ADD CONSTRAINT vote_answer_item_id  FOREIGN KEY (item_id) REFERENCES item(id);
ALTER TABLE vote_answer ADD CONSTRAINT vote_answer_question_answer_id  FOREIGN KEY (question_answer_id) REFERENCES question_answer(id);

CREATE TABLE item_answer_cache (
	item_id INT UNSIGNED NOT NULL,
	question_answer_id INT UNSIGNED NOT NULL,
	votes_won INT UNSIGNED NOT NULL DEFAULT 0,
	votes_total INT UNSIGNED NOT NULL DEFAULT 0,
	votes_won_percentage FLOAT NOT NULL DEFAULT 0.0,
	PRIMARY KEY(item_id,question_answer_id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE item_answer_cache ADD CONSTRAINT item_answer_cache_item_id  FOREIGN KEY (item_id) REFERENCES item(id);
ALTER TABLE item_answer_cache ADD CONSTRAINT item_answer_cache_question_answer_id  FOREIGN KEY (question_answer_id) REFERENCES question_answer(id);



CREATE TABLE item_versus_cache (
	item_id INT UNSIGNED NOT NULL,
	site_id INT UNSIGNED NOT NULL,
	votes_won INT UNSIGNED NOT NULL DEFAULT 0,
	votes_total INT UNSIGNED NOT NULL DEFAULT 0,
	votes_won_percentage FLOAT NOT NULL DEFAULT 0.0,
	PRIMARY KEY(item_id,site_id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE item_versus_cache ADD CONSTRAINT item_versus_cache_item_id  FOREIGN KEY (item_id) REFERENCES item(id);
ALTER TABLE item_versus_cache ADD CONSTRAINT item_versus_cache_site_id  FOREIGN KEY (site_id) REFERENCES site(id);




