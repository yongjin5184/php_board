drop database ci_book;
show databases;
create database board_db;
use board_db;
show databases;
drop table board_comment;
drop table board;
drop table users;
drop table users_picture;

CREATE TABLE `users` (
    users_id VARCHAR(50) NOT NULL,
    users_password VARCHAR(50) NOT NULL,
    users_name VARCHAR(50) NOT NULL,
    users_email VARCHAR(50) NULL,
    users_level enum('A','N') NOT NULL DEFAULT 'N',
    users_reg_date DATETIME NOT NULL,
    PRIMARY KEY (users_id)
)engine=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `board`(
	 board_id INT AUTO_INCREMENT NOT NULL,
     users_id varchar(50) NOT NULL,
     board_user_name VARCHAR(20) NOT NULL,
     board_subject VARCHAR(50) NOT NULL,
     board_contents TEXT NOT NULL,
     board_hits INT NOT NULL,
     board_reg_date DATETIME NOT NULL,
     board_is_del ENUM('Y','N') NOT NULL DEFAULT 'N',
     board_password VARCHAR(20), 
     PRIMARY KEY (board_id),
     foreign key (users_id) references users(users_id)
)engine=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `board_comment` (
	bc_id INT AUTO_INCREMENT NOT NULL,
    board_id INT NOT NULL,
    bc_user_id VARCHAR(20) NOT NULL,
    bc_contents TEXT NOT NULL,
    bc_reg_date DATETIME NOT NULL,
    PRIMARY KEY (bc_id),
    FOREIGN KEY (board_id) REFERENCES board(board_id) 
)engine=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sessions` (
	session_id varchar(40) DEFAULT '0' NOT NULL,
    ip_address varchar(16) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int DEFAULT '0' NOT NULL,
    user_data text NOT NULL,
    PRIMARY KEY (id)
)engine=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users_picture`(
	user_pic_id INT AUTO_INCREMENT NOT NULL,
    board_id INT NOT NULL,
    user_pic_subject VARCHAR(20) NOT NULL,
    user_pic_path VARCHAR(100) NOT NULL,
	user_pic_date DATETIME NOT NULL,
    user_pic_is_del ENUM('Y','N') NOT NULL DEFAULT 'N',
    PRIMARY KEY(user_pic_id),
    FOREIGN KEY(board_id) REFERENCES board(board_id)
)engine=InnoDB CHARSET=utf8;

INSERT INTO board (board_user_name, users_id, board_subject, board_contents, board_hits, board_reg_date, board_is_del, board_password) values ('김용진', 'asdf','안녕하세요', '자기소개입니다.', 0, '2012-12-22', 'N', '');
select * from board;
INSERT INTO board_comment (board_id, bc_user_id, bc_contents, bc_reg_date) value (2, 'kim' ,'첫 번째 댓글입니다.', '2014-05-10');
SELECT * FROM board_comment;
select * from sessions;
select * from users;
select * from users_picture;
insert into users (users_id, users_password, users_name, users_emaiL, users_reg_date) values ('asdf', 'asdf', '김용진', 'yongjin5184@naver.com', now());
insert into users (users_id, users_password, users_name, users_emaiL, users_reg_date) values ('qwer', 'qwer', '아이유', 'iu@naver.com', now());
SELECT * FROM board_comment as bc join board as b on bc.board_id = b.board_id WHERE bc.board_id=1 order by bc.board_id desc;