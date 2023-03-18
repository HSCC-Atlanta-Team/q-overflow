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

DROP TABLE IF EXISTS `answer`;

CREATE TABLE `answer` (
	`answer_id` VARCHAR(64) NOT NULL,
	`creator` VARCHAR(64) NOT NULL,
	`createdAt` INT(11) NOT NULL,
	`text` TEXT,
	`upvotes` INT(11) DEFAULT '0',
	`downvotes` INT(11) DEFAULT '0',
	`accepted` TINYINT(1) DEFAULT '0',
	PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
	`comment_id` VARCHAR(64) NOT NULL,
	`creator` VARCHAR(64) NOT NULL,
	`createdAt` INT(11) NOT NULL,
	`text` TEXT,
	`upvotes` INT(11) DEFAULT '0',
	`downvotes` INT(11) DEFAULT '0'
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `mail`;

CREATE TABLE `mail` (
	`mail_id` VARCHAR(64) NOT NULL,
	`sender` VARCHAR(64) NOT NULL,
	`reciever` VARCHAR(64) NOT NULL,
	`createdAT` INT(11) NOT NULL,
	`subject` TEXT,
	`text` TEXT
) ENGINE=InnoDB;