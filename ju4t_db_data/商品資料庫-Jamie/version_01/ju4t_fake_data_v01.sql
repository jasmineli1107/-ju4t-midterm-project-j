-- phone model data
INSERT INTO phone_models(model) 
VALUES 
('iPhone 12'),
('iPhone 12 mini'),
('iPhone 11');

-- phone model color
INSERT INTO phone_model_color(model_id, color)
VALUES
(1, 'white'),
(1, 'red'),
(1, 'green'),
(1, 'blue'),
(1, 'black'),

(2, 'red'),
(2, 'green'),
(2, 'blue'),
(2, 'black'),

(3, 'yellow'),
(3, 'spacegray'),
(3, 'silver'),
(3, 'red'),
(3, 'purple'),
(3, 'green');


-- phone shell data
INSERT INTO phone_shells(shell_color) 
VALUES ('black'), ('white'), ('silver');


-- phone back data
INSERT INTO phone_back(transparent)
VALUES (true), (false);


-- phone series data
INSERT INTO phone_series(series_name_chn, series_name_eng, price)
VALUES
('動物', 'animals', 1000),
('食物', 'food', 850),
('太空', 'space', 900),
('藝術', 'art', 950),
('國旗', 'flags', 800);


-- phone model series data
INSERT INTO phone_model_series (model_id, series_id)
VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 1),
(2, 2),
(2, 5),
(3, 1),
(3, 3);

-- phone designs
INSERT INTO phone_designs (series_id, design_name_chn, design_name_eng)
VALUES
(1, '柴犬', 'shiba'),
(1, '黃金獵犬', 'golden retreiver'),
(1, '法鬥', 'french bulldog'),
(2, '紅豆', 'red beans'),
(2, '綠豆', 'green beans'),
(2, '奶茶', 'milk tea'),
(3, 'NASA', 'NASA'),
(4, '當代', 'modern'),
(4, '抽象', 'abstract'),
(5, '日本', 'Japan'),
(5, '台灣', 'Taiwan'),
(5, '義大利', 'Italy');

