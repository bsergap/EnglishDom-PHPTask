CREATE TABLE `EnglishDom`.`comments` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`email` TINYTEXT NOT NULL,
	`comment` TEXT NOT NULL);

ALTER TABLE `EnglishDom`.`comments` 
	ADD COLUMN `created` TIMESTAMP NOT NULL
		DEFAULT CURRENT_TIMESTAMP AFTER `comment`;

CREATE TABLE `EnglishDom`.`observers` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`name` TINYTEXT NOT NULL,
	`callback` BLOB NOT NULL,
	`priority` TINYINT NOT NULL);
