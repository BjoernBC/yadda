DROP DATABASE if exists yadda;
CREATE DATABASE yadda;

CREATE TABLE users(
	id int(11) PRIMARY KEY NOT NULL,
	email varchar(255) NOT NULL,
	name varchar(255) NOT NULL,
	password BLOB NOT NULL,
	handle varchar(30) NOT NULL,
	img varchar(30) NOT NULL,
	status boolean NOT NULL DEFAULT 0,
	permission int(11) NOT NULL
	);

CREATE TABLE listeners(
	users int(11) NOT NULL,
	listener int(11) NOT NULL,
	PRIMARY KEY (users, listener)
	);

CREATE TABLE yadda(
	id int(11) PRIMARY KEY NOT NULL,
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