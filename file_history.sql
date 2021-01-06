CREATE TABLE `file_history` (
  `file_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(5) NOT NULL,
  `file_size` varchar(10) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Created, 2-Deleted',
  `created_at` timestamp NULL,
  `updatd_at` timestamp NULL
) ENGINE='InnoDB' COLLATE 'utf8mb4_unicode_ci';