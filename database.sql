# The first draft of the database for the music store.

#Beats - Each song, or beat, will be stored in the beats table
CREATE TABLE beats 
(
	beatID			INT						AUTO_INCREMENT,
	title				VARCHAR(64)		NOT NULL,
	category		VARCHAR(32)		NOT NULL,
	exclusive		BIT(1)				DEFAULT 0		NOT NULL,
	deleted			BIT(1)				DEFAULT 0		NOT NULL,
	fileName		VARCHAR(128)	NOT NULL,

	PRIMARY KEY(beatID)
);

#Test data for beats.
INSERT INTO beats VALUES (null, "Le Barbe Blue", "Punk", 0, 0, "659445_A-Lonely-Christmas.mp3");
INSERT INTO beats VALUES (null, "Brown Bacon", "Soule", NOW() + INTERVAL 1 MONTH, null, null);