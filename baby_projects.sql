CREATE TABLE IF NOT EXISTS `baby_projects` (
  `project_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `data` longtext NOT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
