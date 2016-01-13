# The first draft of the database for the music store.

#Beats - Each song, or beat, will be stored in the beats table
CREATE TABLE beats 
(
	beatID			INT						AUTO_INCREMENT,
	title				VARCHAR(64)		NOT NULL,
	category		VARCHAR(32)		NOT NULL,
	leasedTill	DATETIME			DEFAULT NULL,
	exclusive		BIT(1)				DEFAULT 0,
	deleted			BIT(1)				DEFAULT 0,

	PRIMARY KEY(beatID)
);

#Test data for beats.
INSERT INTO beats VALUES (null, "Le Barbe Blue", "Punk", null, null, null);
INSERT INTO beats VALUES (null, "Brown Bacon", "Soule", NOW() + INTERVAL 1 MONTH, null, null);