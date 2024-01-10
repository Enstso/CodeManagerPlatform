Create table user(
id INT auto_increment not null,
username  varchar(20) not null,
password varchar(20) not null,
status boolean DEFAULT 0,
PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS code (
        id INT NOT NULL AUTO_INCREMENT,
        code_unique varchar(255) NOT NULL,
        code_promo varchar(255) NOT NULL,
        status varchar(20) NOT NULL,
        PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(40) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        PRIMARY KEY (id),
        KEY `ci_sessions_timestamp` (`timestamp`)
);