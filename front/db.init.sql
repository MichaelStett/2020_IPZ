-- Copy&Paste into PhpMyAdmin
DROP DATABASE IF EXISTS project_alpha;

CREATE DATABASE project_alpha;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `users` (`id`, `name`, `password`, `created`, `modified`) VALUES
(1, 'Michal Tymejczyk', 'test', '2020-12-03 00:00:00', '2020-12-03 01:00:00'),
(2, 'Marcin Jedrzejowski', 'test', '2020-12-03 01:00:00', '2020-12-03 02:00:00'),
(3, 'Olga Kruszyna', 'test', '2020-12-03 02:00:00', '2020-12-03 03:00:00');
