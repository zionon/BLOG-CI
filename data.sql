drop table if exists ci_cp936;
create table ci_cp936
(
	id int(11) not null auto_increment comment 'Id',
	cjk char(4) collate utf8_unicode_ci not null default '',
	primary key (id)
)engine=InnoDB default charset=utf8 collate=utf8_unicode_ci comment 'GBK映射表';