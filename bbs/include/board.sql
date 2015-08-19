drop database ci_book;
show databases;
create database board_db;
use board_db;
show databases;
drop table board_comment;
drop table board;

CREATE TABLE `board`(
	 board_id INT AUTO_INCREMENT NOT NULL,
     board_user_id VARCHAR(20) NOT NULL,
     board_user_name VARCHAR(20) NOT NULL,
     board_subject VARCHAR(50) NOT NULL,
     board_contents TEXT NOT NULL,
     board_hits INT NOT NULL,
     board_reg_date DATETIME NOT NULL,
     board_is_del ENUM('Y','N') NULL,
     board_password VARCHAR(20), 
     PRIMARY KEY (board_id)
)engine=InnoDB CHARSET=utf8;


CREATE TABLE `board_comment` (
	bc_id INT AUTO_INCREMENT NOT NULL,
    board_id INT NOT NULL,
    bc_user_id VARCHAR(20) NOT NULL,
    bc_contents TEXT NOT NULL,
    bc_reg_date DATETIME NOT NULL,
    PRIMARY KEY (bc_id),
    FOREIGN KEY (board_id) REFERENCES board(board_id) 
)engine=InnoDB CHARSET=utf8;

use board_db;
CREATE TABLE `users` (
	users_seq int NULL auto_increment,
    users_id VARCHAR(50) NULL,
    users_password VARCHAR(50) NULL,
    users_name VARCHAR(50) NOT NULL,
    users_emaiL VARCHAR(50) NULL,
    users_reg_date DATETIME NOT NULL,
    PRIMARY KEY (users_seq)
)engine=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sessions` (
	bs_id varchar(40) DEFAULT '0' NOT NULL,
    bs_ip_address varchar(16) DEFAULT '0' NOT NULL,
	bs_user_agent varchar(120) NOT NULL,
	bs_last_activity int DEFAULT '0' NOT NULL,
    bs_user_data text NOT NULL,
    PRIMARY KEY (bs_id)
)engine=InnoDB CHARSET=utf8;
INSERT INTO board (board_user_id, board_user_name, board_subject, board_contents, board_hits, board_reg_date, board_is_del, board_password) values ('yongjin', '김용진', '안녕하세요', '자기소개입니다.', 0, '2012-12-22', 'N', '');
select * from board;
INSERT INTO board_comment (board_id, bc_user_id, bc_contents, bc_reg_date) value (1, 'kim' ,'첫 번째 댓글입니다.', '2014-05-10');
SELECT * FROM board_comment;