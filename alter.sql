
-- Date:24/04/2024 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'package-background', 'admin', 'home_page_section_management', '1', '0', '2024-04-19 14:45:26', '2024-04-19 14:45:26'); 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'contact', 'admin', 'contact', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27'); 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'audit-trail', 'admin', 'audit_trail', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27'); 
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `status`, `basic`, `created_at`, `updated_at`) VALUES (NULL, 'announcement-popup', 'admin', 'announcement_popup', '1', '0', '2024-04-19 14:45:27', '2024-04-19 14:45:27'); 
-- Date: 25/04/2024
ALTER TABLE `basic_settings` CHANGE `website_heading` `website_heading` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;