ALTER TABLE `categories` ADD `sort` INT UNSIGNED NOT NULL AFTER `parent` ;
ALTER TABLE `categories` ADD `group` INT UNSIGNED NOT NULL AFTER `sort` ;
