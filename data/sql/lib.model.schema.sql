
-----------------------------------------------------------------------------
-- content
-----------------------------------------------------------------------------

DROP TABLE [content];


CREATE TABLE [content]
(
	[id] INTEGER  NOT NULL PRIMARY KEY,
	[title] VARCHAR(255),
	[content] MEDIUMTEXT,
	[created_at] TIMESTAMP
);
