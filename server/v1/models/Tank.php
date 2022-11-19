<?php

    class  Tank{


        public  function getAll(){
            $connect = DB::getConnection();
            $query = (new Select('tanks'))
                ->build();
            $result = mysqli_query($connect, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

//        public  function getAll($vslId){
//            $connect = DB::getConnection();
//            $query =  "
//                        SELECT `tank_id`, `tank_name`, `tank_pos`, `tank_type_id`
//                        FROM `tanks`
//                        WHERE `tank_vessel_id` = $vslId
//                ";
//            $result = mysqli_query($connect, $query);
//            return mysqli_fetch_all($result, MYSQLI_ASSOC);
//        }



        public  function getByLvl($id, $vslId, $lvl, $ulg, $vlm, $trim1, $trim2, $tblName){
            $connect = DB::getConnection();
            //echo 'has gotten getByLvl';
//            $query =  "
//                    SELECT `tank_id`, `tank_name`, `$trim1` as 'min', `$trim2` as 'max', `tank_abbrev`, `sound`, `ullage`
//                    FROM `tanks`
//                    LEFT JOIN `$tblName` ON `tank_id` = `table_tank_id`
//                    WHERE `sound` <= $lvl + 1 AND `sound` >= $lvl - 1 AND `tank_id` = $id
//            ";
            $query = " 
                    SELECT `tank_id`, `tank_name`, `$trim1` as 'min', `$trim2` as 'max', `tank_abbrev`, `sound`, `ullage` 
                    FROM `tanks` 
                    LEFT JOIN `$tblName` ON `tank_id` = `table_tank_id`
                    WHERE `sound` <  $lvl + 4 AND `sound` >= $lvl AND `tank_id` = $id
                    ORDER BY (`sound`) ASC 
                    LIMIT 1
                    ";
           // echo $query;
            $result = mysqli_query($connect, $query);
            $volMax[0] = mysqli_fetch_assoc($result);

            $query = "  
                    SELECT `tank_id`, `tank_name`, `$trim1` as 'min', `$trim2` as 'max', `tank_abbrev`, `sound`, `ullage` 
                    FROM `tanks` 
                    LEFT JOIN `$tblName` ON `tank_id` = `table_tank_id`
                    WHERE `sound` <=  $lvl AND `sound` > $lvl - 4 AND `tank_id` = $id
                    ORDER BY (`sound`) DESC 
                    LIMIT 1
                    ";
           // echo $query;
            $result = mysqli_query($connect, $query);
            $volMin[0] = mysqli_fetch_assoc($result);

            //==1. Вычисляем разницу между ближайшеми значениями в таблице сверху и снизу к реальному значению. Например 126.2 - 124.9 = 1.3 ========
            $diff = $volMax[0]['min']-$volMin[0]['min'];
            //==2. Вычисляем шаг таблицы и сколько см в одном шаге===============================================
            //$diff = $diff/10;
            $step = $volMax[0]['sound']-$volMin[0]['sound'];
            //==3. Вычисляем сколько 1/10 до ближайших значений в таблице от полученного замера и какое кол-во топлива приходится на это==============
            if ($step != 0){
                $toUpSide = round(($lvl - $volMin[0]['sound']) / $step, 1) * $diff;
             //   $toDownSide = round(($volMax[0]['sound'] - $lvl) / $step, 1) * $diff;
            }else{
                $toUpSide = 0;
             //   $toDownSide = 0;
            }
            //==4. Прибавляем вычисленное выше кол-во топлива к ближайшему меньшему значению полученному в таблице и присваиваем полученное значение ==
            //==   соответствующим членам массива который будет отправлен клиенту======================================================================
            $volMax[0]['min'] = $volMin[0]['min'] + $toUpSide;
            $volMax[0]['max'] = $volMin[0]['max'] + $toUpSide;
           // echo ('$volMax[0][min] = '.$volMax[0]['min'].', $volMax[0][max] = '.$volMax[0]['max']);

            return $volMax;
          //  return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }




        public  function getByUllage($id, $vslId, $lvl, $ulg, $vlm, $trim1, $trim2, $tblName){
            $connect = DB::getConnection();
            //echo 'has gotten getByUllage';
//            $query =  "
//                    SELECT `tank_id`, `tank_name`, `$trim1` as 'min', `$trim2` as 'max', `tank_abbrev`, `sound`, `ullage`, `tank_pos`
//                    FROM `tanks`
//                    LEFT JOIN `$tblName` ON `tank_id` = `table_tank_id`
//                    WHERE `ullage` <= $ulg + 1 AND `ullage` >= $ulg - 1 AND `tank_id` = $id
//            ";
            //echo $query;

            $query = " 
                    SELECT `tank_id`, `tank_name`, `$trim1` as 'min', `$trim2` as 'max', `tank_abbrev`, `sound`, `ullage` 
                    FROM `tanks` 
                    LEFT JOIN `$tblName` ON `tank_id` = `table_tank_id`
                    WHERE `ullage` <  $ulg + 4 AND `ullage` >= $ulg AND `tank_id` = $id
                    ORDER BY (`ullage`) ASC 
                    LIMIT 1
                    ";
            // echo $query;
            $result = mysqli_query($connect, $query);
            $volMax[0] = mysqli_fetch_assoc($result);
            //echo (' $volMax[0][min] = '.$volMax[0]['min'].' $volMax[0][max] = '.$volMax[0]['max']);

            $query = "  
                    SELECT `tank_id`, `tank_name`, `$trim1` as 'min', `$trim2` as 'max', `tank_abbrev`, `sound`, `ullage` 
                    FROM `tanks` 
                    LEFT JOIN `$tblName` ON `tank_id` = `table_tank_id`
                    WHERE `ullage` <=  $ulg AND `ullage` > $ulg - 4 AND `tank_id` = $id
                    ORDER BY (`ullage`) DESC 
                    LIMIT 1
                    ";
            // echo $query;
            $result = mysqli_query($connect, $query);
            $volMin[0] = mysqli_fetch_assoc($result);
            //echo (' $volMin[0][min] = '.$volMin[0]['min'].' $volMin[0][max] = '.$volMin[0]['max']);

            //==1. Вычисляем разницу между ближайшеми значениями в таблице сверху и снизу к реальному значению. Например 126.2 - 124.9 = 1.3 ========
            $diff = $volMin[0]['min']-$volMax[0]['min'];
            //echo ('  $diff = '.$diff);
            //==2. Вычисляем шаг таблицы и сколько см в одном шаге===============================================
            //$diff = $diff/10;
            $step = $volMax[0]['ullage']-$volMin[0]['ullage'];
            //echo ('  $step = '.$step);
            //==3. Вычисляем сколько 1/10 до ближайших значений в таблице от полученного замера и какое кол-во топлива приходится на это==============
            if ($step != 0 && ($ulg-($volMin[0]['ullage']) > 0)){
                $toUpSide = round(($ulg-$volMin[0]['ullage'])/ $step, 1) * $diff;
                //   $toDownSide = round(($volMax[0]['sound'] - $lvl) / $step, 1) * $diff;
               // echo ('   $volMin[0][ullage = ]'.$volMin[0]['ullage'].', $ulg = '.$ulg);
               // echo ('  $toUpSide = '. $toUpSide);
            }else{
                $toUpSide = 0;
                //   $toDownSide = 0;
            }
            //==4. Прибавляем вычисленное выше кол-во топлива к ближайшему меньшему значению полученному в таблице и присваиваем полученное значение ==
            //==   соответствующим членам массива который будет отправлен клиенту======================================================================
            $volMax[0]['min'] = $volMin[0]['min'] + $toUpSide;
            $volMax[0]['max'] = $volMin[0]['max'] + $toUpSide;
            // echo ('$volMax[0][min] = '.$volMax[0]['min'].', $volMax[0][max] = '.$volMax[0]['max']);

            return $volMax;
            //  return mysqli_fetch_all($result, MYSQLI_ASSOC);
           // $result = mysqli_query($connect, $query);
           // return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }




        public  function getByVol($id, $vslId, $lvl, $ulg, $vlm, $trim1, $trim2, $tblName){
            $connect = DB::getConnection();
            //echo 'has gotten getByLvl';
            $query =  "
                    SELECT `tank_id`, `tank_name`, `$trim1` as 'min', `tank_abbrev`, `sound`, `ullage`
                    FROM `tanks`
                    LEFT JOIN `$tblName` ON `tank_id` = `table_tank_id`
                    WHERE `$trim1` <= $vlm + 1 AND `$trim1` >= $vlm - 1 AND `tank_id` = $id
            ";
           // echo $query;
            $result = mysqli_query($connect, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }


        public  function getById($id){
            $connect = DB::getConnection();
            //echo 'has gotten getById';
            $query =  "
                        SELECT *
                        FROM `tanks`
                        WHERE `tank_vessel_id` = $id
                ";
           // echo $query;
            $result = mysqli_query($connect, $query);

         //   $query = "
         //           SHOW columns FROM your-table;
         //   ";
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

    public  function getByTankId($id){
        $connect = DB::getConnection();
       // echo 'has gotten getByTankId';
        $query =  "
                        SELECT *
                        FROM `tanks`
                        WHERE `tank_id` = $id
                ";
        // echo $query;
        $result = mysqli_query($connect, $query);

        //   $query = "
        //           SHOW columns FROM your-table;
        //   ";
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function  addOne($newData){
           // echo $newData;
        $connect = DB::getConnection();

        //==Проверяем если tankId не имеет значения, значит запрос был на внесение новаго танка===========
        if($newData['tankId'] === ''){
            $query = "
                INSERT INTO `tanks`
                    SET `tank_vessel_id` = $newData[vesselId],
                        `tank_name` = '$newData[name]',
                        `tank_volume` = $newData[volume],
                        `tank_height` = $newData[height],
                        `tank_abbrev` = '$newData[abbrev]',
                        `tank_Table_name` = '$newData[tableName]',
                        `tank_type_id` = '$newData[tankType]',
                        `tank_maxlevel` = $newData[height]
           ";

            //echo ('1.tankId = '. $newData['tankId']);
            if (mysqli_query($connect, $query)){
                return 'OK';
            }
        }elseif ($newData['tableName'] === ''){
            //==В противном случае запрос на изменение уже существующего танка, но имя не было изменено===========
            $query = "
                UPDATE `tanks`
                    SET `tank_vessel_id` = $newData[vesselId],
                         `tank_name` = '$newData[name]',
                         `tank_volume` = $newData[volume],
                         `tank_height` = $newData[height],
                         `tank_abbrev` = '$newData[abbrev]',
                         `tank_type_id` = '$newData[tankType]',
                         `tank_maxlevel` = $newData[height]
                    WHERE `tank_id` = $newData[tankId]
            ";
            // echo ('2.tankId = '. $query);
            // die();
            if (mysqli_query($connect, $query)){
                return 'OK';
            }
        }else{
            $query = "
                UPDATE `tanks`
                   SET `tank_vessel_id` = $newData[vesselId],
                        `tank_name` = '$newData[name]',
                        `tank_volume` = $newData[volume],
                        `tank_height` = $newData[height],
                        `tank_abbrev` = '$newData[abbrev]',
                        `tank_table_name` = '$newData[tableName]',
                        `tank_type_id` = '$newData[tankType]',
                        `tank_maxlevel` = $newData[height]
                    WHERE `tank_id` = $newData[tankId]
            ";
            //echo ('2.tankId = '. $query);
            // die();
            if (mysqli_query($connect, $query)){
                return 'OK';
            }
        }
        return 'Error';
    }

    public function deleteById($id){
        $connect = DB::getConnection();
        $query ="        
                DELETE FROM `tanks`
                        WHERE `tank_id` = $id;
            ";
        //  echo $query;
        if (mysqli_query($connect, $query)){
            return 'OK';
        }
        return 'Error';
    }

}