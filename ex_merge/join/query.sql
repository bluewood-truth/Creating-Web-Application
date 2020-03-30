CREATE TABLE `userinfo`(
    `id` int(11) not null auto_increment,
    `user_id` varchar(20) not null,
	`nickname` varchar(20) not null,
	`password` varchar(40) not null,
	`email` varchar(40) not null,
    `phone_number` varchar(13),
    `mobile_number` varchar(13) not null,
    `comment` text,
	`join_date` datetime not null,
    primary key(id)
) engine = innodb default charset=utf8;
