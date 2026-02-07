CREATE TABLE users (
    UserID int NOT NULL AUTO_INCREMENT,
    Username varchar(1o) NOT NULL,
    Email varchar(40) NOT NULL,
    Pass varchar(15) NOT NULL,
    Bio varchar(300) NULL,
    PRIMARY KEY (UserID),
    UNIQUE(Username)
);

CREATE TABLE board (
    BoardID int NOT NULL AUTO_INCREMENT,
    UserID int NOT NULL,
    BoardName varchar(40) NOT NULL,
    BoardDescription varchar(200) NOT NULL, 
    Region ENUM(
  'Bedfordshire',
  'Berkshire',
  'Bristol',
  'Buckinghamshire',
  'Cambridgeshire',
  'Cheshire',
  'City of London',
  'Cornwall',
  'Cumbria',
  'Derbyshire',
  'Devon',
  'Dorset',
  'East Riding of Yorkshire',
  'East Sussex',
  'Essex',
  'Gloucestershire',
  'Greater London',
  'Greater Manchester',
  'Hampshire',
  'Herefordshire',
  'Hertfordshire',
  'Isle of Wight',
  'Kent',
  'Lancashire',
  'Leicestershire',
  'Lincolnshire',
  'Merseyside',
  'Norfolk',
  'North Yorkshire',
  'Northamptonshire',
  'Northumberland',
  'Nottinghamshire',
  'Oxfordshire',
  'Rutland',
  'Shropshire',
  'Somerset',
  'South Yorkshire',
  'Staffordshire',
  'Suffolk',
  'Surrey',
  'Tyne and Wear',
  'Warwickshire',
  'West Midlands',
  'West Sussex',
  'West Yorkshire',
  'Wiltshire',
  'Worcestershire',
  'County Durham'
) NOT NULL,
PRIMARY KEY (BoardID),
UNIQUE (BoardName),
FOREIGN KEY (UserID) REFERENCES users(UserID)
);


CREATE TABLE comments(
    CommentID int NOT NULL AUTO_INCREMENT,
    UserID int NOT NULL,
    BoardID int NOT NULL,
    CommentText varchar(500) NOT NULL,
    DateAndTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (CommentID),
    FOREIGN KEY (BoardID) REFERENCES board(BoardID),
    FOREIGN KEY (UserID) REFERENCES users(UserID)
);

CREATE TABLE replies(
    ReplyID int NOT NULL AUTO_INCREMENT,
    CommentID int NOT NULL,
    UserID int NOT NULL,
    ReplyText varchar(500) NOT NULL,
    DateAndTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ReplyID),
    FOREIGN KEY (CommentID) REFERENCES comments(CommentID),
    FOREIGN KEY (UserID) REFERENCES users(UserID)
);