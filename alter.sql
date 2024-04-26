
-- Date:24/04/2024 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'package-background', 'admin', 'home_page_section_management', '1', '0', '2024-04-19 14:45:26', '2024-04-19 14:45:26'); 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'contact', 'admin', 'contact', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27'); 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'audit-trail', 'admin', 'audit_trail', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27'); 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'announcement-popup', 'admin', 'announcement_popup', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27'); 
---date 26/05/2024
CREATE TABLE `stmp_cms`.`alink` (`id` BIGINT(20) NOT NULL , `language_id` INT(11) NOT NULL DEFAULT '0' , `name` VARCHAR(255) NULL DEFAULT NULL , `url` VARCHAR(255) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `stmp_cms`.`dlink` (`id` BIGINT(11) NOT NULL , `language_id` INT(11) NOT NULL DEFAULT '0' , `name` VARCHAR(255) NULL DEFAULT NULL , `url` VARCHAR(255) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'about-us-links', 'admin', 'footer_management', '1', '0', '2024-04-19 14:45:26', '2024-04-19 14:45:26'); 

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'department-links', 'admin', 'footer_management', '1', '0', '2024-04-19 14:45:26', '2024-04-19 14:45:26'); 