DROP DATABASE if exists yadda;
CREATE DATABASE yadda;

CREATE TABLE users(
	id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	email varchar(255) NOT NULL,
	name varchar(255) NOT NULL,
	password BLOB NOT NULL,
	handle varchar(30) NOT NULL,
	-- img varchar(30) NOT NULL,
	status boolean NOT NULL DEFAULT 0,
	permission int(11) NOT NULL
	);

CREATE TABLE listeners(
	users int(11) NOT NULL,
	listener int(11) NOT NULL,
	PRIMARY KEY (users, listener)
	);

CREATE TABLE yadda(
	id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	content varchar(167) NOT NULL,
	created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	userid int(11) NOT NULL,
	FOREIGN KEY (userid) REFERENCES users(id)
	);

CREATE TABLE yadda_rel(
	parent int(11) NOT NULL,
	child int(11) NOT NULL,
	PRIMARY KEY (parent, child)
	);

CREATE TABLE yadda_has_images(
	yadid int(11) NOT NULL,
	imgid int(11) NOT NULL,
	PRIMARY KEY (yadid, imgid)
	);

CREATE TABLE image(
	id int(11) PRIMARY KEY NOT NULL,
	file BLOB NOT NULL,
	mimetype varchar(30) NOT NULL
	);


DELIMITER //

DROP PROCEDURE IF EXISTS newUser//
CREATE PROCEDURE newUser(email varchar(30), name varchar(30), pwd varchar(30), handle varchar(30), status boolean, permission int(11))
BEGIN
	INSERT INTO users(
		email,
		name,
		password,
		handle,
		status,
		permission)
	VALUES (email, name, pwd, handle, status, permission);
END//


DROP PROCEDURE IF EXISTS newYadda//
CREATE PROCEDURE newYadda(content varchar(167), userid int(11))
BEGIN
	INSERT INTO yadda(
		content,
		userid)
	VALUES (content, userid);
END//

DELIMITER ;

CALL newUser('admin@mail.dk', 'Admin Adminsen', 'admin', 'admin', 1, 1);
CALL newUser('sirup@mail.dk', 'Søren Sirup', 'password', 'SizzleSoren', 0, 0);
CALL newUser('mel@mail.dk', 'Morten Melboller', 'password', 'HotFudge', 1, 0);

CALL newYadda('asdfasdfasdfasdfasfkanghbalhbsfafdkaljlkss h aslkhalshoauhffuiahfjjsdkjasdu asddfuhalkfj hasjfn laskdjf,df ,asjj kayejf 
		bjsd ,adkjb ,k,mx,vkdjhgs,kghjsd v xckgjb rn gjs dfg,s dg sdff ng gfn gµf gsnd fg,sdmn fg', 1);