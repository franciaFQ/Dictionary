create database dictionary;

use dictionary;

create table types(
	cod_type int not null primary key auto_increment,
    name_type varchar(50) not null
)engine=innoDB;

create table users(
	cod_user varchar(8) not null primary key,
    user_name varchar(100) not null,
    password varchar(50),
    cod_type int not null,
    FOREIGN KEY (cod_type) REFERENCES types(cod_type)
)engine=innoDB;

create table categories(
	cod_category int not null auto_increment primary key,
    category_name varchar(60) not null unique
)engine=innoDB;

create table words(
	word varchar(100) not null primary key,
    definition varchar(1000) not null,
    image varchar(1000),
    cod_category int not null,
    FOREIGN KEY (cod_category) REFERENCES categories(cod_category)
)engine=innoDB;


/*----------------------------------DATA------------------------------------*/
INSERT INTO `dictionary`.`types` (`name_type`) VALUES ('Student');
INSERT INTO `dictionary`.`types` (`name_type`) VALUES ('Teacher');
INSERT INTO `dictionary`.`types` (`name_type`) VALUES ('Admin');

INSERT INTO `dictionary`.`users` (`cod_user`, `user_name`, `password`, `cod_type`) VALUES ('FQ1620', 'Rodrigo Francia', 'FQ1620', '1');
INSERT INTO `dictionary`.`users` (`cod_user`, `user_name`, `password`, `cod_type`) VALUES ('FQ1621', 'Jesus Quezada', '123456', '2');
INSERT INTO `dictionary`.`users` (`cod_user`, `user_name`, `password`, `cod_type`) VALUES ('FQ1622', 'Jesus Quezada', '123456', '3');

INSERT INTO `dictionary`.`categories` (`category_name`) VALUES ('bank');
INSERT INTO `dictionary`.`categories` (`category_name`) VALUES ('mall');
INSERT INTO `dictionary`.`categories` (`category_name`) VALUES ('house');

INSERT INTO `dictionary`.`words` (`word`, `definition`, `cod_category`) VALUES ('Money', 'Use to pay.', '1');
INSERT INTO `dictionary`.`words` (`word`, `definition`, `cod_category`) VALUES ('Shoes', 'Buy shoes.', '2');
INSERT INTO `dictionary`.`words` (`word`, `definition`, `cod_category`) VALUES ('TV', 'Wacth movies at night.', '3');
INSERT INTO `dictionary`.`words` (`word`, `definition`, `cod_category`) VALUES ('Videogame', 'Use to play.', '2');
INSERT INTO `dictionary`.`words` (`word`, `definition`, `cod_category`) VALUES ('Security', 'To be safe', '1');
INSERT INTO `dictionary`.`words` (`word`, `definition`, `cod_category`) VALUES ('Dog', 'The best friend of human', '3');
INSERT INTO `dictionary`.`words` (`word`, `definition`, `cod_category`) VALUES ('Elephant', 'either of two large, five-toed pachyderms of the family Elephantidae, characterized by a long, prehensile trunk formed of the nose and upper ', '3');
