CREATE TABLE `EnglishDom`.`comments` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`email` VARCHAR(255) NOT NULL,
	`comment` TEXT NOT NULL);

ALTER TABLE `EnglishDom`.`comments` 
	ADD COLUMN `created` TIMESTAMP NOT NULL
		DEFAULT CURRENT_TIMESTAMP AFTER `comment`;

CREATE TABLE `EnglishDom`.`observers` (
	`id` INT NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`data` TEXT NOT NULL,
	PRIMARY KEY (`id`, `name`));
