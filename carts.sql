CREATE TABLE carts(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    state tinyint(4) NOT NULL,
	user_id int(11) NOT NULL,
	product_id int(11) NOT NULL,
	quantity decimal(10,2) NOT NULL,
	discount decimal(10,2) NOT NULL,
	send decimal(10,2) NOT NULL,
	date datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;