
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

---date 03-05-2024
CREATE TABLE `lead_categories` (`id` INT(11) NOT NULL AUTO_INCREMENT , `language_id` INT(11) NOT NULL , `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `status` TINYINT(3) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `lead_categories` ADD `slug` VARCHAR(255) NULL DEFAULT NULL AFTER `name`;

CREATE TABLE `leadership` (`id` INT(11) NOT NULL AUTO_INCREMENT , `language_id` INT(11) NOT NULL , `category_id` INT(11) NOT NULL , `name` VARCHAR(255) NULL DEFAULT NULL , `post` VARCHAR(255) NULL DEFAULT NULL , `status` TINYINT(3) NULL DEFAULT NULL , `image` VARCHAR(255) NULL DEFAULT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
---date 06-05-2024

CREATE TABLE `e_governance` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinytext NOT NULL DEFAULT '1',
  `deleted_at` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `e_governance` ADD PRIMARY KEY (`id`);

ALTER TABLE `e_governance` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `e_governance` CHANGE `language_id` `language_id` INT(11) NULL DEFAULT NULL;

CREATE TABLE `tender_category` (`id` INT NOT NULL , `name` VARCHAR(255) NULL DEFAULT NULL , `name_mr` VARCHAR(255) NULL DEFAULT NULL , `status` INT NOT NULL DEFAULT '0' , `deleted_at` TIMESTAMP NULL DEFAULT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB;


CREATE TABLE `tenders` (`id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) NULL DEFAULT NULL , `title_mr` VARCHAR(255) NULL DEFAULT NULL , `description` LONGTEXT NULL DEFAULT NULL , `description_mr` LONGTEXT NULL DEFAULT NULL , `deadline` VARCHAR(255) NULL DEFAULT NULL , `tender_link` TEXT NULL DEFAULT NULL , `files` TEXT NULL DEFAULT NULL , `tender_category` INT(11) NULL DEFAULT NULL , `status` INT(11) NULL DEFAULT '0' , `delete_at` TIMESTAMP NULL DEFAULT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;

