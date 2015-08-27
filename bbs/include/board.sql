drop database ci_book;
show databases;
create database board_db;
use board_db;
show databases;
drop table board_comment;
drop table board;
drop table board_picture;
drop table users;

CREATE TABLE `users` (
    users_id VARCHAR(50) NOT NULL,
    users_password VARCHAR(50) NOT NULL,
    users_name VARCHAR(50) NOT NULL,
    users_email VARCHAR(50) NULL,
    users_level enum('A','N') NOT NULL DEFAULT 'N',
    users_profile_path VARCHAR(50) NULL,
    users_reg_date DATETIME NOT NULL,
    PRIMARY KEY (users_id)
)engine=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `board`(
	 board_id INT AUTO_INCREMENT NOT NULL,
     users_id varchar(50) NOT NULL,
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
    bc_users_id VARCHAR(20) NOT NULL,
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

CREATE TABLE IF NOT EXISTS `board_picture`(
	board_pic_id INT AUTO_INCREMENT NOT NULL,
    board_id INT NOT NULL,
    board_pic_subject VARCHAR(20) NOT NULL,
    board_pic_path VARCHAR(100) NOT NULL,
	board_pic_date DATETIME NULL,
    board_pic_is_del ENUM('Y','N') NOT NULL DEFAULT 'N',
    PRIMARY KEY(board_pic_id),
    FOREIGN KEY(board_id) REFERENCES board(board_id)
)engine=InnoDB CHARSET=utf8;

INSERT INTO board (users_id, board_subject, board_contents, board_hits, board_reg_date, board_is_del, board_password) values ('asdf','안녕하세요', '자기소개입니다.', 0, '2012-12-22', 'N', '');
INSERT INTO board (users_id, board_subject, board_contents, board_hits, board_reg_date, board_is_del, board_password) values ('qwer','안녕하세요1', '자기소개입니다.', 0, '2012-12-22', 'N', '');
INSERT INTO board (users_id, board_subject, board_contents, board_hits, board_reg_date, board_is_del, board_password) values ('asdf','안녕하세요2', '자기소개입니다.', 0, '2012-12-22', 'N', '');
INSERT INTO board (users_id, board_subject, board_contents, board_hits, board_reg_date, board_is_del, board_password) values ('qwer','안녕하세요3', '자기소개입니다.', 0, '2012-12-22', 'N', '');
INSERT INTO board (users_id, board_subject, board_contents, board_hits, board_reg_date, board_is_del, board_password) values ('asdf','안녕하세요4', '자기소개입니다.', 0, '2012-12-22', 'N', '');
INSERT INTO board (users_id, board_subject, board_contents, board_hits, board_reg_date, board_is_del, board_password) values ('qwer','안녕하세요5', '자기소개입니다.', 0, '2012-12-22', 'N', '');
INSERT INTO board (users_id, board_subject, board_contents, board_hits, board_reg_date, board_is_del, board_password) values ('asdf','안녕하세요6', '자기소개입니다.', 0, '2012-12-22', 'N', '');
INSERT INTO board (users_id, board_subject, board_contents, board_hits, board_reg_date, board_is_del, board_password) values ('qwer','안녕하세요7', '자기소개입니다.', 0, '2012-12-22', 'N', '');
select * from board where board_is_del in ('N');
INSERT INTO board_comment (board_id, bc_users_id, bc_contents, bc_reg_date) value (2, 'asdf' ,'첫 번째 댓글입니다.', '2014-05-10');
INSERT INTO board_comment (board_id, bc_users_id, bc_contents, bc_reg_date) value (3, 'qwer' ,'두 번째 댓글입니다.', '2014-05-10');
INSERT INTO board_comment (board_id, bc_users_id, bc_contents, bc_reg_date) value (3, 'asdf' ,'세 번째 댓글입니다.', '2014-05-10');
INSERT INTO board_comment (board_id, bc_users_id, bc_contents, bc_reg_date) value (3, 'asdf' ,'네 번째 댓글입니다.', '2014-05-10');
SELECT * FROM board_comment;
SELECT * FROM board where board_is_del NOT IN('N') and (board_subject LIKE"%안%" or board_contents like "%안%");
select count(*) from board;
select * from board;
select * from sessions;
select * from users;
select * from board_picture;
insert into users (users_id, users_password, users_name, users_emaiL, users_reg_date) values ('asdf', 'asdf', '김용진', 'yongjin5184@naver.com', now());
insert into users (users_id, users_password, users_name, users_emaiL, users_level, users_reg_date) values ('qwer', 'qwer', '아이유', 'iu@naver.com', 'Y',now());

insert into board_picture (board_id, board_pic_subject, board_pic_path, board_pic_date)values(2,'김용진','/php_board/bbs/include/images/smiley.gif',now());
SELECT * FROM board_comment as bc join board as b on bc.board_id = b.board_id WHERE bc.board_id=1 order by bc.board_id desc;
SELECT * FROM board_comment WHERE board_id=1 order by board_id desc;
SELECT * FROM board_comment as bc join board as b on bc.board_id = b.board_id join users u on u.users_id = bc.users_id WHERE bc.board_id=5;

select * from board_comment as bc left join users as u on bc.bc_user_id=u.users_id; 

select * from board_comment;

select * from users;

SELECT * FROM board_comment as bc join board as b on bc.board_id = b.board_id;
-- /jW8nuamxMups13hVm3xiMiL8DS4vK0r1r05eMxs7+/plUQb5kdaCOw8IidfOtspJLTRTJdxzahEQsd8smQRhw==
-- qCp5opLS7j117GMmgChfp67fdtHYXheQzwR2iFpNDjFxCGdm5yIoQepdeJzC3j2hII6p7X8smN1U6TOeQm664Q==
SELECT * FROM board_comment as bc join users u on u.users_id = bc.bc_users_id WHERE bc.board_id=3;