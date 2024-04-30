
-- Date:24/04/2024 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'package-background', 'admin', 'home_page_section_management', '1', '0', '2024-04-19 14:45:26', '2024-04-19 14:45:26'); 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'contact', 'admin', 'contact', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27'); 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'audit-trail', 'admin', 'audit_trail', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27'); 

-- Date: 25/04/2024
ALTER TABLE `basic_settings` ADD `website_heading` TEXT NULL DEFAULT NULL AFTER `logo`;

---date 26/05/2024
CREATE TABLE `stmp_cms`.`alink` (`id` BIGINT(20) NOT NULL , `language_id` INT(11) NOT NULL DEFAULT '0' , `name` VARCHAR(255) NULL DEFAULT NULL , `url` VARCHAR(255) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `stmp_cms`.`dlink` (`id` BIGINT(11) NOT NULL , `language_id` INT(11) NOT NULL DEFAULT '0' , `name` VARCHAR(255) NULL DEFAULT NULL , `url` VARCHAR(255) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'about-us-links', 'admin', 'footer_management', '1', '0', '2024-04-19 14:45:26', '2024-04-19 14:45:26'); 

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'department-links', 'admin', 'footer_management', '1', '0', '2024-04-19 14:45:26', '2024-04-19 14:45:26'); 

ALTER TABLE `calendar_events` CHANGE `start_date` `date` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

ALTER TABLE `calendar_events` ADD `created_by` INT NULL DEFAULT NULL AFTER `language_id`;

ALTER TABLE `calendar_events` ADD `image` VARCHAR(255) NULL DEFAULT NULL AFTER `created_by`;

RENAME TABLE `calendar_events` TO `stmp_cms`.`news`;

ALTER TABLE news DROP COLUMN end_date; 
---date 26-05-2024
ALTER TABLE `basic_settings` ADD `header_logo` VARCHAR(50) NULL DEFAULT NULL AFTER `logo`;

---date 29-05-2024
ALTER TABLE `partners` ADD `title` VARCHAR(255) NULL DEFAULT NULL AFTER `url`;

ALTER TABLE `gallery_categories` ADD `slug` VARCHAR(255) NOT NULL AFTER `name`;
