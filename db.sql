create database db_chat;
use db_chat

--表：用户、话题、评论、点赞
create table users (
    uid varchar(20) primary key,
    pwd varchar(200) not null,
    face varchar(100) not null,
    nickname varchar(20)
);
create table chat(
    id int auto_increment primary key,
    title varchar(200) not null,
    content text,
    pubtime datetime,
    uid varchar(20) references users(uid)
);
create table comment(
    id int auto_increment primary key,
    comment text,
    comtime datetime,
    uid varchar(20) references users(uid),
    chatid varchar(20) references users(uid)
);
create table dianzan(
    uid varchar(20) references users(uid),
    chatid int references chat(id),
    dztime datetime,
    primary key(uid, chatid)
);
