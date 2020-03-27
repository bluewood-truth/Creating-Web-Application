CREATE TABLE `guestbook`(
`id` int(11) not null auto_increment,
	`nickname` varchar(15) not null,
	`password` varchar(40) not null,
	`content` text not null,
	`datetime` datetime not null,
    primary key(id)
) engine = innodb default charset=utf8;
