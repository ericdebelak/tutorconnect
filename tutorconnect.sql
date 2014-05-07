DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS profile;
DROP TABLE IF EXISTS feedback;
DROP TABLE IF EXISTS session;
DROP TABLE IF EXISTS experience;
DROP TABLE IF EXISTS interests;

CREATE TABLE user
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	email VARCHAR(64) NOT NULL,
	password CHAR(128) NOT NULL,
	salt CHAR(64) NOT NULL,
	UNIQUE(email),
	PRIMARY KEY(id)
);

CREATE TABLE profile
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	userId INT UNSIGNED NOT NULL,
	firstName VARCHAR(32) NOT NULL,
	lastName VARCHAR(32) NOT NULL,
	birthday DATE,
	picture INT UNSIGNED,
	travel INT UNSIGNED,
	hobby TEXT,
	rate DECIMAL(4,2),
	PRIMARY KEY(id),
	INDEX(userId),
	FOREIGN KEY(userId) REFERENCES user(id)
);

CREATE TABLE feedback
{
	subjectId INT UNSIGNED NOT NULL,
	reviewerId INT UNSIGNED NOT NULL,
	sessionId INT UNSIGNED NOT NULL,
	rating INT(1)UNSIGNED NOT NULL,
	comments TEXT,
	INDEX(subjectId),
	INDEX(reviewerId),
	INDEX(sessionId),
	FOREIGN KEY(subjectId) REFERENCES user(id),
	FOREIGN KEY(reviewerId) REFERENCES user(id),
	FOREIGN KEY(sessionId) REFERENCES session(id)
};

CREATE TABLE session
(
	id INT UNSIGNED NOT NULL,
	tutorId INT UNSIGNED NOT NULL,
	studentId INT UNSIGNED NOT NULL,
	tutorLog TEXT,
	tutorNextSteps TEXT,
	studentLog TEXT,
	studentNextSteps TEXT,
	date DATE,
	PRIMARY KEY(id),
	INDEX(tutorId),
	INDEX(studentId),
	FOREIGN KEY(tutorId) REFERENCES user(id),
	FOREIGN KEY(studentId) REFERENCES user(id)
);

CREATE TABLE experience
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	userId INT UNSIGNED NOT NULL,
	experience VARCHAR(64),
	description TEXT,
	PRIMARY KEY(id),
	INDEX(userId),
	FOREIGN KEY(userId) REFERENCES user(id)
);

CREATE TABLE interests
{
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	userId INT UNSIGNED NOT NULL,
	interest VARCHAR(64),
	description TEXT,
	PRIMARY KEY(id),
	INDEX(userId),
	FOREIGN KEY(userId) REFERENCES user(id)
};