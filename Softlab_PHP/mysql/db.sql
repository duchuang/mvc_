drop database if exists softlab;
create database softlab character set utf8;
	use softlab;
	/*
	user   is_admin = 1 管理员;2 用户
	*/
	drop table if exists user;
	create table user (
		user_id int unsigned auto_increment primary key,
		username varchar(30) not null,
		password varchar(50) not null,
		email varchar(50) not null,
		is_admin int(10) not null
		);

	/*
	person_message
	*/
	drop table if exists person_message;
	create table person_message (
		person_id int unsigned auto_increment primary key,
		user_id int(30) not null,
		-- is_admin int(10) not null,
		name varchar(20) not null,
		specialty varchar(20) not null,
		email varchar(30) not null
		);

	/*album*/
	drop table if exists album;
	create table album (
		album_id int unsigned auto_increment primary key,
		user_id int(30) not null,
		album_name varchar(20) not null,
		album_time varchar(20) not null,
		album_type int(4) not null);

	/*user forum*/
	drop table if exists forum;
	create table forum (
		forum_id int unsigned auto_increment primary key,
		user_id int(30) not null,
		forum_title varchar(100) not null,
		forum_content varchar(10000) not null,
		forum_time datetime not null,
		forum_count int(30) not null
		);

	/*news*/
	drop table if exists news;
	create table news (
		news_id int unsigned auto_increment primary key,
		user_id int(30) not null,
		news_class varchar(30) not null,
		news_title varchar(100) not null,
		news_summary varchar(200) not null,
		news_picture varchar(50) not null,
		news_content varchar(10000) not null,
		news_time datetime not null
		);

