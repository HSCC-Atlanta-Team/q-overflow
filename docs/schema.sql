DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
	`user_id` INT(11) NOT NULL,
	`username` VARCHAR(64) NOT NULL,
	`salt` VARCHAR(64),
	`email` VARCHAR(255),
	`points` INT(11) DEFAULT 0,
	PRIMARY KEY (`username`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `question`;

CREATE TABLE `question` (
	`question_id` VARCHAR(64) NOT NULL,
	`creator` VARCHAR(64) NOT NULL,
	`createdAt` INT(11) NOT NULL,
	`status` VARCHAR(32),
	`title` VARCHAR(255),
	`text` TEXT,
	`views` INT(11) DEFAULT 0,
	`answers` INT(11) DEFAULT 0,
	`comments` INT(11) DEFAULT 0,
	`upvotes` INT(11) DEFAULT 0,
	`downvotes` INT(11) DEFAULT 0,
	`hasAcceptedAnswer` TINYINT(1) DEFAULT 0,
	PRIMARY KEY (`question_id`)
) ENGINE=InnoDB;
