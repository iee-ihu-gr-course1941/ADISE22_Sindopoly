
CREATE or replace TABLE `Board`(
        `x` TINYINT(1) NOT NULL,
        `y` TINYINT(1) NOT NULL,
        `pieceID` int(2) DEFAULT NULL,
        primary key (`x`,`y`)

    );

INSERT INTO `Board` (x,y) VALUES (1,1),(1,2),(1,3),(1,4),(2,1),(2,2),(2,3),(2,4),(3,1),(3,2),(3,3),(3,4),(4,1),(4,2),(4,3),(4,4);


drop table if exists `pieces` CASCADE;
CREATE OR REPLACE TABLE `pieces`(
    `pieceID` INT(2) AUTO_INCREMENT,
    `piececolor` enum('black','white')not null,
    `shape` enum('cycle','square')not null,
    `size` enum('long','short')not null,
    `hole` enum('YES','NO'),
    `available` enum('TRUE','FALSE') DEFAULT 'TRUE',
    primary key (`pieceID`)
);

INSERT INTO `pieces` (piececolor,shape,size,hole)
VALUES 
('black','cycle','long','YES'),
('black','cycle','long','NO'),
('black','cycle','short','YES'),
('black','cycle','short','NO'),
('black','square','long','YES'),
('black','square','long','NO'),
('black','square','short','YES'),
('black','square','short','NO'),

('white','cycle','long','YES'),
('white','cycle','long','NO'),
('white','cycle','short','YES'),
('white','cycle','short','NO'),
('white','square','long','YES'),
('white','square','long','NO'),
('white','square','short','YES'),
('white','square','short','NO');



DROP TABLE IF EXISTS `game_status`;
CREATE TABLE `game_status` (
    `id` int(10) not null auto_increment,
    `status` enum('start_game','end_game','not active','initalized','abord_game')not null DEFAULT 'not active',
	`turn` TINYINT DEFAULT '1',
    `state`  enum('pick', 'place')not null DEFAULT 'pick',
    `piece` int(2) DEFAULT  null,
    `change` timestamp DEFAULT now(),
    `won` text DEFAULT null,
    primary key(`id`)
);





DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
	`id` int(10) not null auto_increment,
     `username` varchar(20) DEFAULT null UNIQUE,
     `email` varchar(50) DEFAULT null UNIQUE,
     `password` varchar(100),
     `token` varchar(100) DEFAULT null UNIQUE,
     primary key(`id`)
);

DROP TABLE IF EXISTS `players`;
CREATE TABLE `players` (
    `player` int auto_increment,
    `id` int(10) not null,
    `username` varchar(20) default null UNIQUE,
    `token` varchar(100) default null UNIQUE,
    primary key(`player`)
);


DELIMITER ;;
CREATE or replace PROCEDURE `placepiece`(x int,y int, piece int)
BEGIN
    update Board b set `pieceID` = piece where b.x = x and b.y = y;
    INSERT INTO `game_status` (turn,state,status) select turn,'pick',status from game_status ORDER BY id DESC LIMIT 1;

END ;;
DELIMITER ;

DELIMITER ;;--PICK
CREATE or replace PROCEDURE pickpiece(piece int)
BEGIN
    update pieces set `available` = 'FALSE' where `pieceID` = piece;

    INSERT INTO game_status (turn,state,piece,status) select IF(g.turn=1,2,1),'place',piece,status from game_status g ORDER BY id DESC LIMIT 1;

END ;;
DELIMITER ;

DELIMITER ;;

CREATE or replace PROCEDURE reset_game()
BEGIN
DELETE FROM `players`;
ALTER TABLE `players` AUTO_INCREMENT = 1;
DELETE FROM `game_status`;
UPDATE pieces SET available = "TRUE"
WHERE available = "FALSE" ;
INSERT INTO `game_status` VALUES();

    CREATE or replace TABLE `Board`(
        `x` TINYINT(1) NOT NULL,
        `y` TINYINT(1) NOT NULL,
        `pieceID` int(2) DEFAULT NULL,
        primary key (`x`,`y`)

    );

    INSERT INTO `Board` (x,y) VALUES (1,1),(1,2),(1,3),(1,4),(2,1),(2,2),(2,3),(2,4),(3,1),(3,2),(3,3),(3,4),(4,1),(4,2),(4,3),(4,4);
END ;;

-- call reset_game();



-- select * from game_status;
-- select * from Board;

-- select * from pieces;

-- select * from players;
-- select * from users;

update Board set pieceID = null where x = 1 and y = 4
select x,y, p.* from board b left join pieces p on b.pieceID = p.pieceID
call `placepiece`(1,1, 1);
call `placepiece`(1,2, 2);
call `placepiece`(1,3, 3);