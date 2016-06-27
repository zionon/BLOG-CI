drop database if exists blog_ci;
create database blog_ci;
use blog_ci;
set names utf8;

drop table if exists ci_post;
create table ci_post
(
	id int(11) not null auto_increment comment 'Id',
	title varchar(128) collate utf8_unicode_ci not null comment '日志名称',
	content text collate utf8_unicode_ci not null comment '内容',
	create_time int(11) default null comment '添加时间',
	update_time int(11) default null comment '最后一次修改时间',
	author_id int(11) not null comment '作者id',
	primary key (id),
	key `FK_post_author` (`author_id`),
	constraint `FK_post_author` foreign key (`author_id`) references `ci_user` (`id`) on delete cascade
)engine=InnoDB default charset=utf8 collate=utf8_unicode_ci comment '日志';

drop table if exists ci_user
create table ci_user
(
	id int(11) not null auto_increment comment 'Id',
	username varchar(128) collate utf8_unicode_ci not null comment '用户名',
	password varchar(128) collate utf8_unicode_ci not null comment '密码',
	email varchar(128) collate utf8_unicode_ci not null comment '注册邮箱',
	primary key (id) 
)engine=InnoDB default charset=utf8 collate=utf8_unicode_ci comment '用户表';

drop table if exists ci_lookup
create table ci_lookup
(
	id int(11) not null auto_increment comment 'Id',
	name varchar(128) collate utf8_unicode_ci not null comment '状态名字',
	code int(11) not null,
	primary key (id)
)engine=InnoDB default charset=utf8 collate=utf8_unicode_ci comment '评论以及日志状态表';

drop table if exists ci_tag
create table ci_tag
(
	id int(11) not null auto_increment comment 'Id',
	name varchar(128) collate utf8_unicode_ci not null comment '标签名字',
	frequency int(11) default '1' comment '标签点击次数',
	primary key (id)
)engine=InnoDB default charset=utf8 collate=utf8_unicode_ci comment '标签表';

drop table if exists ci_comment
create table ci_comment
(
	id int(11) not null auto_increment comment 'Id',
	content text collate utf8_unicode_ci not null comment '评论内容',
	status int(11) not null,
	create_time int(11) default null comment '评论时间',
	author varchar(128) collate utf8_unicode_ci not null comment '评论昵称',
	email varchar(128) collate utf8_unicode_ci not null comment '邮箱',
	post_id int(11) not null,
	primary key (id)
)engine=InnoDB default charset=utf8 collate=utf8_unicode_ci comment '评论表';









