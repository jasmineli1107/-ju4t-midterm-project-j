CREATE TABLE phone_models (
    id INT PRIMARY KEY AUTO_INCREMENT,
    model VARCHAR(100)
);

CREATE TABLE phone_model_color (
    model_id INT,
    color VARCHAR(100),
    FOREIGN KEY (model_id) REFERENCES phone_models(id)
);

CREATE TABLE phone_shells (
    id INT PRIMARY KEY AUTO_INCREMENT,
    shell_color VARCHAR(100)
);

CREATE TABLE phone_back (
    transparent BOOLEAN
);

CREATE table phone_series(
    id INT PRIMARY KEY AUTO_INCREMENT,
    series_name_chn VARCHAR(100),
    series_name_eng VARCHAR(100),
    price INT
);

CREATE table phone_model_series(
    model_id INT,
    series_id INT,
    FOREIGN KEY (model_id) REFERENCES phone_models(id),
    FOREIGN KEY (series_id) REFERENCES phone_series(id)
);

CREATE table phone_designs(
    id INT PRIMARY KEY AUTO_INCREMENT,
    series_id INT,
    design_name_chn VARCHAR(100),
    design_name_eng VARCHAR(100),
    FOREIGN KEY (series_id) REFERENCES phone_series(id)
);