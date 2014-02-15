CREATE TABLE site (
	id INT UNSIGNED AUTO_INCREMENT NOT NULL,
	title VARCHAR(255) NULL,
	question_type  ENUM('answer', 'versus'),
	question TEXT NOT NULL,
	admin_password VARCHAR(255) NOT NULL,
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

CREATE TABLE picture (
	id INT UNSIGNED AUTO_INCREMENT NOT NULL,
	source_url VARCHAR(255) NULL,
	source_text VARCHAR(255) NULL,
	filename VARCHAR(255) NOT NULL,
	created_at DATETIME NOT NULL,
	removed_at DATETIME NULL,
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE picture_in_site (
	site_id INT UNSIGNED NOT NULL,
	picture_id INT UNSIGNED NOT NULL,
	created_at DATETIME NOT NULL,
	removed_at DATETIME NULL,
	PRIMARY KEY (site_id, picture_Id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE picture_in_site ADD CONSTRAINT picture_in_site_site_id  FOREIGN KEY (site_id) REFERENCES site(id);
ALTER TABLE picture_in_site ADD CONSTRAINT picture_in_site_picture_Id  FOREIGN KEY (picture_Id) REFERENCES picture(id);

CREATE TABLE vote_versus (
	site_id INT UNSIGNED NOT NULL,
	winning_picture_id INT UNSIGNED NOT NULL,
	losing_picture_id INT UNSIGNED NOT NULL,
	ip VARCHAR(255) NOT NULL,
	useragent VARCHAR(255) NOT NULL,
	created_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE vote_versus ADD CONSTRAINT vote_versus_winning_picture_id  FOREIGN KEY (winning_picture_id) REFERENCES picture(id);
ALTER TABLE vote_versus ADD CONSTRAINT vote_versus_losing_picture_id  FOREIGN KEY (losing_picture_id) REFERENCES picture(id);
ALTER TABLE vote_versus ADD CONSTRAINT vote_versus_site_id  FOREIGN KEY (site_id) REFERENCES site(id);

CREATE TABLE vote_answer (
	picture_id INT UNSIGNED NOT NULL,
	question_answer_id INT UNSIGNED NOT NULL,
	ip VARCHAR(255) NOT NULL,
	useragent VARCHAR(255) NOT NULL,
	created_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE vote_answer ADD CONSTRAINT vote_answer_picture_id  FOREIGN KEY (picture_id) REFERENCES picture(id);
ALTER TABLE vote_answer ADD CONSTRAINT vote_answer_question_answer_id  FOREIGN KEY (question_answer_id) REFERENCES question_answer(id);

CREATE TABLE picture_answer_cache (
	picture_id INT UNSIGNED NOT NULL,
	question_answer_id INT UNSIGNED NOT NULL,
	votes_won INT UNSIGNED NOT NULL DEFAULT 0,
	votes_total INT UNSIGNED NOT NULL DEFAULT 0,
	votes_won_percentage FLOAT NOT NULL DEFAULT 0.0,
	PRIMARY KEY(picture_id,question_answer_id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE picture_answer_cache ADD CONSTRAINT picture_answer_cache_picture_id  FOREIGN KEY (picture_id) REFERENCES picture(id);
ALTER TABLE picture_answer_cache ADD CONSTRAINT picture_answer_cache_question_answer_id  FOREIGN KEY (question_answer_id) REFERENCES question_answer(id);



CREATE TABLE picture_versus_cache (
	picture_id INT UNSIGNED NOT NULL,
	site_id INT UNSIGNED NOT NULL,
	votes_won INT UNSIGNED NOT NULL DEFAULT 0,
	votes_total INT UNSIGNED NOT NULL DEFAULT 0,
	votes_won_percentage FLOAT NOT NULL DEFAULT 0.0,
	PRIMARY KEY(picture_id,site_id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE picture_versus_cache ADD CONSTRAINT picture_versus_cache_picture_id  FOREIGN KEY (picture_id) REFERENCES picture(id);
ALTER TABLE picture_versus_cache ADD CONSTRAINT picture_versus_cache_site_id  FOREIGN KEY (site_id) REFERENCES site(id);




