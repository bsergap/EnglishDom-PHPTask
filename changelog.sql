CREATE TABLE `EnglishDom`.`comments` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`email` TINYTEXT NULL,
	`comment` TEXT NULL);

ALTER TABLE `EnglishDom`.`comments` 
	ADD COLUMN `created` TIMESTAMP NOT NULL
		DEFAULT CURRENT_TIMESTAMP AFTER `comment`;
