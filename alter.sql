
-- Date:24/04/2024 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'package-background', 'admin', 'home_page_section_management', '1', '0', '2024-04-19 14:45:26', '2024-04-19 14:45:26'); 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'contact', 'admin', 'contact', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27'); 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'audit-trail', 'admin', 'audit_trail', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27'); 

-- Date: 25/04/2024
ALTER TABLE `basic_settings` ADD `website_heading` TEXT NULL DEFAULT NULL AFTER `logo`;

---date 26/05/2024
CREATE TABLE `alink` (`id` BIGINT(20) NOT NULL , `language_id` INT(11) NOT NULL DEFAULT '0' , `name` VARCHAR(255) NULL DEFAULT NULL , `url` VARCHAR(255) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `dlink` (`id` BIGINT(11) NOT NULL , `language_id` INT(11) NOT NULL DEFAULT '0' , `name` VARCHAR(255) NULL DEFAULT NULL , `url` VARCHAR(255) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'about-us-links', 'admin', 'footer_management', '1', '0', '2024-04-19 14:45:26', '2024-04-19 14:45:26'); 

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'department-links', 'admin', 'footer_management', '1', '0', '2024-04-19 14:45:26', '2024-04-19 14:45:26'); 

ALTER TABLE `calendar_events` CHANGE `start_date` `date` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

ALTER TABLE `calendar_events` ADD `created_by` INT NULL DEFAULT NULL AFTER `language_id`;

ALTER TABLE `calendar_events` ADD `image` VARCHAR(255) NULL DEFAULT NULL AFTER `created_by`;

RENAME TABLE `calendar_events` TO `news`;

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


CREATE TABLE `tenders` (`id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) NULL DEFAULT NULL , `title_mr` VARCHAR(255) NULL DEFAULT NULL , `description` LONGTEXT NULL DEFAULT NULL , `description_mr` LONGTEXT NULL DEFAULT NULL , `deadline` VARCHAR(255) NULL DEFAULT NULL , `tender_link` TEXT NULL DEFAULT NULL , `files` TEXT NULL DEFAULT NULL , `tender_category` INT(11) NULL DEFAULT NULL , `status` INT(11) NULL DEFAULT '0' , `deleted_at` TIMESTAMP NULL DEFAULT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `tender_category` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);


INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'categories-tender', 'admin', 'tenders', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'tenders', 'admin', 'tenders', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'categories-document', 'admin', 'documents', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'documents', 'admin', 'documents', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'e-governance', 'admin', 'e-governance', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27');

CREATE TABLE `document_categories` (`id` INT NOT NULL AUTO_INCREMENT , `language_id` INT NULL DEFAULT NULL , `name` VARCHAR(255) NULL DEFAULT NULL , `status` INT NOT NULL DEFAULT '0' , `deleted_at` TIMESTAMP NULL DEFAULT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `documents` (`id` INT NOT NULL AUTO_INCREMENT , `language_id` INT NULL DEFAULT NULL , `document_category_id` INT NULL DEFAULT NULL , `name` VARCHAR(255) NULL DEFAULT NULL , `status` INT NULL DEFAULT '0' , `deleted_at` TIMESTAMP NULL DEFAULT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `document_categories` ADD `name_mr` VARCHAR(255) NULL DEFAULT NULL AFTER `name`;
ALTER TABLE `document_categories` ADD `slug` VARCHAR(250) NULL DEFAULT NULL AFTER `name_mr`;
ALTER TABLE `documents` ADD `files` VARCHAR(255) NULL DEFAULT NULL AFTER `status`;
ALTER TABLE `documents` ADD `name_mr` VARCHAR(255) NULL DEFAULT NULL AFTER `name`;
--07-05-2024
ALTER TABLE `features` ADD `total_numbers` FLOAT NULL DEFAULT NULL AFTER `serial_number`;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'categories-leadership', 'admin', 'leadership', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'leadership', 'admin', 'leadership', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27');
ALTER TABLE `basic_settings` ADD `intro_section_subtitle` VARCHAR(255) NULL DEFAULT NULL AFTER `intro_section_title`;
ALTER TABLE `basic_settings` CHANGE `intro_section_text` `intro_section_text` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `basic_settings` ADD `our_services_desc` TEXT NULL DEFAULT NULL AFTER `service_section_title`;
CREATE TABLE `contact_query` (`id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NULL DEFAULT NULL , `phone` VARCHAR(90) NULL DEFAULT NULL , `email` VARCHAR(255) NULL DEFAULT NULL , `message` LONGTEXT NULL DEFAULT NULL , `status` INT(3) NULL DEFAULT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- date---9/05/2024
CREATE TABLE `history` (`id` INT(11) NULL AUTO_INCREMENT , `language_id` INT(11) NULL DEFAULT NULL , `image` VARCHAR(255) NOT NULL , `years` VARCHAR(255) NOT NULL , `title` VARCHAR(255) NOT NULL , `description` VARCHAR(255) NOT NULL , `status` INT(11) NOT NULL DEFAULT '0' , `deleted_at` TIMESTAMP NULL DEFAULT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- date 13/05/2024

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'history', 'admin', 'history', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27');
---date ----13-05-2024
ALTER TABLE `members` ADD `url` VARCHAR(255) NULL DEFAULT NULL AFTER `image`;

ALTER TABLE `history` CHANGE `description` `description` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
ALTER TABLE `basic_settings_extra` ADD `url` VARCHAR(255) NULL DEFAULT NULL AFTER `contact_mails`;

---date ----14-05-2024
CREATE TABLE `profit_chart` (`id` INT NOT NULL AUTO_INCREMENT , `label` VARCHAR(250) NULL DEFAULT NULL , `amount` VARCHAR(250) NOT NULL DEFAULT '0' , `deleted_at` TIMESTAMP NULL DEFAULT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `members` ADD `serial_number` INT(11) NULL DEFAULT NULL AFTER `url`;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'profit-budget-chart', 'admin', 'profit-budget-chart', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27');

-- date 15/05/2024
ALTER TABLE `e_governance` ADD `url` VARCHAR(255) NULL DEFAULT NULL AFTER `title`;

CREATE TABLE `water_teriff` (`id` INT NOT NULL AUTO_INCREMENT , `institution` VARCHAR(255) NULL DEFAULT NULL , `water_tariff` VARCHAR(255) NULL DEFAULT NULL , `tariff_date` DATE NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `water_teriff` ADD `language_id` INT NULL DEFAULT NULL AFTER `id`;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'water-teriff-charges', 'admin', 'water-teriff-charges', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27');
---date 16/05/2024
ALTER TABLE `water_teriff` CHANGE `tariff_date` `tariff_date` DATE NULL DEFAULT NULL;
CREATE TABLE `date_table` (`id` INT(11) NOT NULL AUTO_INCREMENT , `tdate` DATE NULL DEFAULT NULL , `status` TINYINT(4) NULL DEFAULT '0' , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `galleries` CHANGE `language_id` `language_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `gallery_categories` ADD `name_mr` VARCHAR(255) NULL DEFAULT NULL AFTER `name`;
ALTER TABLE `gallery_categories` CHANGE `language_id` `language_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;

---date 17-05-2024
ALTER TABLE `lead_categories` ADD `name_mr` VARCHAR(255) NULL DEFAULT NULL AFTER `name`;
ALTER TABLE `lead_categories` CHANGE `language_id` `language_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `leadership` ADD `name_mr` VARCHAR(255) NULL DEFAULT NULL AFTER `name`;
ALTER TABLE `leadership` ADD `post_mr` VARCHAR(255) NULL DEFAULT NULL AFTER `post`;
ALTER TABLE `leadership` CHANGE `language_id` `language_id` INT(11) NULL DEFAULT NULL;

---date 21-05-2024
ALTER TABLE `news` ADD `url` TEXT NULL DEFAULT NULL AFTER `title`;


                                                                                                                               
                                                                                                                              