<?php

$query = "
    SELECT `sound_date_time`, `info_comment`, `info_trim`, `parameter_temp`, `parameter_density`, `parameter_level`, `tank_name` 
    FROM `sound_dates`
    LEFT JOIN `infos` ON `sound_date_id` = `info_sound_date_id`
    LEFT JOIN `parameters` ON `info_id` = `parameter_info_id`
    LEFT JOIN `tanks` ON `parameter_tank_id` = `tank_id`
    WHERE `sound_date_id` = 1
";
$query = "
    SELECT DISTINCT `sound_date_id` as dateId, `sound_date_time` as dateTime, `info_id`, `info_comment` as comment, `info_trim` as trim,
                               `parameter_level` as level, `parameter_temp` as temp, `parameter_density` as density, `parameter_tank_id` as tankId,
                               `tank_name`, `tank_abbrev`
                        FROM `sound_dates`
                        LEFT JOIN `infos` ON `sound_date_id` = `info_sound_date_id`
                        LEFT JOIN `parameters` ON `info_id` = `parameter_info_id`
                        LEFT JOIN `tanks` ON `parameter_tank_id` = `tank_id`
                        LEFT JOIN `vessels` ON `tank_vessel_id` = `vessel_id`
                        WHERE `vessel_id` = 2
";
$id = 0;
$idInfo = 0;
$query = "
    INSERT INTO `sound_dates`
                        SET `sound_date_time` = '2021-06-12 17:21:58';
    SELECT   @id := `sound_date_id`
        FROM `sound_dates`
    WHERE `sound_date_time` = '2021-06-12 17:21:58';
    INSERT INTO `infos`
                        SET `info_sound_date_id` := @id,
                            `info_comment` = 'Second record',
                            `info_trim` = '1.5';
     SELECT   @idInfo := `info_id`
        FROM `infos`
    WHERE `info_sound_date_id` = @id;
    INSERT INTO `parameters`
                        SET `parameter_info_id` = @idInfo,
                            `parameter_level` = 345,
                            `parameter_temp` = 44,
                            `parameter_density` = 0.9934,
                                 `parameter_tank_id` = 1;
       
";
$etert = "
SELECT   @id := `sound_date_id`
                        FROM `sound_dates`
                        WHERE `sound_date_time` = '$newData[date]';

                        INSERT INTO `infos`
                                SET `info_sound_date_id` := @id,
                                    `info_comment` = '$newData[comment]',
                                    `info_trim` = $newData[trim];

                        SELECT   @idInfo := `info_id`
                        FROM `infos`
                        WHERE `info_sound_date_id` = @id;

                    
                        INSERT INTO `parameters`
                                SET `parameter_info_id` = $infoId,
                                    `parameter_level` = $level,
                                    `parameter_temp` = $temp,
                                    `parameter_density` = $dens,
                                    `parameter_tank_id` =  $tankId;
       

";

$vessel = "
            SELECT `vessel_id`, `vessel_name`
                    FROM `vessels`
                    LEFT JOIN `users_vessels` ON `vessel_id` = `user_vessel_vessel_is`
                    LEFT JOIN `users` ON `user_vessel_user_id` = `user_id`
                    WHERE `user_id` = $id 

";

$query = " 
                    SELECT `vessel_id`, `vessel_name`, COUNT(*) as count
                    FROM `vessels`
                    LEFT JOIN `tanks` ON `vessel_id` = `tank_vessel_id`
                    WHERE `vessel_id` = $id AND `tank_type_id` = 0
            ";


$query = "
INSERT INTO `sounding`
                        SET `sound` = '$newData[vessel]',
                            `-2` = '$newData[imo]',
                            `-1` = '$newData[call]',
                            `-0.5` = '$newData[officialNumber]',
                            `0` = '$newData[port]',
                            `0.5` = '$newData[flag]',
                            `1` = '$newData[flag]',
                            `2` = '$newData[flag]',
                            `3` = '$newData[flag]',
                            `4` = '$newData[flag]',
                            `5` = '$newData[flag]',
                            `ullage` = '$newData[flag]',
                            `tank_table_id` = $tankId
                            ";

$query = "
                    LOAD DATA INFILE $fileCSV
                    INTO TABLE `sounding`
                    FIELDS TERMINATED BY ','
                    ENCLOSED BY '\"'
                    LINES TERMINATED BY '/n'
                    IGNORE 1 LINES;
                    `table_tank_id` = 25
            ";

$query = " 
                    SELECT DISTINCT `user_vessel_user_id`, `user_vessel_vessel_is`,`vessel_name`,
                                    `sound_date_id` as dateId, `sound_date_time` as dateTime, `sound_date_comment` as comment, `sound_date__trim` as trim,
                                     `vessel_id`, `user_vessel_user_role` as roleId
                    FROM `users_vessels`
                    LEFT JOIN `vessels` ON `vessel_id` = `user_vessel_vessel_is`
                    LEFT JOIN `tanks` ON `tank_vessel_id` = `vessel_id`
                    LEFT JOIN `parameters` ON `parameter_tank_id` = `tank_id`   
                    LEFT JOIN `sound_dates` ON `sound_date_id` = `parameter_sound_date_id` 
                     WHERE `vessel_id` = 2 AND `user_vessel_user_id` = 6 AND `user_vessel_user_role` = 1
            ";

$query = " 
                    SELECT `tank_id`, `tank_name`, `1` as 'min', `2` as 'max', `tank_abbrev`, `sound`, `ullage` 
                    FROM `tanks` 
                    LEFT JOIN `sounding` ON `tank_id` = `table_tank_id`
                    WHERE `sound` <  192 + 4 AND `sound` >= 192 AND `tank_id` = 1
                    ORDER BY (`sound`) ASC 
                    LIMIT 1
                    ";
$query = "  
                    SELECT `tank_id`, `tank_name`, `1` as 'min', `2` as 'max', `tank_abbrev`, `sound`, `ullage` 
                    FROM `tanks` 
                    LEFT JOIN `sounding` ON `tank_id` = `table_tank_id`
                    WHERE `sound` <=  192 AND `sound` > 192 - 4 AND `tank_id` = 1
                    ORDER BY (`sound`) DESC 
                    LIMIT 1
                    ";