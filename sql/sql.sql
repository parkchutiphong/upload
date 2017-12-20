CREATE DATABASE id622085_se107;

CREATE TABLE fileupload (
file_id int NOT NULL AUTO_INCREMENT,
ip varchar(15) NOT NULL,
date varchar(10) NOT NULL,
time varchar(5) NOT NULL,
filename varchar(256) NOT NULL,
PRIMARY KEY (file_id)
)
CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE user (
username varchar(20) NOT NULL,
password varchar(20) NOT NULL,
PRIMARY KEY (username)
)
CHARACTER SET utf8 COLLATE utf8_unicode_ci;
