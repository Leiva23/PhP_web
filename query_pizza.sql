CREATE TABLE dough(
	id_dough INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	dough VARCHAR(24) NOT NULL,
	price DECIMAL(5,2) NOT NULL,
	description TEXT
);

CREATE TABLE pizzas(
	id_pizza INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	pizza VARCHAR(48) NOT NULL,
	price DECIMAL(6,2) NOT NULL,
	description TEXT,
	id_dough INT UNSIGNED NOT NULL
);

INSERT INTO dough (dough, price)
VALUES ('Original', 1.0), ('Sin gluten', 2.0);


INSERT INTO pizzas (pizza, price, id_dough)
VALUES ('Margarita', 10.0, 1), ('4 quesos', 12.0, 1), ('Diavola', 14.0, 1), ('Sin gluten', 11, 2);
