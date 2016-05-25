/*
CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_firstname` varchar(255) NOT NULL,
`user_lastname` varchar(255) NOT NULL,
`user_email` varchar(255) NOT NULL,
`user_password` varchar(255) NOT NULL,
PRIMARY KEY (`id`)
) 
*/

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `user_firstname` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,  
  `user_role` varchar(10) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_lastlogin` varchar(100) NOT NULL,
  `user_status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `track_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL,
  `content` varchar(128) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
INSERT INTO `codeigniter`.`users`
(`username`,`password`,`is_admin`)
VALUES('admin','d033e22ae348aeb5660fc2140aec35850c4da997','1');
*/
INSERT INTO `users`
(`user_email`, `user_firstname`, `user_lastname`, `user_role`, `user_password`,`user_status`)
VALUES('superadmin@admin.com', 'superadmin', '00', 'admin', 'sha256:1000:eTwSGZDXvrFQ8AJjRMxZKeA7F+ISaDuB:hzohLM260ZJ227scG8TNpi85c2Lio+Pj','approved');
