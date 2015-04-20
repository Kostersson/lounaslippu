CREATE TABLE `users` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NULL DEFAULT '0',
	`email` VARCHAR(50) NULL DEFAULT '0',
	`password` VARCHAR(123) NULL DEFAULT '0',
	`created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`modified` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `email` (`email`)
)
ENGINE=InnoDB
;

CREATE TABLE `roles` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
;

CREATE TABLE `permissions` (
	`role_id` INT(11) NOT NULL,
	`update_self_data` ENUM('TRUE','FALSE') NOT NULL DEFAULT 'FALSE',
	`update_tickets` ENUM('TRUE','FALSE') NOT NULL DEFAULT 'FALSE',
	`update_payments` ENUM('TRUE','FALSE') NOT NULL DEFAULT 'FALSE',
	`read_log` ENUM('TRUE','FALSE') NOT NULL DEFAULT 'FALSE',
	`update_users` ENUM('TRUE','FALSE') NOT NULL DEFAULT 'FALSE',
	PRIMARY KEY (`role_id`),
	CONSTRAINT `permissions_to_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
ENGINE=InnoDB
;

CREATE TABLE `user_roles` (
	`user_id` INT(11) NOT NULL,
	`role_id` INT(11) NOT NULL,
	PRIMARY KEY (`user_id`, `role_id`),
	INDEX `user_roles_to_roles` (`role_id`),
	CONSTRAINT `user_roles_to_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT `user_roles_to_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
ENGINE=InnoDB
;

CREATE TABLE `invoice` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`reference_number` BIGINT(20) NOT NULL DEFAULT '0',
	`amount` DECIMAL(3,2) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `reference_number` (`reference_number`)
)
ENGINE=InnoDB
;

CREATE TABLE `payment` (
	`archiving_code` VARCHAR(255) NOT NULL,
	`reference_number` BIGINT(20) NOT NULL,
	`amount` DECIMAL(3,2) NOT NULL,
	`recording_date` DATE NOT NULL,
	PRIMARY KEY (`archiving_code`),
	INDEX `payment_to_invoice` (`reference_number`),
	CONSTRAINT `payment_to_invoice` FOREIGN KEY (`reference_number`) REFERENCES `invoice` (`reference_number`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
ENGINE=InnoDB
;

CREATE TABLE `ticket` (
	`id` BIGINT(20) NOT NULL,
	`user_id` INT(11) NOT NULL,
	`invoice_id` INT(11) NOT NULL,
	`used` ENUM('TRUE','FALSE') NOT NULL DEFAULT 'FALSE',
	`void` ENUM('TRUE','FALSE') NOT NULL DEFAULT 'FALSE',
	PRIMARY KEY (`id`),
	INDEX `ticket_to_user` (`user_id`),
	INDEX `ticket_to_invoice` (`invoice_id`),
	CONSTRAINT `ticket_to_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT `ticket_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
ENGINE=InnoDB
;

CREATE TABLE `ticket_import` (
	`ticket_id` BIGINT(20) NOT NULL,
	`import_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`used_date` DATE NOT NULL,
	`recorded_by` INT(11) NOT NULL,
	PRIMARY KEY (`ticket_id`),
	INDEX `ticket_import_to_users` (`recorded_by`),
	CONSTRAINT `ticket_import_to_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `ticket_import_to_users` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
ENGINE=InnoDB
;

CREATE TABLE `log` (
	`id` BIGINT(20) NOT NULL,
	`user_id` INT(11) NOT NULL,
	`action_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`action` TEXT NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `log_to_user` (`user_id`),
	CONSTRAINT `log_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
ENGINE=InnoDB
;