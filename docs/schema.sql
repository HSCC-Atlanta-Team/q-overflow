DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
	`user_id` INT(11) NOT NULL,
	`username` VARCHAR(64) NOT NULL,
	`salt` VARCHAR(64),
	`email` VARCHAR(255),
	`points` INT(11) DEFAULT 0,
	PRIMARY KEY (`username`)
) ENGINE=InnoDB;

