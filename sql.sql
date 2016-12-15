CREATE TABLE `category` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` longtext,
 `user_id` longtext,
 `tasks_num` longtext,
 `num` longtext,
 PRIMARY KEY (`id`)
)
CREATE TABLE `files` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `size` longtext,
 `name` longtext,
 `user_id` longtext,
 `type` longtext,
 `date` longtext,
 `hour` longtext,
 PRIMARY KEY (`id`)
)
CREATE TABLE `task` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `task` longtext,
 `hour` varchar(11),
 `date` varchar(11),
 `user` longtext,
 `status` longtext,
 `category` longtext,
 `ip` longtext,
 `num` longtext,
 PRIMARY KEY (`id`)
)
CREATE TABLE `items` (
`id` INT NOT NULL AUTO_INCREMENT,
`name` longtext,
`shop` longtext,
`date` longtext,
`user_id` longtext,
PRIMARY KEY(`id`)
)
CREATE TABLE `users` (
`id` INT NOT NULL AUTO_INCREMENT,
`user_id` VARCHAR(20),
`username` longtext,
`password` longtext,
`access` longtext,
PRIMARY KEY(`id`)
)
