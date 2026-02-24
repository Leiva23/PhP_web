DROP TABLE IF EXISTS doughs;
DROP TABLE IF EXISTS pizzas;

CREATE TABLE doughs(
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

INSERT INTO doughs (dough, price, description)
VALUES ('Original', 1.0, 'Nuestra masa clasica'),
('Sin gluten', 2.0, 'Masa para celiacos casera'),
('Bordes con queso', 3.50, 'Bordes rellenos de mozzarella');


INSERT INTO pizzas (pizza, price, description, id_dough)
VALUES ('Margarita', 10.0, 'La clásica: tomate San Marzano, mozzarella fresca, albahaca y aceite de oliva.',1),
('4 quesos', 12.0, 'Mezcla cremosa de mozzarella, gorgonzola, parmesano y emmental.',3),
('Diavola', 14.0, 'Salami picante, pepperoni y un toque de chile.',1),
('Sin gluten', 11, 'Nuestra pizza clasica sin gluten',2);
