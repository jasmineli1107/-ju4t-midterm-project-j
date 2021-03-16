-- JOIN phone models and phone_model_color 
SELECT id, model, color FROM phone_models
JOIN phone_model_color ON phone_models.id = phone_model_color.model_id;


-- see series availability
SELECT series_id, series_name_chn, series_name_eng, price, model FROM phone_series
JOIN phone_model_series ON phone_series.id = phone_model_series.series_id
JOIN phone_models ON phone_model_series.model_id = phone_models.id;


-- JOIN every thing together
SELECT model, color, shell_color_chn, series_name_chn, series_name_eng, design_name_chn, design_name_eng, price FROM phone_models
JOIN phone_model_color ON phone_models.id = phone_model_color.model_id
JOIN phone_shells
JOIN phone_model_series ON phone_models.id = phone_model_series.model_id
JOIN phone_series ON phone_model_series.series_id = phone_series.id
JOIN phone_designs ON phone_model_series.series_id = phone_designs.series_id
HAVING model = 'iPhone 12';
-- **NOTE: For iPhone 12 alone: color *5 shell_color * 3 transparent *2 series*12 = 360 total posibilities




-- ****NOTE: for file names, spaces are to be replaced by hypens*****

-- Phone color: ${model}/${model簡稱}-${color}.jpg
SELECT CONCAT(REPLACE(model, ' ', '-'), '/' ,REPLACE(REPLACE(model, 'Phone ', ''), ' ', '-'),'-', REPLACE(color, ' ', '-'), '.png') AS 'phone file name' FROM phone_models
JOIN phone_model_color ON phone_models.id = phone_model_color.model_id;

-- Phone cam color: ${model}/${model簡稱}-cam-${color}.jpg
SELECT CONCAT(REPLACE(model, ' ', '-'), '/' ,REPLACE(REPLACE(model, 'Phone ', ''), ' ', '-'),'-cam-', color, '.png') AS 'phone cam file name' FROM phone_models
JOIN phone_model_color ON phone_models.id = phone_model_color.model_id;

-- phone shell color: shell-${shell_color}.jpg
SELECT CONCAT('shell-', shell_color_en, '.png') AS 'phone shell file name' FROM phone_shells;

-- phone material ${series_name_eng}/${design_name_chn}.png
SELECT CONCAT(REPLACE(series_name_eng, ' ', '-'), '/', REPLACE(design_name_eng, ' ', '-'), '.png') AS 'phone design file path and name' FROM phone_series
JOIN phone_designs ON phone_series.id = phone_designs.series_id;