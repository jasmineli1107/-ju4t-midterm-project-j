SELECT pm.* ,pmc.color,ps.series_name_chn '系列',ps.price FROM  `phone_models`  pm 
join `phone_model_color`  pmc ON pm.`id`= pmc.`model_id`
join `phone_model_series` pms on pm.`id`= pms.`model_id`
join `phone_series` ps on pms.`series_id`= ps.`id` %s LIMIT %s,%s;

---- sid/member_id/model_id/shell_id/case_bg/series_id/dessign_id/per_price/quantity ----

--型號/殼色/背板透明/主題/樣式/單價
SELECT pm.model '型號',pshell.shell_color_chn '殼色',pseries.is_classic '款式',pseries.series_name_chn '主題',pd.design_name_chn '樣式',pseries.price '單價',pm.id 'model_id',pshell.id 'shell_id',pseries.id 'series_id',pd.id 'design_id'
FROM `phone_models` pm 
join `phone_shells` pshell
join `phone_model_series` pms on pm.`id`= pms.`model_id`
join `phone_series` pseries on pms.`series_id`= pseries.`id`
join `phone_designs` pd on pd.`series_id` = pseries.`id`;

--`member_id`, `model_id`,`shell_id`,`case_bg`,`series_id`,`dessign_id`, `per_price`,`quantity`--

select sid ,member_id ,price , address '',taker '',taker_mobile '',created_at '', updated_at '',status '訂單狀態' FROM `order_list`;

